<?php

namespace Database\Seeders;

use App\Models\Diary;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DiarySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        if ($users->isEmpty()) {
            return;
        }

        $categories = ['progress', 'meeting', 'review', 'deployment'];

        $sampleTitles = [
            'Implementasi API Integrasi Pembayaran',
            'Review Code Sprint 3',
            'Slicing UI Dashboard Admin',
            'Meeting dengan Tim Backend',
            'Deployment ke Server Staging',
            'Debugging Issue Login Module',
            'Pembuatan Unit Test untuk Auth',
            'Refactoring Database Query Optimization',
            'Meeting Review Design Sprint',
            'Setup CI/CD Pipeline',
            'Dokumentasi API Endpoint',
            'Penyelesaian Modul Laporan',
            'Integrasi Third-Party Payment Gateway',
            'Review & Merge Pull Request',
            'Persiapan Demo ke Klien',
        ];

        $sampleProgress = [
            'Menyelesaikan endpoint POST /api/payment dan berhasil melakukan testing dengan Postman. Semua response code sudah sesuai standar.',
            'Melakukan code review pada branch feature/login-enhancement. Ditemukan beberapa bug kecil pada validasi form yang sudah diperbaiki.',
            'Membuat komponen reusable untuk card, table, dan modal di halaman dashboard admin menggunakan pendekatan BEM.',
            'Diskusi tentang arsitektur microservice dan pembagian tugas untuk sprint berikutnya. Semua anggota tim hadir.',
            'Deploy aplikasi ke server staging berhasil. Melakukan smoke testing pada fitur-fitur utama.',
        ];

        // Generate 30 diary entries over the last 14 days
        $dates = [];
        for ($i = 13; $i >= 0; $i--) {
            $dates[] = Carbon::now()->subDays($i);
        }

        for ($i = 0; $i < 30; $i++) {
            $user = $users->random();
            $date = $dates[array_rand($dates)];

            Diary::create([
                'user_id'    => $user->id,
                'project_id' => $projects->isNotEmpty() ? $projects->random()->id : null,
                'title'      => $sampleTitles[array_rand($sampleTitles)],
                'progress'   => $sampleProgress[array_rand($sampleProgress)],
                'challenges' => rand(0, 1) ? 'Ada sedikit hambatan pada sinkronisasi data antar modul, namun sudah teratasi.' : null,
                'category'   => $categories[array_rand($categories)],
                'created_at' => $date->copy()->addHours(rand(8, 17))->addMinutes(rand(0, 59)),
                'updated_at' => $date->copy()->addHours(rand(8, 17))->addMinutes(rand(0, 59)),
            ]);
        }
    }
}
