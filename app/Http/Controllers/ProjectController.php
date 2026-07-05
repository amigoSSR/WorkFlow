<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Generate a unique 8-character uppercase alphanumeric join code.
     */
    private function generateUniqueJoinCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Project::where('join_code', $code)->exists());

        return $code;
    }

    /**
     * Display a listing of projects (for join panel).
     * Show active projects, and pass user's joined project IDs for UI indication.
     */
    public function index()
    {
        $userId = Auth::id();
        
        $projects = Project::withCount('users')
            ->where('status', '!=', 'Inactive')
            ->get();

        // Get array of project IDs the current user has already joined
        $joinedProjectIds = Auth::user()->projects()->pluck('projects.id')->toArray();

        return view('user.joinproject', compact('projects', 'joinedProjectIds'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|min:3|max:100',
            'description'      => 'required|string|min:10',
            'category'         => 'required|string',
            'status'           => 'nullable|string',
            'priority'         => 'nullable|string',
            'deadline'         => 'nullable|date|after_or_equal:today',
            'budget'           => 'nullable|numeric',
            'reference_links'  => 'nullable|url',
            'join_password'    => 'nullable|string|min:4|max:50',
        ]);

        $project                 = new Project();
        $project->project_id     = 'PRJ-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        $project->join_code      = $this->generateUniqueJoinCode();
        $project->name           = $request->name;
        $project->description    = $request->description;
        $project->category       = $request->category;
        $project->status         = $request->status ?? 'Draft';
        $project->deadline       = $request->deadline;
        $project->reference_links = $request->reference_links;
        $project->created_by     = Auth::id();

        // Hash password if provided
        if ($request->filled('join_password')) {
            $project->join_password = Hash::make($request->join_password);
        }

        $project->save();

        // Add creator as Owner
        $project->users()->attach(Auth::id(), ['role' => 'Owner']);

        return redirect()->route('user.joinproject')
            ->with('success', 'Project "' . $project->name . '" berhasil dibuat! Kode Join: ' . $project->join_code);
    }

    /**
     * Join a project using a join code (and optional password).
     */
    public function join(Request $request)
    {
        $request->validate([
            'join_code'     => 'required|string|size:8',
            'join_password' => 'nullable|string',
        ]);

        $project = Project::where('join_code', strtoupper(trim($request->join_code)))->first();

        if (! $project) {
            return redirect()->back()->with('error', 'Kode join tidak ditemukan. Periksa kembali kode yang Anda masukkan.');
        }

        if ($project->status === 'Inactive') {
            return redirect()->back()->with('error', 'Project ini sudah tidak aktif dan tidak menerima member baru.');
        }

        if ($project->users()->count() >= $project->max_members) {
            return redirect()->back()->with('error', 'Kapasitas project "' . $project->name . '" sudah penuh.');
        }

        if ($project->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah bergabung di project "' . $project->name . '".');
        }

        // Validate password if project has one
        if ($project->join_password) {
            if (! $request->filled('join_password') || ! Hash::check($request->join_password, $project->join_password)) {
                return redirect()->back()->with('error', 'Password project salah. Silakan coba lagi.');
            }
        }

        $project->users()->attach(Auth::id(), ['role' => 'Member']);

        return redirect()->back()->with('success', 'Selamat! Anda berhasil bergabung dengan project "' . $project->name . '".');
    }
}
