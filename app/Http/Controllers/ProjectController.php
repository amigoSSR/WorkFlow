<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::withCount('users')->get();
        return view('user.joinproject', compact('projects'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10',
            'category' => 'required|string',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
            'deadline' => 'nullable|date|after_or_equal:today',
            'budget' => 'nullable|numeric',
            'reference_links' => 'nullable|url',
        ]);

        $project = new Project();
        $project->project_id = 'PRJ-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->category = $request->category;
        $project->status = $request->status ?? 'Draft';
        $project->deadline = $request->deadline;
        $project->reference_links = $request->reference_links;
        $project->created_by = Auth::id();
        $project->save();

        // Add creator as the owner/member
        $project->users()->attach(Auth::id(), ['role' => 'Owner']);

        return redirect()->route('user.joinproject')->with('success', 'Project "' . $project->name . '" berhasil dibuat! ID: ' . $project->project_id);
    }

    /**
     * Join a project.
     */
    public function join(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $project = Project::findOrFail($request->project_id);

        if ($project->users()->count() >= $project->max_members) {
            return redirect()->back()->with('error', 'Kapasitas project sudah penuh.');
        }

        if ($project->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah bergabung di project ini.');
        }

        $project->users()->attach(Auth::id(), ['role' => 'Member']);

        return redirect()->back()->with('success', 'Anda telah berhasil bergabung dengan project ' . $project->name);
    }
}
