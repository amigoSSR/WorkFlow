<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Middleware to check if user is admin
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->user()->role !== 'admin') {
                abort(403, 'Unauthorized access');
            }
            return $next($request);
        });
    }

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Activity analytics for chart (last 7 days)
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('D, d M');
            $diaryCount = \App\Models\Diary::whereDate('created_at', $date)->count();
            $milestoneCount = \App\Models\Milestone::whereDate('created_at', $date)->count();
            $chartData[] = $diaryCount + $milestoneCount;
        }

        $totalActivities = \App\Models\Diary::count() + \App\Models\Milestone::count();
        $todayActivities = \App\Models\Diary::whereDate('created_at', today())->count() + 
                           \App\Models\Milestone::whereDate('created_at', today())->count();

        return view('admin.admin_dashboard', compact('chartLabels', 'chartData', 'totalActivities', 'todayActivities'));
    }

    /**
     * Display user management page
     */
    public function users()
    {
        $users = \App\Models\User::all();
        return view('admin.userManegement', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        // Prevent admin from changing their own role to user to avoid getting locked out, optional but good practice.
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * Display project management page
     */
    public function projects()
    {
        $projects = \App\Models\Project::with([
                'creator',
                'users',
                'roadmaps.milestones',
                'milestones',
                'projectLinks',
            ])
            ->withCount('users')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalProjects    = $projects->count();
        $activeProjects   = $projects->where('status', 'Active')->count();
        $draftProjects    = $projects->where('status', 'Draft')->count();
        $completedProjects = $projects->where('status', 'Completed')->count();

        return view('admin.project_management', compact(
            'projects', 'totalProjects', 'activeProjects', 'draftProjects', 'completedProjects'
        ));
    }

    /**
     * Display admin calendar page (Event Management)
     */
    public function calendar(\Illuminate\Http\Request $request)
    {
        $date = $request->input('date', now()->format('Y-m'));
        $currentDate = \Carbon\Carbon::parse($date . '-01');
        
        $events = \App\Models\Event::orderBy('start_date')->get();
        return view('admin.calender', compact('events', 'currentDate'));
    }

    /**
     * Display house rules page
     */
    public function houseRules()
    {
        return view('admin.houseRule');
    }

    /**
     * Display piket page
     */
    public function piket()
    {
        $users = \App\Models\User::all();
        $pikets = \App\Models\Piket::with('user')->get();

        // Group pikets by day and week_type
        $schedule = [
            'senin' => $pikets->where('day', 'senin')->where('week_type', 'none'),
            'selasa' => $pikets->where('day', 'selasa')->where('week_type', 'none'),
            'rabu' => $pikets->where('day', 'rabu')->where('week_type', 'none'),
            'kamis' => $pikets->where('day', 'kamis')->where('week_type', 'none'),
            'jumat_ganjil' => $pikets->where('day', 'jumat')->where('week_type', 'ganjil'),
            'jumat_genap' => $pikets->where('day', 'jumat')->where('week_type', 'genap'),
            'sabtu_ganjil' => $pikets->where('day', 'sabtu')->where('week_type', 'ganjil'),
            'sabtu_genap' => $pikets->where('day', 'sabtu')->where('week_type', 'genap'),
        ];

        return view('admin.piket', compact('users', 'schedule'));
    }

    /**
     * Display diary index page (Activity Analytics for Admin)
     */
    public function diary()
    {
        // Fetch Diaries
        $diaries = \App\Models\Diary::with(['user', 'project'])->latest()->take(50)->get()->map(function ($item) {
            $item->activity_type = 'diary';
            return $item;
        });

        // Fetch Milestones
        $milestones = \App\Models\Milestone::with(['creator', 'project'])->latest()->take(50)->get()->map(function ($item) {
            return (object)[
                'id' => $item->id,
                'activity_type' => 'milestone',
                'title' => 'Menambahkan Milestone: ' . $item->title,
                'progress' => 'Tenggat Waktu: ' . \Carbon\Carbon::parse($item->due_date)->format('d M Y') . ' - Status: ' . $item->status,
                'category' => 'progress',
                'user' => $item->creator,
                'project' => $item->project,
                'created_at' => $item->created_at,
            ];
        });

        // Merge and sort
        $activities = $diaries->concat($milestones)->sortByDesc('created_at')->take(50)->values();

        // Leaderboard: Aggregate Diary and Milestone counts
        $diaryCounts = \App\Models\Diary::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))
            ->selectRaw('user_id, count(*) as count')
            ->groupBy('user_id')->get()->pluck('count', 'user_id')->toArray();
            
        $milestoneCounts = \App\Models\Milestone::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))
            ->selectRaw('created_by, count(*) as count')
            ->groupBy('created_by')->get()->pluck('count', 'created_by')->toArray();

        $leaderboardRaw = [];
        foreach (array_unique(array_merge(array_keys($diaryCounts), array_keys($milestoneCounts))) as $uid) {
            $leaderboardRaw[$uid] = ($diaryCounts[$uid] ?? 0) + ($milestoneCounts[$uid] ?? 0);
        }
        arsort($leaderboardRaw);
        $leaderboardRaw = array_slice($leaderboardRaw, 0, 5, true);
        
        $leaderboard = [];
        foreach ($leaderboardRaw as $uid => $total) {
            $user = \App\Models\User::find($uid);
            if ($user) {
                $leaderboard[] = (object)['user' => $user, 'total' => $total];
            }
        }
        $leaderboard = collect($leaderboard);

        // Chart: activities per day (last 14 days)
        $chartLabels = [];
        $chartData = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[] = \App\Models\Diary::whereDate('created_at', $date)->count() + 
                           \App\Models\Milestone::whereDate('created_at', $date)->count();
        }

        // Category breakdown (for simplicity, we assume milestones are 'progress')
        $categoryStats = \App\Models\Diary::selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->get()
            ->keyBy('category')->toArray();
        
        if (!isset($categoryStats['progress'])) {
            $categoryStats['progress'] = ['total' => 0];
        }
        $categoryStats['progress']['total'] += count($milestones);
        
        $categoryStats = collect(array_map(function($item) { return (object)$item; }, $categoryStats));

        return view('admin.diary_create', compact('activities', 'leaderboard', 'chartLabels', 'chartData', 'categoryStats'));
    }

    /**
     * Display weekly check-up page
     */
    public function checkUp()
    {
        return view('admin.checkup');
    }

    /**
     * Display projects list page
     */
    public function projectsList()
    {
        return view('admin.projects');
    }
}
