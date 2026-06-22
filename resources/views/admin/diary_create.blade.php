@include('admin.topbarAdmin')

<main class="pt-24 pb-12 px-container-padding min-h-screen">

    {{-- Page Header --}}
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="font-headline-xl text-headline-xl text-on-background">Activity Analytics</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Pantau semua aktivitas harian tim dan lihat siapa yang paling aktif berkontribusi.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 border border-outline-variant rounded-lg text-on-surface-variant hover:bg-surface-container transition-all text-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Dashboard
        </a>
    </div>

    {{-- Stat Cards --}}
    @php
        $catIcons = ['progress' => ['bolt', 'bg-primary/10', 'text-primary'], 'meeting' => ['groups', 'bg-secondary/10', 'text-secondary'], 'review' => ['rate_review', 'bg-tertiary/10', 'text-tertiary'], 'deployment' => ['rocket_launch', 'bg-[#7c3aed]/10', 'text-[#7c3aed]']];
        $totalActivities = collect($activities)->count();
    @endphp
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-outline-variant/30">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Total Aktivitas</p>
            <p class="text-3xl font-bold text-on-background">{{ $totalActivities }}</p>
        </div>
        @foreach(['progress', 'meeting', 'review', 'deployment'] as $cat)
        @php [$icon, $ibg, $itxt] = $catIcons[$cat]; @endphp
        <div class="bg-white rounded-xl p-5 shadow-sm border border-outline-variant/30">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined {{ $itxt }} text-[18px]">{{ $icon }}</span>
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">{{ ucfirst($cat) }}</p>
            </div>
            <p class="text-3xl font-bold text-on-background">{{ $categoryStats[$cat]->total ?? 0 }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ── LEFT: Chart + Activity Feed ── --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- Activity Chart --}}
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-background">Aktivitas 14 Hari Terakhir</h3>
                        <p class="text-xs text-on-surface-variant mt-0.5">Jumlah aktivitas yang dicatat per hari</p>
                    </div>
                    <a href="{{ route('admin.diary') }}" class="text-xs text-primary font-semibold hover:underline">Refresh</a>
                </div>
                <div class="h-[220px] relative">
                    <canvas id="diaryActivityChart"></canvas>
                </div>
                <div class="flex justify-between mt-3 px-2">
                    @foreach($chartLabels as $label)
                        <span class="text-[10px] text-on-surface-variant font-medium">{{ $label }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Activity Feed --}}
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant/30 flex items-center justify-between">
                    <h3 class="font-headline-md text-headline-md text-on-background">Recent Activities</h3>
                    <span class="text-xs text-on-surface-variant">{{ count($activities) }} aktivitas</span>
                </div>

                @if(count($activities) === 0)
                    <div class="flex flex-col items-center gap-3 py-16 text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl opacity-30">inventory_2</span>
                        <p class="text-sm">Belum ada laporan aktivitas.</p>
                    </div>
                @else
                <div class="divide-y divide-outline-variant/20 max-h-[480px] overflow-y-auto custom-scrollbar">
                    @foreach($activities as $diary)
                    @php
                        [$icon, $ibg, $itxt] = $catIcons[$diary->category] ?? ['edit_note', 'bg-surface-container', 'text-on-surface-variant'];
                    @endphp
                    <div class="flex gap-4 px-6 py-4 hover:bg-surface-container-lowest transition-colors">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $ibg }} {{ $itxt }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">{{ $icon }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-semibold text-sm text-on-background truncate">{{ $diary->title }}</p>
                                <span class="text-[11px] text-outline flex-shrink-0">{{ $diary->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-0.5">
                                <span class="font-medium text-on-background">{{ $diary->user->name }}</span>
                                @if(isset($diary->project))
                                  · {{ $diary->project->name }}
                                @endif
                            </p>
                            <p class="text-xs text-on-surface-variant mt-1 line-clamp-1">{{ $diary->progress }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- ── RIGHT: Leaderboard ── --}}
        <div class="xl:col-span-1 space-y-6">

            {{-- Leaderboard --}}
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant/30">
                    <h3 class="font-headline-md text-headline-md text-on-background">🏆 Most Active</h3>
                    <p class="text-xs text-on-surface-variant mt-0.5">30 hari terakhir</p>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($leaderboard as $index => $item)
                    @php
                        $medalColors = ['text-[#f59e0b]', 'text-[#94a3b8]', 'text-[#cd7c2f]'];
                        $medal = $medalColors[$index] ?? 'text-on-surface-variant';
                        $pct = $leaderboard->first()->total > 0 ? ($item->total / $leaderboard->first()->total * 100) : 0;
                    @endphp
                    <div class="flex items-center gap-3">
                        <span class="text-xl {{ $medal }} w-7 text-center font-bold">{{ ['🥇','🥈','🥉'][$index] ?? ($index+1) }}</span>
                        <div class="w-9 h-9 rounded-full bg-surface-variant flex items-center justify-center font-bold text-sm text-on-surface-variant flex-shrink-0">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-on-background truncate">{{ $item->user->name }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full transition-all" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-primary flex-shrink-0">{{ $item->total }} laporan</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-sm text-on-surface-variant py-8">Belum ada data aktivitas.</p>
                    @endforelse
                </div>
            </div>

            {{-- Category Breakdown --}}
            <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant/30">
                    <h3 class="font-headline-md text-headline-md text-on-background">Kategori Aktivitas</h3>
                </div>
                <div class="p-4">
                    <div class="h-[180px]">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Activity Line Chart
    new Chart(document.getElementById('diaryActivityChart'), {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Laporan',
                data: @json($chartData),
                backgroundColor: 'rgba(0, 101, 101, 0.12)',
                borderColor: 'rgba(0, 101, 101, 0.8)',
                borderWidth: 2,
                borderRadius: 6,
                hoverBackgroundColor: 'rgba(0, 101, 101, 0.35)',
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a1a1a', titleColor: '#fff', bodyColor: '#ccc',
                    padding: 10,
                    callbacks: { label: c => ` ${c.raw} laporan` }
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, color: '#94a3b8' }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { ticks: { display: false }, grid: { display: false } }
            }
        }
    });

    // Category Donut Chart
    const catData = @json($categoryStats->values()->pluck('total'));
    const catLabels = @json($categoryStats->keys()->map(fn($k) => ucfirst($k)));
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: catLabels,
            datasets: [{
                data: catData,
                backgroundColor: ['rgba(0,101,101,0.7)', 'rgba(69,95,136,0.7)', 'rgba(139,72,35,0.7)', 'rgba(124,58,237,0.7)'],
                borderWidth: 2, borderColor: '#fff'
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 12 } }
            },
            cutout: '65%'
        }
    });
</script>
</body></html>
