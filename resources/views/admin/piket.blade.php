@include('admin.topbarAdmin')

<!-- Main Content Area -->
<main class="min-h-screen flex flex-col pb-12">
<!-- Content Canvas -->
<div class="p-container-padding space-y-card-gap pt-24">
<!-- Title and Action Row -->
<div class="flex justify-between items-end">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">Jadwal Piket - Monitoring Mingguan</h2>
<p class="font-body-md text-body-md text-outline">Manage and monitor team rotations across operational zones.</p>
</div>
<div class="flex gap-3">
<button class="px-4 py-2 border border-outline rounded-lg flex items-center gap-2 font-label-md text-label-md hover:bg-surface-container transition-all">
<span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        This Week
                    </button>
<button onclick="document.getElementById('assignModal').classList.remove('hidden')" class="px-6 py-2 bg-primary text-white rounded-lg flex items-center gap-2 font-label-md text-label-md hover:bg-primary/90 shadow-sm transition-all active:scale-95">
<span class="material-symbols-outlined text-[18px]">person_add</span>
                        Assign Member
                    </button>
</div>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="p-4 bg-green-100 text-green-700 border-l-4 border-green-500 rounded-r-lg mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="p-4 bg-red-100 text-red-700 border-l-4 border-red-500 rounded-r-lg mb-4">
        {{ session('error') }}
    </div>
@endif
@if($errors->any())
    <div class="p-4 bg-red-100 text-red-700 border-l-4 border-red-500 rounded-r-lg mb-4">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Bento Grid Layout -->
<div class="grid grid-cols-12 gap-card-gap">
<!-- Main Schedule View (Span 9) -->
<div class="col-span-9 space-y-card-gap">
<!-- Weekly Calendar -->
<div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] overflow-hidden">
<div class="grid grid-cols-7 border-b border-outline-variant">
<!-- Header -->
@foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $idx => $dayLabel)
    <div class="p-4 text-center {{ $idx < 6 ? 'border-r' : '' }} border-outline-variant {{ $dayLabel === date('D') ? 'bg-primary-container text-on-primary-container' : 'bg-surface-container-low text-outline' }}">
    <p class="text-label-md font-bold uppercase tracking-wider">{{ $dayLabel }}</p>
    </div>
@endforeach
</div>

<!-- Calendar Slots -->
<div class="grid grid-cols-7 h-[600px]">

    @php
        function getZoneStyle($zone) {
            $z = strtolower($zone);
            if(str_contains($z, 'server')) return ['bg-secondary-container/20', 'border-secondary', 'text-secondary'];
            if(str_contains($z, 'break')) return ['bg-tertiary-container/20', 'border-tertiary', 'text-tertiary'];
            if(str_contains($z, 'meeting')) return ['bg-primary-container/20', 'border-primary', 'text-primary'];
            return ['bg-surface-container', 'border-outline', 'text-on-surface'];
        }
    @endphp

    {{-- Senin sampai Kamis --}}
    @foreach(['senin', 'selasa', 'rabu', 'kamis'] as $dayKey)
    <div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
        @foreach($schedule[$dayKey] as $piket)
            @php [$bg, $border, $text] = getZoneStyle($piket->zone); @endphp
            <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }} relative group">
                <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                <p class="text-body-md font-semibold text-on-surface">{{ $piket->user->name }}</p>
                <form action="{{ route('admin.piket.destroy', $piket) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus piket ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-error hover:text-red-700">
                        <span class="material-symbols-outlined text-[16px]">delete</span>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
    @endforeach

    {{-- Jumat (Split Vertikal) --}}
    <div class="border-r border-outline-variant flex flex-col">
        <div class="flex-1 p-2 space-y-2 border-b border-outline-variant overflow-y-auto custom-scrollbar relative">
            <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Ganjil</p>
            </div>
            @foreach($schedule['jumat_ganjil'] as $piket)
                @php [$bg, $border, $text] = getZoneStyle($piket->zone); @endphp
                <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }} relative group">
                    <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                    <p class="text-body-md font-semibold text-on-surface">{{ $piket->user->name }}</p>
                    <form action="{{ route('admin.piket.destroy', $piket) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-error hover:text-red-700"><span class="material-symbols-outlined text-[16px]">delete</span></button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="flex-1 p-2 space-y-2 overflow-y-auto custom-scrollbar relative">
            <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Genap</p>
            </div>
            @foreach($schedule['jumat_genap'] as $piket)
                @php [$bg, $border, $text] = getZoneStyle($piket->zone); @endphp
                <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }} relative group">
                    <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                    <p class="text-body-md font-semibold text-on-surface">{{ $piket->user->name }}</p>
                    <form action="{{ route('admin.piket.destroy', $piket) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-error hover:text-red-700"><span class="material-symbols-outlined text-[16px]">delete</span></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Sabtu (Split Vertikal) --}}
    <div class="border-r border-outline-variant flex flex-col">
        <div class="flex-1 p-2 space-y-2 border-b border-outline-variant overflow-y-auto custom-scrollbar relative">
            <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Ganjil</p>
            </div>
            @foreach($schedule['sabtu_ganjil'] as $piket)
                @php [$bg, $border, $text] = getZoneStyle($piket->zone); @endphp
                <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }} relative group">
                    <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                    <p class="text-body-md font-semibold text-on-surface">{{ $piket->user->name }}</p>
                    <form action="{{ route('admin.piket.destroy', $piket) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-error hover:text-red-700"><span class="material-symbols-outlined text-[16px]">delete</span></button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="flex-1 p-2 space-y-2 overflow-y-auto custom-scrollbar relative">
            <div class="sticky top-0 bg-white/90 backdrop-blur-sm z-10 -mx-2 -mt-2 p-2 pb-1 mb-2 border-b border-outline-variant/30">
                <p class="text-[10px] font-bold text-outline uppercase text-center">Minggu Genap</p>
            </div>
            @foreach($schedule['sabtu_genap'] as $piket)
                @php [$bg, $border, $text] = getZoneStyle($piket->zone); @endphp
                <div class="{{ $bg }} p-2 rounded border-l-4 {{ $border }} relative group">
                    <p class="text-[10px] font-bold {{ $text }} uppercase">{{ $piket->zone }}</p>
                    <p class="text-body-md font-semibold text-on-surface">{{ $piket->user->name }}</p>
                    <form action="{{ route('admin.piket.destroy', $piket) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-error hover:text-red-700"><span class="material-symbols-outlined text-[16px]">delete</span></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Minggu (Off) --}}
    <div class="p-2 bg-surface-container-lowest/50 flex items-center justify-center">
        <p class="text-outline text-label-md italic">No Rotation</p>
    </div>

