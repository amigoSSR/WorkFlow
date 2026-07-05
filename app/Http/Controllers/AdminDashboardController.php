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
        // ── Stats Cards ──────────────────────────────────────────────
        $totalProjects    = \App\Models\Project::count();
        $completedProjects = \App\Models\Project::where('status', 'Completed')->count();
        $totalMembers     = \App\Models\User::where('role', 'user')->count();

        // Today's activities = diary entries + milestones created today
        $todayActivities  = \App\Models\Diary::whereDate('created_at', today())->count()
                          + \App\Models\Milestone::whereDate('created_at', today())->count();

        // ── Activity Chart (last 30 days) ─────────────────────────────
        $chartLabels = [];
        $chartData   = [];
        for ($i = 29; $i >= 0; $i--) {
            $date          = \Carbon\Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[]   = \App\Models\Diary::whereDate('created_at', $date)->count()
                           + \App\Models\Milestone::whereDate('created_at', $date)->count();
        }

        // ── Recent Today Activities Feed ──────────────────────────────
        $diariesToday = \App\Models\Diary::with(['user', 'project'])
            ->whereDate('created_at', today())
            ->latest()
            ->take(10)
            ->get()
            ->map(fn($d) => (object)[
                'type'       => 'diary',
                'title'      => $d->title,
                'sub'        => optional($d->user)->name . ' — ' . optional($d->project)->name,
                'created_at' => $d->created_at,
                'icon'       => 'edit_square',
                'color'      => 'bg-primary-fixed-dim text-on-primary-fixed-variant',
            ]);

        $milestonesToday = \App\Models\Milestone::with(['creator', 'project'])
            ->whereDate('created_at', today())
            ->latest()
            ->take(10)
            ->get()
            ->map(fn($m) => (object)[
                'type'       => 'milestone',
                'title'      => 'Milestone: ' . $m->title,
                'sub'        => optional($m->creator)->name . ' — ' . optional($m->project)->name,
                'created_at' => $m->created_at,
                'icon'       => 'flag',
                'color'      => 'bg-secondary-fixed-dim text-on-secondary-fixed-variant',
            ]);

        $todayFeed = $diariesToday->concat($milestonesToday)
            ->sortByDesc('created_at')
            ->take(8)
            ->values();

        // ── Upcoming Calendar Events (next 3) ─────────────────────────
        $upcomingEvents = \App\Models\Event::upcoming()->take(3)->get();

        // ── House Rules Preview (top 3 active) ────────────────────────
        $houseRulesPreview = \App\Models\HouseRule::active()->ordered()->take(3)->get();

        // ── Piket Today ───────────────────────────────────────────────
        $todayDayName   = strtolower(\Carbon\Carbon::today()->locale('id')->isoFormat('dddd'));
        // map Carbon locale name → piket day column values
        $dayMap = [
            'senin'  => 'senin',
            'selasa' => 'selasa',
            'rabu'   => 'rabu',
            'kamis'  => 'kamis',
            'jumat'  => 'jumat',
            'sabtu'  => 'sabtu',
            'minggu' => null,
        ];
        $todayPiketDay  = $dayMap[$todayDayName] ?? null;

        // Determine odd/even week
        $weekNumber = (int) \Carbon\Carbon::today()->weekOfYear;
        $weekType   = ($weekNumber % 2 !== 0) ? 'ganjil' : 'genap';

        $piketToday = collect();
        if ($todayPiketDay) {
            $piketToday = \App\Models\Piket::with('user')
                ->where('day', $todayPiketDay)
                ->where(function ($q) use ($weekType) {
                    $q->where('week_type', 'none')
                      ->orWhere('week_type', $weekType);
                })
                ->get();
        }

        return view('admin.admin_dashboard', compact(
            'totalProjects',
            'completedProjects',
            'totalMembers',
            'todayActivities',
            'chartLabels',
            'chartData',
            'todayFeed',
            'upcomingEvents',
            'houseRulesPreview',
            'piketToday',
            'todayDayName',
        ));
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
        $houseRules = \App\Models\HouseRule::with('creator:id,name')
            ->ordered()
            ->paginate(15);

        return view('admin.houseRule', compact('houseRules'));
    }

    /**
     * Show form to create a new house rule
     */
    public function createHouseRule()
    {
        return view('admin.house-rules.create');
    }

    /**
     * Store a newly created house rule
     */
    public function storeHouseRule(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'judul_rule' => 'required|string|max:255',
            'deskripsi_rule' => 'required|string',
            'kategori' => 'required|string|max:100',
            'order_column' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['dibuat_oleh'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');
        $validated['order_column'] = $validated['order_column'] ?? 0;

        \App\Models\HouseRule::create($validated);

        return redirect()->route('admin.house.rules')
            ->with('success', 'House rule berhasil ditambahkan.');
    }

    /**
     * Display the specified house rule
     */
    public function showHouseRule(\App\Models\HouseRule $houseRule)
    {
        $houseRule->load('creator:id,name');
        return view('admin.house-rules.show', compact('houseRule'));
    }

    /**
     * Show form to edit the specified house rule
     */
    public function editHouseRule(\App\Models\HouseRule $houseRule)
    {
        return view('admin.house-rules.edit', compact('houseRule'));
    }

    /**
     * Update the specified house rule
     */
    public function updateHouseRule(\Illuminate\Http\Request $request, \App\Models\HouseRule $houseRule)
    {
        $validated = $request->validate([
            'judul_rule' => 'sometimes|required|string|max:255',
            'deskripsi_rule' => 'sometimes|required|string',
            'kategori' => 'sometimes|required|string|max:100',
            'order_column' => 'nullable|integer|min:0',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        $houseRule->update($validated);

        return redirect()->route('admin.house.rules')
            ->with('success', 'House rule berhasil diperbarui.');
    }

    /**
     * Remove the specified house rule
     */
    public function destroyHouseRule(\App\Models\HouseRule $houseRule)
    {
        $houseRule->delete();

        return redirect()->route('admin.house.rules')
            ->with('success', 'House rule berhasil dihapus.');
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
