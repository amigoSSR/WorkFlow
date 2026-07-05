<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeeklyReportService;
use App\Models\WeeklyReport;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Exception;

class WeeklyReportController extends Controller
{
    protected $reportService;

    public function __construct(WeeklyReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * User: View weekly checkup page
     */
    public function index()
    {
        $user = auth()->user();
        $projects = $user->projects()->get();
        $reports = WeeklyReport::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        $period = $this->reportService->getCurrentPeriod();
        $canGenerate = $this->reportService->canGenerate($period['end']);

        return view('user.weekly_checkup', compact('projects', 'reports', 'period', 'canGenerate'));
    }

    /**
     * User: Generate weekly report
     */
    public function generate(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id'
        ]);

        $user = auth()->user();
        $project = Project::findOrFail($request->project_id);

        // Check if user is in project (or owner)
        if ($project->created_by !== $user->id && !$project->users()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda tidak memiliki akses ke project ini.');
        }

        try {
            $this->reportService->generateReport($user, $project);
            return back()->with('success', 'Weekly Report berhasil digenerate.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Admin: View all weekly reports
     */
    public function adminIndex()
    {
        $users = User::all();
        $projects = Project::all();
        $reports = WeeklyReport::with(['user', 'project'])->orderBy('created_at', 'desc')->get();
        
        $period = $this->reportService->getCurrentPeriod();
        $canGenerate = $this->reportService->canGenerate($period['end']);

        return view('admin.checkup', compact('users', 'projects', 'reports', 'period', 'canGenerate'));
    }

    /**
     * Admin: Generate report for a user
     */
    public function adminGenerate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $project = Project::findOrFail($request->project_id);

        try {
            $this->reportService->generateReport($user, $project);
            return back()->with('success', 'Weekly Report berhasil digenerate untuk ' . $user->name);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Admin: Generate master report (All Projects & Users)
     */
    public function adminGenerateMaster(Request $request)
    {
        try {
            $this->reportService->generateMasterReport();
            return back()->with('success', 'Master Weekly Report berhasil digenerate untuk semua project aktif.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Both: Download a report
     */
    public function download(WeeklyReport $report)
    {
        $user = auth()->user();
        
        // Validation: Only admin or the report owner can download
        if ($user->role !== 'admin' && $report->user_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        if (!Storage::disk('public')->exists($report->filepath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($report->filepath, $report->filename);
    }

    /**
     * Admin: Delete a report
     */
    public function destroy(WeeklyReport $report)
    {
        try {
            if (Storage::disk('public')->exists($report->filepath)) {
                Storage::disk('public')->delete($report->filepath);
            }
            
            $report->delete();
            return back()->with('success', 'Laporan mingguan berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
}
