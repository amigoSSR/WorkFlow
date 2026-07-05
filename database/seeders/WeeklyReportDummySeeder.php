<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Roadmap;
use App\Models\Milestone;
use App\Models\Diary;
use Carbon\Carbon;

class WeeklyReportDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->error("Tidak ada user di database. Silakan buat user terlebih dahulu.");
            return;
        }

        $project = Project::firstOrCreate(
            ['name' => 'Project Alpha Dummy'],
            [
                'project_id' => 'PRJ-DUMMY-001',
                'description' => 'Dummy project untuk testing laporan mingguan.',
                'category' => 'Cloud Migration',
                'status' => 'Active',
                'created_by' => $user->id,
                'join_code' => 'DUMMY-01'
            ]
        );

        if (!$project->users()->where('user_id', $user->id)->exists()) {
            $project->users()->attach($user->id, ['role' => 'Owner']);
        }

        $startDate = Carbon::create(2026, 6, 29, 10, 0, 0); // 29 Juni 2026
        $midDate = Carbon::create(2026, 7, 2, 14, 0, 0);    // 2 Juli 2026
        $endDate = Carbon::create(2026, 7, 5, 9, 0, 0);     // 5 Juli 2026

        // 1. Buat Roadmap dummy
        $roadmap1 = Roadmap::create([
            'project_id' => $project->id,
            'title' => 'Fase 1: Research & Planning (Dummy)',
            'description' => 'Riset kebutuhan sistem.',
            'created_by' => $user->id,
            'created_at' => $startDate,
            'updated_at' => $startDate,
        ]);

        $roadmap2 = Roadmap::create([
            'project_id' => $project->id,
            'title' => 'Fase 2: UI/UX Design (Dummy)',
            'description' => 'Pembuatan wireframe.',
            'created_by' => $user->id,
            'created_at' => $midDate,
            'updated_at' => $midDate,
        ]);

        // 2. Buat Milestone dummy
        Milestone::create([
            'project_id' => $project->id,
            'roadmap_id' => $roadmap1->id,
            'title' => 'Kumpulkan Kebutuhan Pengguna',
            'status' => 'Done',
            'created_by' => $user->id,
            'created_at' => $startDate,
            'updated_at' => $midDate,
        ]);

        Milestone::create([
            'project_id' => $project->id,
            'roadmap_id' => $roadmap1->id,
            'title' => 'Buat Dokumen SRS',
            'status' => 'In Progress',
            'created_by' => $user->id,
            'created_at' => $startDate,
            'updated_at' => $startDate,
        ]);

        Milestone::create([
            'project_id' => $project->id,
            'roadmap_id' => $roadmap2->id,
            'title' => 'Wireframing Landing Page',
            'status' => 'Pending',
            'created_by' => $user->id,
            'created_at' => $midDate,
            'updated_at' => $midDate,
        ]);

        // 3. Buat Diary dummy
        Diary::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Interview Stakeholder',
            'progress' => 'Melakukan interview dengan stakeholder.',
            'category' => 'meeting',
            'created_at' => $startDate,
            'updated_at' => $startDate,
        ]);

        Diary::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Menulis SRS',
            'progress' => 'Menyusun draft dokumen SRS bab 1-3.',
            'category' => 'progress',
            'created_at' => $midDate,
            'updated_at' => $midDate,
        ]);

        Diary::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Brainstorming Design',
            'progress' => 'Brainstorming ide layout dengan tim.',
            'challenges' => 'Kurang ide layout yang cocok.',
            'category' => 'meeting',
            'created_at' => $endDate,
            'updated_at' => $endDate,
        ]);

        $this->command->info("Data dummy mingguan (29 Juni - 5 Juli) berhasil dibuat!");
    }
}
