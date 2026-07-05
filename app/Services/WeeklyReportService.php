<?php

namespace App\Services;

use App\Models\WeeklyReport;
use App\Models\Project;
use App\Models\User;
use App\Models\Roadmap;
use App\Models\Milestone;
use App\Models\Diary;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class WeeklyReportService
{
    /**
     * Get the start and end date for the current 7-day period.
     * Based on Monday-Sunday week.
     * 
     * @return array ['start' => Carbon, 'end' => Carbon]
     */
    public function getCurrentPeriod()
    {
        // Get today's date
        $now = Carbon::now();
        
        // Find the start of the week (Monday) and end of the week (Sunday)
        // If today is Sunday, startOfWeek() might shift to the next Monday depending on config, 
        // but by default Laravel's startOfWeek() is Monday.
        $start = $now->copy()->startOfWeek(Carbon::MONDAY);
        $end = $now->copy()->endOfWeek(Carbon::SUNDAY);
        
        return [
            'start' => $start,
            'end' => $end,
        ];
    }

    /**
     * Check if a report can be generated today.
     * Reports can only be generated when the week has ended (i.e. today >= period_end).
     * 
     * @param Carbon $periodEnd
     * @return bool
     */
    public function canGenerate(Carbon $periodEnd)
    {
        return Carbon::now()->startOfDay()->gte($periodEnd->startOfDay());
    }

    /**
     * Check if a report already exists for this period.
     * 
     * @param int $userId
     * @param int $projectId
     * @param Carbon $periodStart
     * @param Carbon $periodEnd
     * @return bool
     */
    public function hasExistingReport($userId, $projectId, $periodStart, $periodEnd)
    {
        return WeeklyReport::where('user_id', $userId)
            ->where('project_id', $projectId)
            ->forPeriod($periodStart->format('Y-m-d'), $periodEnd->format('Y-m-d'))
            ->exists();
    }

    /**
     * Generate the weekly report PDF.
     * 
     * @param User $user
     * @param Project $project
     * @return WeeklyReport
     * @throws Exception
     */
    public function generateReport(User $user, Project $project)
    {
        $period = $this->getCurrentPeriod();
        $start = $period['start'];
        $end = $period['end'];

        if (!$this->canGenerate($end)) {
            throw new Exception("Laporan minggu ini belum dapat dibuat. Silakan generate setelah periode mingguan berakhir pada " . $end->format('d M Y') . ".");
        }

        if ($this->hasExistingReport($user->id, $project->id, $start, $end)) {
            throw new Exception("Laporan untuk periode ini sudah pernah dibuat.");
        }

        // Get data for PDF
        $data = $this->getReportData($user, $project, $start, $end);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.weekly_report_pdf', $data);
        
        // Define filename and path
        $filename = 'weekly-report-' . strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $user->name)) . '-' . $end->format('Y-m-d') . '.pdf';
        $filepath = 'weekly-reports/' . $filename;
        
        // Save to public storage
        Storage::disk('public')->put($filepath, $pdf->output());

        // Save to database inside transaction
        return DB::transaction(function () use ($user, $project, $start, $end, $filename, $filepath) {
            return WeeklyReport::create([
                'user_id' => $user->id,
                'project_id' => $project->id,
                'filename' => $filename,
                'filepath' => $filepath,
                'period_start' => $start->format('Y-m-d'),
                'period_end' => $end->format('Y-m-d'),
            ]);
        });
    }

    /**
     * Gather data for the PDF report.
     * 
     * @param User $user
     * @param Project $project
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public function getReportData(User $user, Project $project, Carbon $start, Carbon $end)
    {
        $project->loadMissing('users');
        
        // 1. Roadmaps modified in this period
        $roadmaps = Roadmap::where('project_id', $project->id)
            ->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()])
            ->get();
            
        // 2. Milestones modified in this period
        $milestones = Milestone::where('project_id', $project->id)
            ->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()])
            ->get();
            
        // 3. Diaries/Activities created in this period
        $activities = Diary::where('project_id', $project->id)
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$start->startOfDay(), $end->endOfDay()])
            ->orderBy('created_at', 'asc')
            ->get();

        // 4. Statistics
        $totalMilestones = Milestone::where('project_id', $project->id)->count();
        $completedMilestones = Milestone::where('project_id', $project->id)->where('status', 'Done')->count();
        $totalRoadmaps = Roadmap::where('project_id', $project->id)->count();
        
        $progress = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;
        
        // Try to get role from pivot table if user is in project
        $role = $project->users()->where('user_id', $user->id)->first()->pivot->role ?? 'Member';
        if ($project->created_by == $user->id) {
            $role = 'Owner';
        }

        return [
            'user' => $user,
            'project' => $project,
            'role' => $role,
            'period_start' => $start,
            'period_end' => $end,
            'report_date' => Carbon::now(),
            'roadmaps' => $roadmaps,
            'milestones' => $milestones,
            'activities' => $activities,
            'stats' => [
                'total_roadmaps' => $totalRoadmaps,
                'total_milestones' => $totalMilestones,
                'completed_milestones' => $completedMilestones,
                'pending_milestones' => $totalMilestones - $completedMilestones,
                'progress' => $progress,
            ]
        ];
    }

    /**
     * Generate the master weekly report PDF containing all active projects.
     * 
     * @return WeeklyReport
     * @throws Exception
     */
    public function generateMasterReport()
    {
        $period = $this->getCurrentPeriod();
        $start = $period['start'];
        $end = $period['end'];

        if (!$this->canGenerate($end)) {
            throw new Exception("Laporan master minggu ini belum dapat dibuat. Silakan generate setelah periode mingguan berakhir pada " . $end->format('d M Y') . ".");
        }

        // Check if master report already exists for this period
        $existingMaster = WeeklyReport::whereNull('user_id')
            ->whereNull('project_id')
            ->forPeriod($start->format('Y-m-d'), $end->format('Y-m-d'))
            ->first();

        if ($existingMaster) {
            throw new Exception("Laporan Master untuk periode ini sudah pernah dibuat.");
        }

        // Get all active projects that have roadmaps, milestones, or diaries in this period
        $projects = Project::with('users')
            ->whereHas('roadmaps', function($q) use ($start, $end) {
                $q->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()]);
            })
            ->orWhereHas('milestones', function($q) use ($start, $end) {
                $q->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()]);
            })
            ->orWhereHas('users', function($q) {
                // Just ensuring the project has users, we will fetch their diaries later
            })
            ->get();
            
        $projectsData = [];

        foreach ($projects as $project) {
            $roadmaps = Roadmap::where('project_id', $project->id)
                ->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()])
                ->get();
                
            $milestones = Milestone::where('project_id', $project->id)
                ->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()])
                ->get();
                
            // All diaries for this project by all users in this period
            $activities = Diary::with('user')
                ->where('project_id', $project->id)
                ->whereBetween('created_at', [$start->startOfDay(), $end->endOfDay()])
                ->orderBy('created_at', 'asc')
                ->get();

            // Only include projects that actually have some updates
            if ($roadmaps->isEmpty() && $milestones->isEmpty() && $activities->isEmpty()) {
                continue;
            }

            $totalMilestones = Milestone::where('project_id', $project->id)->count();
            $completedMilestones = Milestone::where('project_id', $project->id)->where('status', 'Done')->count();
            $totalRoadmaps = Roadmap::where('project_id', $project->id)->count();
            $progress = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;

            $projectsData[] = [
                'project' => $project,
                'roadmaps' => $roadmaps,
                'milestones' => $milestones,
                'activities' => $activities,
                'stats' => [
                    'total_roadmaps' => $totalRoadmaps,
                    'total_milestones' => $totalMilestones,
                    'completed_milestones' => $completedMilestones,
                    'progress' => $progress,
                ]
            ];
        }

        if (empty($projectsData)) {
            throw new Exception("Tidak ada aktivitas sama sekali dari semua proyek pada periode minggu ini.");
        }

        $data = [
            'period_start' => $start,
            'period_end' => $end,
            'report_date' => Carbon::now(),
            'projectsData' => $projectsData
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.master_weekly_report_pdf', $data);
        
        // Define filename and path
        $filename = 'master-weekly-report-' . $end->format('Y-m-d') . '.pdf';
        $filepath = 'weekly-reports/' . $filename;
        
        // Save to public storage
        Storage::disk('public')->put($filepath, $pdf->output());

        // Save to database inside transaction
        return DB::transaction(function () use ($start, $end, $filename, $filepath) {
            return WeeklyReport::create([
                'user_id' => null,
                'project_id' => null,
                'filename' => $filename,
                'filepath' => $filepath,
                'period_start' => $start->format('Y-m-d'),
                'period_end' => $end->format('Y-m-d'),
            ]);
        });
    }
}
