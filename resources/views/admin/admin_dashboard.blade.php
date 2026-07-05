@include('admin.topbarAdmin')
<!-- Page Content -->
<div class="p-container-padding max-w-[1400px] mx-auto">
<!-- Header Actions -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="font-headline-xl text-headline-xl text-on-background">System Dashboard</h2>
        <p class="text-body-lg text-on-surface-variant">Welcome back, Admin. Here's what's happening today.</p>
    </div>
    <div class="flex items-center gap-3">
        <a class="px-5 py-2.5 bg-white border border-on-background text-on-background font-semibold rounded-lg hover:bg-surface-container-low transition-all flex items-center gap-2" href="{{ route('admin.users') }}">
            <span class="material-symbols-outlined text-[20px]" data-icon="person_add">person_add</span>
            Add User
        </a>
        <a class="px-5 py-2.5 bg-primary-container text-on-primary font-semibold rounded-lg hover:brightness-110 shadow-sm transition-all flex items-center gap-2" href="{{ route('admin.projects') }}">
            <span class="material-symbols-outlined text-[20px]" data-icon="add">add</span>
            New Project
        </a>
    </div>
</div>

<!-- ── Stats Cards ─────────────────────────────────────────────── -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-card-gap mb-8">

    {{-- Total Projects --}}
    <div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-primary">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-primary text-[32px]">folder_managed</span>
            <span class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded">All Time</span>
        </div>
        <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Total Projects</p>
        <h3 class="text-[32px] font-bold text-on-background leading-tight">{{ $totalProjects }}</h3>
    </div>

    {{-- Total Members --}}
    <div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-secondary">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-secondary text-[32px]">groups</span>
            <span class="px-2 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded">Active</span>
        </div>
        <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Total Members</p>
        <h3 class="text-[32px] font-bold text-on-background leading-tight">{{ $totalMembers }}</h3>
    </div>

    {{-- Completed Projects --}}
    <div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-tertiary">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-tertiary text-[32px]">task_alt</span>
            <span class="px-2 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold rounded">Done</span>
        </div>
        <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Project Selesai</p>
        <h3 class="text-[32px] font-bold text-on-background leading-tight">{{ $completedProjects }}</h3>
    </div>

    {{-- Today's Activities --}}
    <div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-[#7c3aed]">
        <div class="flex items-center justify-between mb-4">
            <span class="material-symbols-outlined text-[#7c3aed] text-[32px]">edit_note</span>
            <a href="{{ route('admin.diary') }}" class="px-2 py-1 bg-[#7c3aed]/10 text-[#7c3aed] text-[10px] font-bold rounded hover:bg-[#7c3aed]/20 transition">View All</a>
        </div>
        <p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Aktivitas Hari Ini</p>
        <h3 class="text-[32px] font-bold text-on-background leading-tight">{{ $todayActivities }}</h3>
    </div>
</div>

<!-- ── Chart + Feed Row ──────────────────────────────────────────── -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-card-gap">

    <!-- Activity Chart -->
    <div class="lg:col-span-8 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h4 class="font-headline-md text-headline-md text-on-background">Activity Analytics</h4>
                <p class="text-body-md text-on-surface-variant">Total aktivitas masuk (30 hari terakhir)</p>
            </div>
            <span class="px-3 py-1.5 bg-surface-container-low text-on-surface-variant text-label-md rounded-lg font-medium">Last 30 Days</span>
        </div>
        <!-- Chart -->
        <div class="relative h-[280px] w-full">
            <canvas id="activityChart"></canvas>
        </div>
        <!-- Summary below chart -->
        <div class="flex items-center gap-6 mt-4 pt-4 border-t border-outline-variant/30">
            <div class="text-center">
                <p class="text-[11px] text-on-surface-variant uppercase tracking-wide font-medium">Total (30d)</p>
                <p class="text-[20px] font-bold text-primary">{{ array_sum($chartData) }}</p>
            </div>
            <div class="text-center">
                <p class="text-[11px] text-on-surface-variant uppercase tracking-wide font-medium">Hari Ini</p>
                <p class="text-[20px] font-bold text-[#7c3aed]">{{ $todayActivities }}</p>
            </div>
            <div class="text-center">
                <p class="text-[11px] text-on-surface-variant uppercase tracking-wide font-medium">Rata-rata/hari</p>
                <p class="text-[20px] font-bold text-secondary">{{ count($chartData) > 0 ? round(array_sum($chartData) / count($chartData), 1) : 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Today's Activity Feed -->
    <div class="lg:col-span-4 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] flex flex-col">
        <div class="flex items-center justify-between mb-5">
            <h4 class="font-headline-md text-headline-md text-on-background">Aktivitas Hari Ini</h4>
            <a class="text-primary text-label-md font-label-md hover:underline" href="{{ route('admin.diary') }}">Lihat Semua</a>
        </div>
        <div class="flex-1 space-y-4 overflow-y-auto max-h-[360px] pr-1 custom-scrollbar">
            @forelse($todayFeed as $item)
            <div class="flex gap-3 items-start">
                <div class="h-9 w-9 shrink-0 rounded-full {{ $item->color }} flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">{{ $item->icon }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-body-md font-semibold text-on-background truncate">{{ $item->title }}</p>
                    <p class="text-[12px] text-on-surface-variant truncate">{{ $item->sub }}</p>
                    <span class="text-[11px] text-outline mt-0.5 block">
                        {{ $item->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center h-full py-10 text-center">
                <span class="material-symbols-outlined text-[40px] text-outline/40 mb-2">inbox</span>
                <p class="text-body-md text-on-surface-variant">Belum ada aktivitas hari ini</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- ── Management Sections ──────────────────────────────────────── -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-card-gap mt-8">

    <!-- Calendar Preview -->
    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-headline-md text-headline-md text-on-background">Calendar</h5>
            <a class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" href="{{ route('admin.calendar') }}">
                <span class="material-symbols-outlined text-primary" data-icon="edit">edit</span>
            </a>
        </div>
        <div class="space-y-3">
            @forelse($upcomingEvents as $event)
            @php
                $isToday = $event->start_date->isToday();
                $isTomorrow = $event->start_date->isTomorrow();
                $label  = $isToday ? 'TODAY' : ($isTomorrow ? 'TOMORROW' : $event->start_date->format('d M'));
                $colors = $event->colorClasses();
            @endphp
            <div class="p-3 rounded-lg border-l-2 {{ $isToday ? 'bg-surface-container-low border-primary' : 'bg-surface-container-lowest border-outline-variant' }}">
                <p class="text-label-md font-bold {{ $isToday ? 'text-primary' : 'text-outline' }}">{{ $label }}</p>
                <p class="text-body-md font-semibold text-on-background">{{ $event->title }}</p>
                @if($event->location)
                <p class="text-[12px] text-on-surface-variant">{{ $event->location }}</p>
                @endif
                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-bold rounded {{ $colors['bg'] }} {{ $colors['text'] }}">
                    {{ ucfirst($event->type) }}
                </span>
            </div>
            @empty
            <div class="flex flex-col items-center py-6 text-center">
                <span class="material-symbols-outlined text-[36px] text-outline/40 mb-2">event_busy</span>
                <p class="text-body-md text-on-surface-variant">Tidak ada event mendatang</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- House Rules Preview -->
    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-headline-md text-headline-md text-on-background">House Rules</h5>
            <a class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" href="{{ route('admin.house.rules') }}">
                <span class="material-symbols-outlined text-primary" data-icon="edit">edit</span>
            </a>
        </div>
        <ul class="space-y-3">
            @forelse($houseRulesPreview as $rule)
            <li class="flex items-start gap-3">
                <span class="material-symbols-outlined text-[18px] text-primary mt-0.5" data-icon="verified">verified</span>
                <div class="min-w-0">
                    <p class="text-body-md font-semibold text-on-background truncate">{{ $rule->judul_rule }}</p>
                    <p class="text-[12px] text-on-surface-variant line-clamp-2">{{ $rule->deskripsi_rule }}</p>
                </div>
            </li>
            @empty
            <li class="flex flex-col items-center py-6 text-center">
                <span class="material-symbols-outlined text-[36px] text-outline/40 mb-2">rule</span>
                <p class="text-body-md text-on-surface-variant">Belum ada house rule aktif</p>
            </li>
            @endforelse
        </ul>
        @if($houseRulesPreview->isNotEmpty())
        <a href="{{ route('admin.house.rules') }}" class="block mt-4 text-center text-primary text-label-md font-medium hover:underline">
            Lihat semua rules →
        </a>
        @endif
    </div>

    <!-- Piket Today -->
    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h5 class="font-headline-md text-headline-md text-on-background">Piket Hari Ini</h5>
                <p class="text-[12px] text-on-surface-variant capitalize">{{ ucfirst($todayDayName) }}, {{ \Carbon\Carbon::today()->format('d M Y') }}</p>
            </div>
            <a class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" href="{{ route('admin.piket') }}">
                <span class="material-symbols-outlined text-primary" data-icon="edit">edit</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            @if($piketToday->isNotEmpty())
            <table class="w-full text-left text-body-md">
                <thead>
                    <tr class="border-b border-outline-variant">
                        <th class="pb-2 font-semibold text-on-surface-variant text-[12px] uppercase tracking-wide">Member</th>
                        <th class="pb-2 font-semibold text-on-surface-variant text-[12px] uppercase tracking-wide text-right">Zone</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                    @foreach($piketToday as $piket)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="py-2.5 flex items-center gap-2">
                            <div class="h-7 w-7 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-[11px] shrink-0">
                                {{ strtoupper(substr(optional($piket->user)->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="truncate max-w-[100px]">{{ optional($piket->user)->name ?? 'Unknown' }}</span>
                        </td>
                        <td class="py-2.5 text-right font-medium text-on-background">{{ $piket->zone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="flex flex-col items-center py-6 text-center">
                <span class="material-symbols-outlined text-[36px] text-outline/40 mb-2">cleaning_services</span>
                <p class="text-body-md text-on-surface-variant">
                    @if(strtolower(\Carbon\Carbon::today()->locale('id')->isoFormat('dddd')) === 'minggu')
                        Tidak ada piket hari Minggu
                    @else
                        Belum ada jadwal piket hari ini
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ── Activity Chart ────────────────────────────────────────────────
    const ctx = document.getElementById('activityChart').getContext('2d');

    const chartLabels = @json($chartLabels ?? []);
    const chartData   = @json($chartData ?? []);

    // Gradient fill
    const gradient = ctx.createLinearGradient(0, 0, 0, 280);
    gradient.addColorStop(0, 'rgba(0, 101, 101, 0.25)');
    gradient.addColorStop(1, 'rgba(0, 101, 101, 0.0)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Aktivitas',
                data: chartData,
                backgroundColor: gradient,
                borderColor: 'rgba(0, 101, 101, 0.85)',
                borderWidth: 2,
                borderRadius: 5,
                hoverBackgroundColor: 'rgba(0, 101, 101, 0.45)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1a1a1a',
                    titleColor: '#fff',
                    bodyColor: '#ccc',
                    padding: 10,
                    callbacks: {
                        title: items => items[0].label,
                        label: ctx => ` ${ctx.raw} aktivita${ctx.raw !== 1 ? 's' : ''}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#94a3b8', font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,0.04)' }
                },
                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 9 },
                        maxRotation: 0,
                        // Only show every 5th label to avoid crowding
                        callback: function(val, index) {
                            return index % 5 === 0 ? this.getLabelForValue(val) : '';
                        }
                    },
                    grid: { display: false }
                }
            }
        }
    });

    // ── Micro-interactions ────────────────────────────────────────────
    document.querySelectorAll('button, a').forEach(btn => {
        btn.addEventListener('mousedown', () => btn.classList.add('scale-95'));
        btn.addEventListener('mouseup',   () => btn.classList.remove('scale-95'));
        btn.addEventListener('mouseleave',() => btn.classList.remove('scale-95'));
    });
</script>
</body></html>
