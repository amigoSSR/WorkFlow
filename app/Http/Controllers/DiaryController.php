<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Roadmap;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    /**
     * Display a listing of the projects the user has joined.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all projects the user is part of, with some stats
        $projects = $user->projects()
            ->withCount('users')
            ->get();

        // Calculate some mock stats for the bento grid
        $totalSubmissions = Milestone::where('created_by', $user->id)->count() + Roadmap::where('created_by', $user->id)->count();
        $pendingReview = Milestone::where('created_by', $user->id)->where('status', 'Pending')->count();

        return view('user.diaryuser', compact('projects', 'totalSubmissions', 'pendingReview'));
    }

    /**
     * Display the specific project's roadmaps and milestones.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // Ensure the user is part of the project
        $project = $user->projects()->where('projects.id', $id)->firstOrFail();
        
        // The pivot role: Owner = Mentor, Member = Mentee
        $role = $project->pivot->role;

        // Fetch roadmaps and their milestones
        $roadmaps = Roadmap::where('project_id', $project->id)
            ->with(['milestones', 'creator'])
            ->get();
            
        // Fetch project links
        $projectLinks = \App\Models\ProjectLink::where('project_id', $project->id)
            ->with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.diarydetail', compact('project', 'roadmaps', 'projectLinks', 'role'));
    }

    /**
     * Store a new roadmap.
     */
    public function storeRoadmap(Request $request, $project_id)
    {
        $user = Auth::user();
        $project = $user->projects()->where('projects.id', $project_id)->firstOrFail();

        // Only Owner (Mentor) can add roadmap
        if ($project->pivot->role !== 'Owner') {
            return redirect()->back()->with('error', 'Hanya Mentor (Owner) yang dapat menambahkan Roadmap.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Roadmap::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => $user->id
        ]);

        return redirect()->back()->with('success', 'Roadmap berhasil ditambahkan.');
    }

    /**
     * Store a new milestone.
     */
    public function storeMilestone(Request $request, $project_id)
    {
        $user = Auth::user();
        $project = $user->projects()->where('projects.id', $project_id)->firstOrFail();

        // Both Mentor and Mentee can add milestones
        $request->validate([
            'roadmap_id' => 'required|exists:roadmaps,id',
            'title' => 'required|string|max:255',
            'status' => 'required|in:Pending,In Progress,Done',
            'due_date' => 'nullable|date'
        ]);

        Milestone::create([
            'project_id' => $project->id,
            'roadmap_id' => $request->roadmap_id,
            'title' => $request->title,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'created_by' => $user->id
        ]);

        return redirect()->back()->with('success', 'Milestone berhasil ditambahkan.');
    }

    /**
     * Store a new project link.
     */
    public function storeLink(Request $request, $project_id)
    {
        $user = Auth::user();
        $project = $user->projects()->where('projects.id', $project_id)->firstOrFail();

        // Both Mentor and Mentee can add links
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url'
        ]);

        \App\Models\ProjectLink::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'url' => $request->url,
            'created_by' => $user->id
        ]);

        return redirect()->back()->with('success', 'Link berhasil dibagikan.');
    }
}
