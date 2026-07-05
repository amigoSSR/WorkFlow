@include('user.topbaruser')
<!-- Content Canvas -->
<div class="p-container-padding space-y-card-gap">

<!-- Title Row (read-only — no action buttons) -->
<div class="flex justify-between items-end">
    <div>
        <h2 class="font-headline-xl text-headline-xl text-on-background">Jadwal Piket - Monitoring Mingguan</h2>
        <p class="font-body-md text-body-md text-outline">Lihat jadwal rotasi tim di setiap zona operasional.</p>
    </div>
    <div class="flex items-center gap-2 px-4 py-2 border border-outline rounded-lg bg-white text-on-surface-variant text-body-md">
        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
        <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</span>
    </div>
</div>

<!-- Bento Grid Layout -->
<div class="grid grid-cols-12 gap-card-gap">

<!-- Main Schedule View (Span 9) -->
<div class="col-span-9 space-y-card-gap">

<!-- Weekly Grid -->
<div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] overflow-hidden">

    <!-- Day Headers -->
    <div class="grid grid-cols-7 border-b border-outline-variant">
        @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $idx => $dayLabel)
        <div class="p-4 text-center {{ $idx < 6 ? 'border-r' : '' }} border-outline-variant {{ $dayLabel === date('D') ? 'bg-primary-container text-on-primary-container' : 'bg-surface-container-low text-outline' }}">
            <p class="text-label-md font-bold uppercase tracking-wider">{{ $dayLabel }}</p>
        </div>
        @endforeach
    </div>

    <!-- Calendar Slots -->
    <div class="grid grid-cols-7 h-[580px]">

        @php
            function getUserZoneStyle($zone) {
                $z = strtolower($zone);
                if (str_contains($z, 'server'))  return ['bg-secondary-container/20', 'border-secondary',  'text-secondary'];
                if (str_contains($z, 'break'))   return ['bg-tertiary-container/20',  'border-tertiary',   'text-tertiary'];
                if (str_contains($z, 'meeting')) return ['bg-primary-container/20',   'border-primary',    'text-primary'];
                return ['bg-surface-container', 'border-outline', 'text-on-surface'];
            }
        @endphp

        {{-- Senin – Kamis --}}
        @foreach(['senin', 'selasa', 'rabu', 'kamis'] as $dayKey)
        <div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
            @forelse($schedule[$dayKey] as $piket)
                @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }}">
                    <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                    <p class="text-body-md font-semibold text-on-surface">{{ optional($piket->user)->name }}</p>
                </div>
            @empty
                <div class="flex items-center justify-center h-full">
                    <p class="text-outline text-label-md italic text-center">—</p>
                </div>
            @endforelse
        </div>
        @endforeach

        {{-- Jumat (Ganjil / Genap split) --}}
        <div class="border-r border-outline-variant flex flex-col">
            <div class="flex-1 p-2 space-y-2 border-b border-outline-variant overflow-y-auto custom-scrollbar relative">
                <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                    <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Ganjil</p>
                </div>
                @forelse($schedule['jumat_ganjil'] as $piket)
                    @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                    <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }}">
                        <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                        <p class="text-body-md font-semibold text-on-surface">{{ optional($piket->user)->name }}</p>
                    </div>
                @empty
                    <p class="text-outline text-label-md italic text-center mt-2">—</p>
                @endforelse
            </div>
            <div class="flex-1 p-2 space-y-2 overflow-y-auto custom-scrollbar relative">
                <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                    <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Genap</p>
                </div>
                @forelse($schedule['jumat_genap'] as $piket)
                    @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                    <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }}">
                        <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                        <p class="text-body-md font-semibold text-on-surface">{{ optional($piket->user)->name }}</p>
                    </div>
                @empty
                    <p class="text-outline text-label-md italic text-center mt-2">—</p>
                @endforelse
            </div>
        </div>

        {{-- Sabtu (Ganjil / Genap split) --}}
        <div class="border-r border-outline-variant flex flex-col">
            <div class="flex-1 p-2 space-y-2 border-b border-outline-variant overflow-y-auto custom-scrollbar relative">
                <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                    <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Ganjil</p>
                </div>
                @forelse($schedule['sabtu_ganjil'] as $piket)
                    @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                    <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }}">
                        <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                        <p class="text-body-md font-semibold text-on-surface">{{ optional($piket->user)->name }}</p>
                    </div>
                @empty
                    <p class="text-outline text-label-md italic text-center mt-2">—</p>
                @endforelse
            </div>
            <div class="flex-1 p-2 space-y-2 overflow-y-auto custom-scrollbar relative">
                <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                    <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Genap</p>
                </div>
                @forelse($schedule['sabtu_genap'] as $piket)
                    @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                    <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }}">
                        <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                        <p class="text-body-md font-semibold text-on-surface">{{ optional($piket->user)->name }}</p>
                    </div>
                @empty
                    <p class="text-outline text-label-md italic text-center mt-2">—</p>
                @endforelse
            </div>
        </div>

        {{-- Minggu (Off) --}}
        <div class="p-2 bg-surface-container-lowest/50 flex items-center justify-center">
            <div class="text-center">
                <span class="material-symbols-outlined text-[28px] text-outline/40 block mb-1">weekend</span>
                <p class="text-outline text-label-md italic">No Rotation</p>
            </div>
        </div>

    </div><!-- end grid slots -->
