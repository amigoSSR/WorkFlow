<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Weekly Checkup</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0b1c30;
            line-height: 1.5;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #008080;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #006565;
            margin: 0 0 5px 0;
            font-size: 24px;
        }
        .header p {
            margin: 2px 0;
            color: #6e7979;
        }
        .section-title {
            color: #006565;
            border-bottom: 1px solid #bdc9c8;
            padding-bottom: 5px;
            margin-top: 25px;
            font-size: 16px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .info-table .label {
            font-weight: bold;
            width: 150px;
            color: #3e4949;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #bdc9c8;
            padding: 8px;
            text-align: left;
        }
        table.data-table th {
            background-color: #f8f9ff;
            color: #006565;
            font-weight: bold;
        }
        .stats-container {
            width: 100%;
            border-collapse: collapse;
        }
        .stats-container td {
            padding: 10px;
            border: 1px solid #bdc9c8;
            text-align: center;
            width: 33.33%;
        }
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #008080;
        }
        .stat-label {
            font-size: 11px;
            color: #6e7979;
            text-transform: uppercase;
        }
        .activity-item {
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 3px solid #008080;
        }
        .activity-date {
            font-size: 10px;
            color: #6e7979;
        }
        .progress-bar-container {
            width: 100%;
            background-color: #e5eeff;
            border-radius: 4px;
            margin-top: 5px;
        }
        .progress-bar {
            height: 10px;
            background-color: #008080;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Weekly Checkup</h1>
        <p><strong>{{ $project->name }}</strong></p>
        <p>Periode: {{ $period_start->format('d M Y') }} - {{ $period_end->format('d M Y') }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Pengguna:</td>
            <td>{{ $user->name }}</td>
            <td class="label">Tanggal Laporan:</td>
            <td>{{ $report_date->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Role / Peran:</td>
            <td>{{ $role }}</td>
            <td class="label">Status Project:</td>
            <td>{{ $project->status }}</td>
        </tr>
        <tr>
            <td class="label">Anggota Project:</td>
            <td colspan="3">{{ $project->users->pluck('name')->join(', ') }}</td>
        </tr>
    </table>

    <div class="section-title">Statistik Mingguan</div>
    <table class="stats-container">
        <tr>
            <td>
                <div class="stat-value">{{ $stats['total_roadmaps'] }}</div>
                <div class="stat-label">Total Roadmap</div>
            </td>
            <td>
                <div class="stat-value">{{ $stats['completed_milestones'] }} / {{ $stats['total_milestones'] }}</div>
                <div class="stat-label">Milestone Selesai</div>
            </td>
            <td>
                <div class="stat-value">{{ $stats['progress'] }}%</div>
                <div class="stat-label">Progress Mingguan</div>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: {{ $stats['progress'] }}%"></div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Roadmap</div>
    @if($roadmaps->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Roadmap</th>
                    <th>Update Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roadmaps as $roadmap)
                    <tr>
                        <td>{{ $roadmap->title }}</td>
                        <td>{{ $roadmap->updated_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada roadmap yang dikerjakan pada periode ini.</p>
    @endif

    <div class="section-title">Milestone</div>
    @if($milestones->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Milestone</th>
                    <th>Status</th>
                    <th>Target Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($milestones as $milestone)
                    <tr>
                        <td>{{ $milestone->title }}</td>
                        <td>{{ $milestone->status }}</td>
                        <td>{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('d M Y') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada milestone pada periode ini.</p>
    @endif

    <div class="section-title">Aktivitas Mingguan (Diary)</div>
    @if($activities->count() > 0)
        @foreach($activities as $activity)
            <div class="activity-item">
                <div><strong>{{ $activity->title }}</strong> <span style="font-size: 10px; color: #6e7979;">- Kategori: {{ $activity->category }}</span></div>
                <div style="margin: 5px 0;">{{ Str::limit($activity->progress, 150) }}</div>
                <div class="activity-date">{{ $activity->created_at->format('d M Y H:i') }}</div>
            </div>
        @endforeach
    @else
        <p>Tidak ada aktivitas yang tercatat pada periode ini.</p>
    @endif

    <div style="margin-top: 40px; text-align: center; color: #6e7979; font-size: 10px; border-top: 1px solid #bdc9c8; padding-top: 10px;">
        Dokumen ini dibuat secara otomatis oleh sistem CollabOps pada {{ $report_date->format('d M Y H:i') }}.
    </div>

</body>
</html>