</div>
</div>

</div>

<!-- Side Panel (Span 3) -->
<div class="col-span-3 space-y-card-gap">
<!-- Statistics Card -->
<div class="bg-primary text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
<div class="relative z-10">
<h4 class="text-label-md font-bold uppercase opacity-80 mb-1">Total Assignments</h4>
<div class="text-headline-xl font-headline-xl mb-4">
    {{ collect($schedule)->flatten()->count() }}
</div>
<div class="space-y-3">
<div class="w-full bg-white/20 h-1 rounded-full overflow-hidden">
<div class="bg-primary-fixed h-full" style="width: 100%"></div>
</div>
</div>
</div>
<div class="absolute -right-8 -bottom-8 opacity-10">
<span class="material-symbols-outlined text-[120px]">verified_user</span>
</div>
</div>

<!-- Staff on Duty List -->
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<h3 class="font-headline-md text-headline-md mb-4">All Users</h3>
<div class="space-y-4 max-h-[400px] overflow-y-auto custom-scrollbar pr-2">
@foreach($users as $user)
<div class="flex items-center gap-3 group cursor-pointer">
<div class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center text-on-surface-variant font-bold">
    {{ substr($user->name, 0, 1) }}
</div>
<div>
<p class="text-body-md font-semibold group-hover:text-primary transition-colors">{{ $user->name }}</p>
<p class="text-[11px] text-outline">{{ $user->email }}</p>
</div>
</div>
@endforeach
</div>
</div>

</div>
</div>
</div>
</main>

{{-- MODAL ASSIGN MEMBER --}}
<div id="assignModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-on-background/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-outline-variant/30 flex items-center justify-between bg-surface-container-low/40">
            <h3 class="font-headline-md text-headline-md text-on-background">Assign Member to Piket</h3>
            <button onclick="document.getElementById('assignModal').classList.add('hidden')" class="text-on-surface-variant hover:text-error transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.piket.store') }}" method="POST" class="space-y-5">
                @csrf
                
                {{-- User --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="user_id">Pilih User <span class="text-error">*</span></label>
                    <select id="user_id" name="user_id" required class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary">
                        <option value="" disabled selected>Pilih salah satu user...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Day & Week Type --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="day_type">Pilih Hari Piket <span class="text-error">*</span></label>
                    <select id="day_type" name="day_type" required class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary">
                        <option value="" disabled selected>Pilih hari...</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <optgroup label="Jumat">
                            <option value="jumat_ganjil">Jumat (Minggu Ganjil)</option>
                            <option value="jumat_genap">Jumat (Minggu Genap)</option>
                        </optgroup>
                        <optgroup label="Sabtu">
                            <option value="sabtu_ganjil">Sabtu (Minggu Ganjil)</option>
                            <option value="sabtu_genap">Sabtu (Minggu Genap)</option>
                        </optgroup>
                    </select>
                </div>

                {{-- Zone --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="zone">Pilih Zona <span class="text-error">*</span></label>
                    <select id="zone" name="zone" required class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary">
                        <option value="" disabled selected>Pilih zona kerja...</option>
                        <option value="Server Room">Server Room</option>
                        <option value="Break Area">Break Area</option>
                        <option value="Meeting Pods">Meeting Pods</option>
                        <option value="Outdoor Lounge">Outdoor Lounge</option>
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:brightness-110 shadow-sm transition-all active:scale-95">Simpan Jadwal Piket</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body></html>