</div><!-- end weekly grid card -->

<!-- Zone Legend -->
<div class="bg-white p-5 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
    <h3 class="font-headline-md text-headline-md mb-4">Keterangan Zona</h3>
    <div class="flex flex-wrap gap-4">
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-secondary"></span>
            <span class="text-label-md text-outline">Server Room</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-primary"></span>
            <span class="text-label-md text-outline">Meeting Pods</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-tertiary"></span>
            <span class="text-label-md text-outline">Break Area</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-outline-variant"></span>
            <span class="text-label-md text-outline">Zona Lain</span>
        </div>
        <div class="ml-auto flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg">
            <span class="material-symbols-outlined text-[16px] text-primary">info</span>
            <span class="text-label-md text-on-surface-variant">View Only — Jadwal dikelola oleh Admin</span>
        </div>
    </div>
</div>

</div><!-- end col-span-9 -->

<!-- Side Panel (Span 3) -->
<div class="col-span-3 space-y-card-gap">

    <!-- Summary Card -->
    <div class="bg-primary text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h4 class="text-label-md font-bold uppercase opacity-80 mb-1">Total Assignments</h4>
            <div class="text-headline-xl font-headline-xl mb-4">
                {{ collect($schedule)->flatten()->count() }}
            </div>
            <div class="space-y-2">
                @php
                    $totalSlots = 6; // senin-kamis(4) + jumat(1) + sabtu(1)
                    $filled     = collect($schedule)->flatten()->count();
                @endphp
                <div class="flex justify-between items-center text-body-md">
                    <span>Slot Terisi</span>
                    <span class="font-bold">{{ $filled }}</span>
                </div>
                <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-primary-fixed h-full rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="absolute -right-8 -bottom-8 opacity-10">
            <span class="material-symbols-outlined text-[120px]">verified_user</span>
        </div>
    </div>

    <!-- Piket Hari Ini -->
    @php
        $todayDayId = strtolower(\Carbon\Carbon::today()->locale('id')->isoFormat('dddd'));
        $dayMap = ['senin'=>'senin','selasa'=>'selasa','rabu'=>'rabu','kamis'=>'kamis','jumat'=>'jumat','sabtu'=>'sabtu'];
        $todayKey = $dayMap[$todayDayId] ?? null;
        $weekNum  = (int) \Carbon\Carbon::today()->weekOfYear;
        $wType    = ($weekNum % 2 !== 0) ? 'ganjil' : 'genap';

        $todayPikets = collect();
        if ($todayKey) {
            if (in_array($todayKey, ['senin','selasa','rabu','kamis'])) {
                $todayPikets = collect($schedule[$todayKey]);
            } elseif ($todayKey === 'jumat') {
                $todayPikets = collect($schedule['jumat_' . $wType]);
            } elseif ($todayKey === 'sabtu') {
                $todayPikets = collect($schedule['sabtu_' . $wType]);
            }
        }
    @endphp
    <div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
        <div class="flex items-center gap-2 mb-4">
            <span class="material-symbols-outlined text-primary text-[20px]">today</span>
            <h3 class="font-headline-md text-headline-md">Piket Hari Ini</h3>
        </div>
        <p class="text-[12px] text-on-surface-variant mb-3 capitalize">
            {{ ucfirst($todayDayId) }}, {{ \Carbon\Carbon::today()->format('d M Y') }}
            @if(in_array($todayKey, ['jumat','sabtu']))
                <span class="ml-1 px-1.5 py-0.5 bg-primary/10 text-primary rounded text-[10px] font-bold uppercase">
                    Minggu {{ ucfirst($wType) }}
                </span>
            @endif
        </p>
        <div class="space-y-3">
            @forelse($todayPikets as $piket)
                @php [$bg, $border, $text] = getUserZoneStyle($piket->zone); @endphp
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-[13px] shrink-0">
                        {{ strtoupper(substr(optional($piket->user)->name ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-body-md font-semibold text-on-background truncate">{{ optional($piket->user)->name ?? 'Unknown' }}</p>
                        <span class="inline-block mt-0.5 px-2 py-0.5 text-[10px] font-bold rounded {{ $bg }} {{ $text }} uppercase">
                            {{ $piket->zone }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center py-4 text-center">
                    <span class="material-symbols-outlined text-[32px] text-outline/40 mb-1">
                        {{ $todayDayId === 'minggu' ? 'weekend' : 'cleaning_services' }}
                    </span>
                    <p class="text-body-md text-on-surface-variant text-sm">
                        {{ $todayDayId === 'minggu' ? 'Tidak ada piket hari Minggu' : 'Belum ada jadwal hari ini' }}
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-surface-container-low border border-outline-variant p-5 rounded-xl">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-primary text-[22px] mt-0.5">info</span>
            <div>
                <p class="text-body-md font-semibold text-on-background mb-1">Read Only</p>
                <p class="text-[12px] text-on-surface-variant leading-relaxed">
                    Jadwal piket dikelola oleh Admin. Jika ada perubahan atau pertanyaan, hubungi Admin.
                </p>
            </div>
        </div>
    </div>

</div><!-- end col-span-3 -->

</div><!-- end grid-cols-12 -->
</div><!-- end container -->
</main>
</body></html>