<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\HouseRule;
use App\Models\Piket;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's project IDs
        $projectIds = $user->projects()->pluck('projects.id');
        
        // 1. Milestones
        $allMilestones = Milestone::whereIn('project_id', $projectIds)->with('project')->get();
        
        $todoMilestones = $allMilestones->where('status', 'Pending');
        $doingMilestones = $allMilestones->where('status', 'In Progress');
        $doneMilestones = $allMilestones->where('status', 'Done')->sortByDesc('updated_at')->take(5);
        
        // 2. Project Deadlines
        $activeProjects = $user->projects()
            ->whereNotNull('deadline')
            ->where('status', '!=', 'Inactive')
            ->orderBy('deadline', 'asc')
            ->get();
            
        // 3. Piket Schedule
        $pikets = Piket::with('user')->get();
        
        // 4. Quick House Rules
        $houseRules = HouseRule::ordered()->take(3)->get();
        
        return view('user.dashboarduser', compact(
            'todoMilestones', 'doingMilestones', 'doneMilestones',
            'activeProjects', 'pikets', 'houseRules'
        ));
    }

    public function updateMilestoneStatus(Request $request, Milestone $milestone)
    {
        $user = Auth::user();
        
        // Ensure user belongs to the project
        $project = $user->projects()->where('projects.id', $milestone->project_id)->firstOrFail();

        $request->validate([
            'status' => 'required|in:Pending,In Progress,Done',
        ]);

        $oldStatus = $milestone->status;
        $newStatus = $request->status;

        if ($oldStatus !== $newStatus) {
            $milestone->update(['status' => $newStatus]);
            
            // Send notification to all project members
            $members = $project->users;
            
            \Illuminate\Support\Facades\Notification::send(
                $members, 
                new \App\Notifications\MilestoneStatusUpdated($milestone, $user, $oldStatus, $newStatus)
            );
        }

        return response()->json(['success' => true, 'milestone' => $milestone]);
    }
}
