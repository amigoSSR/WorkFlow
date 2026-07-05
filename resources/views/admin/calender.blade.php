@include('admin.topbarAdmin')
<style>
    /* Calendar grid styles for consistent layout */
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 12px;
        padding: 12px;
    }
    .calendar-day {
        min-height: 120px;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: #ffffff;
    }
    .calendar-day.empty {
        background: transparent;
        opacity: 0.6;
    }
    .calendar-day .day-number {
        align-self: flex-end;
        padding: 6px;
        color: #6b7280;
    }
    .calendar-day .event {
        display: block;
        margin-top: 6px;
        font-size: 12px;
        padding: 6px 8px;
        border-radius: 6px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .calendar-day.today {
        box-shadow: 0 0 0 2px rgba(0,128,128,0.06) inset;
        border: 1px solid rgba(0,128,128,0.12);
    }
</style>
<!-- Page Header & Filters -->
<div class="bg-surface px-container-padding py-6 flex flex-col gap-6 shadow-sm z-30">
<div class="flex justify-between items-center">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">Team Calendar</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Manage deadlines, meetings, and project milestones.</p>
</div>
<button onclick="openModalWithDate('{{ date('Y-m-d') }}')" class="bg-primary-container text-white px-6 py-2.5 rounded-lg flex items-center gap-2 hover:bg-primary transition-all shadow-sm active:scale-95">
<span class="material-symbols-outlined" data-icon="add">add</span>
<span class="font-label-md text-label-md">Add Event</span>
</button>
</div>
<div class="flex items-center justify-between border-t border-outline-variant pt-6">
<div class="flex items-center gap-4">
<div class="flex items-center gap-2 bg-surface-container-high px-4 py-2 rounded-full">
<a href="{{ route('admin.calendar', ['date' => $currentDate->copy()->subMonth()->format('Y-m')]) }}" class="p-1 rounded-full hover:bg-surface-variant transition-colors flex items-center justify-center text-on-surface-variant">
    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
</a>
<span class="font-label-md text-label-md text-on-surface w-28 text-center">{{ $currentDate->format('F Y') }}</span>
<a href="{{ route('admin.calendar', ['date' => $currentDate->copy()->addMonth()->format('Y-m')]) }}" class="p-1 rounded-full hover:bg-surface-variant transition-colors flex items-center justify-center text-on-surface-variant">
    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
</a>
</div>
</div>
<div class="flex items-center gap-4">
<div class="flex items-center gap-2">
<span class="font-label-md text-label-md text-on-surface-variant">Filter by:</span>
<select id="eventFilter" class="bg-surface border border-outline-variant rounded-lg text-body-md py-1.5 pl-3 pr-8 focus:ring-1 focus:ring-primary" onchange="filterEvents(this.value)">
<option value="all">Semua Tipe</option>
<option value="meeting">Meeting</option>
<option value="lunch">Lunch</option>
<option value="exercise">Exercise</option>
<option value="outbound">Outbound</option>
<option value="movie_day">Movie Day</option>
</select>
</div>
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Corporate professional avatar, male, tech-focused, minimalist background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3vPiktKzKiJ8yh1eowN5DqQOSGFtiaw2dzwSpuZhKZ5yYb8hCiCewSSm2DL4RIrj53nhPzG859JF23cQHzgpIu2U8-EoNktq6u1XiB_sZLEzfpDqBxdtTOVF-LSjnkmenqQQKj-9x-ygxdH8mpsRZiUw07zGaGNb21tRsKiQyeFT4YsIGHnbK0tgIaFcwJx7xE0q6liXJPNA1Eu9HqLdXxpAEqy0zeq-hwcdncgnRTwdT7reCuBHwDT91s2hW178EK64AgEbEBfI"/>
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Corporate professional avatar, female, engineering leader, minimalist background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOSfr1I3iznJqKjUX8Ni074zpBSQQ6eND-e0wZxomtgyYq8BYyDy8bo-aADTtmU_n7OXaKnXnVInfpFqAoCJF8O_squlkrEQdLnhBIVFRIoEhXh5_IHu_NF3yg5r2DeFOUbG51CT1MjvdLYdmok5R2T6ZpdWxsGhVkcu1mAh3S_2dHFEJgaQRL6Oob2Dykf8s9OlUv-AuEdyWK8etSfUPd1dF5G2-Xgp01InXbMfghXOan1gcb1PvQeMj4qfubpjB73PTZ1GUM3uw"/>
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Corporate professional avatar, male, designer, minimalist background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJgNYm7YGJCfwe3rIgHCCjz0JtIC0cPWpfmIekP6VkAsV7wJRXOr-hGbFnJoOJGb3UUXUHRBL7WgtNZ00Ss7XhSxtis8kEy1HG2MRpklGUjzWF3e7gSNYXwDfsvvAjYF0Wc8U8za0kzbd1NxnSwLs_NTw0HSyEyGY8OLPVECbjiC0GWPdJsFNL9Bi1YnAul0_RSbn_LaCBzxutHxFvAOwgHTDidq4EgmJ0fzg-odtycISFMEbZ-HdVcaLTrrx_WEvKaI1WpNiomJw"/>
<div class="w-8 h-8 rounded-full bg-secondary-container border-2 border-white flex items-center justify-center text-[10px] font-bold text-on-secondary-container">+12</div>
</div>
</div>
</div>
</div>
<!-- Calendar Grid -->
<div class="flex-1 overflow-auto custom-scrollbar bg-surface-container-lowest p-4">
<div class="calendar-grid bg-outline-variant rounded-lg">
<!-- Day Headers -->
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">SUN</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">MON</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">TUE</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">WED</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">THU</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">FRI</div>
<div class="bg-surface-container py-3 text-center font-label-md text-label-md text-on-surface-variant calendar-day !min-h-0">SAT</div>

@php
    $today = \Carbon\Carbon::today();
    // $currentDate is passed from controller
    $startOfMonth = $currentDate->copy()->startOfMonth();
    $endOfMonth = $currentDate->copy()->endOfMonth();

    $startDayOfWeek = $startOfMonth->dayOfWeek;
    $daysInMonth = $endOfMonth->day;

    $eventsByDate = collect($events ?? [])->groupBy(function($event) {
        return \Carbon\Carbon::parse($event->start_date)->format('Y-m-d');
    });
@endphp

<!-- Empty cells -->
@for ($i = 0; $i < $startDayOfWeek; $i++)
    <div class="calendar-day empty"></div>
@endfor

<!-- Days -->
@for ($day = 1; $day <= $daysInMonth; $day++)
    @php
        $dateStr = $currentDate->copy()->setDay($day)->format('Y-m-d');
        $dayEvents = $eventsByDate->get($dateStr, collect());
        $isToday = $dateStr === $today->format('Y-m-d');
    @endphp
    <div class="calendar-day p-2 transition-colors hover:bg-surface-container-lowest cursor-pointer {{ $isToday ? 'today' : '' }}" onclick="openModalWithDate('{{ $dateStr }}')">
        <span class="day-number" @if($isToday) style="background:rgba(0,101,101,0.08);color:#006565;padding:6px 8px;border-radius:9999px;" @endif>{{ $day }}</span>
        
        @foreach($dayEvents as $event)
            @php
                $uc = [
                    'meeting'=>['rgba(69,95,136,0.08)','#455f88'],
                    'lunch'=>['rgba(139,72,35,0.08)','#8b4823'],
                    'exercise'=>['rgba(0,101,101,0.08)','#006565'],
                    'outbound'=>['rgba(217,119,6,0.08)','#d97706'],
                    'movie_day'=>['rgba(124,58,237,0.08)','#7c3aed']
                ];
                [$ebg,$etxt] = $uc[$event->type] ?? ['rgba(0,0,0,0.05)','#000'];
            @endphp
            <div class="event event-item cursor-pointer group relative" data-type="{{ $event->type }}" 
                data-title="{{ $event->title }}"
                data-date="{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}"
                data-location="{{ $event->location }}"
                data-desc="{{ $event->description }}"
                style="background:{{ $ebg }};color:{{ $etxt }};border-left:4px solid {{ $etxt }}" 
                onclick="event.stopPropagation(); openEventDetailModal(this)">
                <div class="flex items-center justify-between">
                    <span class="truncate">{{ $event->title }}</span>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Hapus event ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="opacity-0 group-hover:opacity-100 material-symbols-outlined text-[14px] ml-1 hover:text-error transition-opacity">delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endfor

<!-- Next month padding -->
@php
    $paddingEnd = 6 - $endOfMonth->dayOfWeek;
@endphp
@for ($i = 0; $i < $paddingEnd; $i++)
    <div class="calendar-day empty"></div>
@endfor

</div>
</div>

<!-- Sidebar / Details Panel (Contextual) -->
<aside class="w-96 bg-surface border-l border-outline-variant p-6 flex flex-col gap-6 overflow-y-auto custom-scrollbar">
<div>
<h3 class="font-headline-md text-headline-md text-on-background mb-4">Upcoming Events</h3>
@php
    $upcomingEvents = collect($events)->where('start_date', '>=', today())->take(5);
@endphp

@if($upcomingEvents->isEmpty())
    <div class="py-8 text-center text-on-surface-variant text-sm">
        Belum ada event mendatang.
    </div>
@else
<div class="space-y-4">
    @foreach($upcomingEvents as $ev)
        @php
            $uc = [
                'meeting'=>['text-secondary'],
                'lunch'=>['text-tertiary'],
                'exercise'=>['text-primary'],
                'outbound'=>['text-[#d97706]'],
                'movie_day'=>['text-[#7c3aed]']
            ];
            [$etxt] = $uc[$ev->type] ?? ['text-on-surface-variant'];
        @endphp
        <div class="flex gap-4 group upcoming-item" data-type="{{ $ev->type }}">
            <div class="flex flex-col items-center">
            <span class="text-label-md font-bold {{ $etxt }}">{{ \Carbon\Carbon::parse($ev->start_date)->format('d') }}</span>
            <span class="text-[10px] text-on-surface-variant uppercase">{{ \Carbon\Carbon::parse($ev->start_date)->format('D') }}</span>
            </div>
            <div class="bg-white p-3 rounded-lg border border-outline-variant flex-1 shadow-sm transition-all overflow-hidden">
                <p class="font-label-md text-label-md text-on-surface mb-1 truncate" title="{{ $ev->title }}">{{ $ev->title }}</p>
                <div class="text-[11px] text-on-surface-variant flex flex-col gap-1 w-full">
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px] shrink-0">label</span> {{ ucfirst($ev->type) }}</span>
                    @if($ev->location)
                        <span class="flex items-center gap-1 overflow-hidden" title="{{ $ev->location }}">
                            <span class="material-symbols-outlined text-[14px] shrink-0">location_on</span> 
                            <span class="truncate">{{ $ev->location }}</span>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-background mb-4">Project Legends</h3>
<div class="space-y-3">
<div class="flex items-center gap-3">
<div class="w-3 h-3 rounded-full bg-secondary"></div>
<span class="text-body-md font-body-md text-on-surface-variant">Meeting</span>
</div>
<div class="flex items-center gap-3">
<div class="w-3 h-3 rounded-full bg-tertiary"></div>
<span class="text-body-md font-body-md text-on-surface-variant">Lunch</span>
</div>
<div class="flex items-center gap-3">
<div class="w-3 h-3 rounded-full bg-primary"></div>
<span class="text-body-md font-body-md text-on-surface-variant">Exercise</span>
</div>
<div class="flex items-center gap-3">
<div class="w-3 h-3 rounded-full bg-[#d97706]"></div>
<span class="text-body-md font-body-md text-on-surface-variant">Outbound</span>
</div>
<div class="flex items-center gap-3">
<div class="w-3 h-3 rounded-full bg-[#7c3aed]"></div>
<span class="text-body-md font-body-md text-on-surface-variant">Movie Day</span>
</div>
</div>
</div>
</aside>
</main>

{{-- MODAL ADD EVENT --}}
<div id="eventModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-on-background/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-5 border-b border-outline-variant/30 flex items-center justify-between bg-surface-container-low/40">
            <h3 class="font-headline-md text-headline-md text-on-background">Tambah Event Baru</h3>
            <button onclick="document.getElementById('eventModal').classList.add('hidden')" class="text-on-surface-variant hover:text-error transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto custom-scrollbar">
            <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="title">Judul Event <span class="text-error">*</span></label>
                    <input id="title" name="title" type="text" required class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary"/>
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5">Tipe Event <span class="text-error">*</span></label>
                    <div class="grid grid-cols-2 gap-2" id="typeSelector">
                        @foreach(['meeting' => ['Meeting','text-secondary bg-secondary/10 border-secondary'], 'lunch' => ['Lunch','text-tertiary bg-tertiary/10 border-tertiary'], 'exercise' => ['Exercise','text-primary bg-primary/10 border-primary'], 'outbound' => ['Outbound','text-[#d97706] bg-[#d97706]/10 border-[#d97706]'], 'movie_day' => ['Movie Day','text-[#7c3aed] bg-[#7c3aed]/10 border-[#7c3aed]']] as $val => $cfg)
                        <label class="type-option flex items-center gap-2 p-3 rounded-xl border-2 cursor-pointer border-outline-variant/50 hover:border-outline transition-all">
                            <input type="radio" name="type" value="{{ $val }}" class="sr-only" required>
                            <span class="font-label-md text-label-md">{{ $cfg[0] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="start_date">Tanggal Event <span class="text-error">*</span></label>
                    <input id="start_date" name="start_date" type="date" required class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary"/>
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="location">Lokasi / Link</label>
                    <input id="location" name="location" type="text" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary"/>
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface-variant uppercase mb-1.5" for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="2" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 outline-none focus:border-primary resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:brightness-110 transition-all active:scale-95">Simpan Event</button>
            </form>
        </div>
    </div>
</div>

{{-- MODAL DETAIL EVENT --}}
<div id="eventDetailModal" class="hidden fixed inset-0 z-[105] flex items-center justify-center p-4 bg-on-background/40 backdrop-blur-sm" onclick="closeEventDetailModal()">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden flex flex-col max-h-[90vh]" onclick="event.stopPropagation()">
        <div class="px-6 py-5 border-b border-outline-variant/30 flex items-center justify-between bg-surface-container-low/40">
            <h3 class="font-headline-md text-headline-md text-on-background">Detail Event</h3>
            <button onclick="closeEventDetailModal()" class="text-on-surface-variant hover:text-error transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto custom-scrollbar space-y-5">
            <div>
                <p class="text-[11px] font-bold text-primary uppercase tracking-widest mb-1" id="detailType">MEETING</p>
                <h4 class="font-headline-lg text-[22px] text-on-surface leading-tight" id="detailTitle">Event Title</h4>
            </div>
            
            <div class="flex items-start gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined text-[20px] text-primary mt-0.5">calendar_today</span>
                <div>
                    <p class="font-label-md text-[13px] uppercase tracking-wider text-outline mb-0.5">Tanggal</p>
                    <p class="text-body-md font-semibold text-on-surface" id="detailDate">12 Oct 2023</p>
                </div>
            </div>

            <div class="flex items-start gap-3 text-on-surface-variant" id="detailLocationContainer">
                <span class="material-symbols-outlined text-[20px] text-primary mt-0.5">location_on</span>
                <div class="w-full overflow-hidden">
                    <p class="font-label-md text-[13px] uppercase tracking-wider text-outline mb-0.5">Lokasi / Link</p>
                    <p class="text-body-md font-semibold text-on-surface break-words" id="detailLocation">Room 304</p>
                </div>
            </div>

            <div class="flex items-start gap-3 text-on-surface-variant" id="detailDescContainer">
                <span class="material-symbols-outlined text-[20px] text-primary mt-0.5">notes</span>
                <div class="w-full">
                    <p class="font-label-md text-[13px] uppercase tracking-wider text-outline mb-0.5">Deskripsi</p>
                    <p class="text-body-md text-on-surface" id="detailDesc">Deskripsi event...</p>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-outline-variant/30 bg-surface-container-lowest flex justify-end">
            <button onclick="closeEventDetailModal()" class="px-6 py-2 bg-surface-container-highest hover:bg-surface-variant text-on-surface font-semibold rounded-lg transition-colors">Tutup</button>
        </div>
    </div>
</div>

<style>
.type-option input:checked ~ * { font-weight: 700; }
</style>
<script>
function filterEvents(type) {
    const events = document.querySelectorAll('.event-item, .upcoming-item');
    events.forEach(el => {
        if (type === 'all' || el.getAttribute('data-type') === type) {
            el.style.display = '';
        } else {
            el.style.display = 'none';
        }
    });
}

function openModalWithDate(date) {
    document.getElementById('start_date').value = date;
    document.getElementById('eventModal').classList.remove('hidden');
}

function openEventDetailModal(element) {
    const title = element.getAttribute('data-title');
    const type = element.getAttribute('data-type');
    const date = element.getAttribute('data-date');
    const location = element.getAttribute('data-location');
    const desc = element.getAttribute('data-desc');

    document.getElementById('detailTitle').textContent = title;
    document.getElementById('detailType').textContent = type.replace('_', ' ');
    document.getElementById('detailDate').textContent = date;
    
    const locContainer = document.getElementById('detailLocationContainer');
    if (location) {
        locContainer.style.display = 'flex';
        const locEl = document.getElementById('detailLocation');
        if (location.startsWith('http://') || location.startsWith('https://')) {
            locEl.innerHTML = `<a href="${location}" target="_blank" class="text-primary hover:underline break-all">${location}</a>`;
        } else {
            locEl.textContent = location;
        }
    } else {
        locContainer.style.display = 'none';
    }

    const descContainer = document.getElementById('detailDescContainer');
    if (desc) {
        descContainer.style.display = 'flex';
        document.getElementById('detailDesc').textContent = desc;
    } else {
        descContainer.style.display = 'none';
    }

    document.getElementById('eventDetailModal').classList.remove('hidden');
}

function closeEventDetailModal() {
    document.getElementById('eventDetailModal').classList.add('hidden');
}

document.querySelectorAll('.type-option input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', () => {
        document.querySelectorAll('.type-option').forEach(label => {
            label.className = label.className.replace(/border-\S+/g, '').replace(/text-\S+/g, '').replace(/bg-\S+\/\S+/g, '').trim();
            label.classList.add('border-outline-variant/50', 'hover:border-outline');
        });
        const colorMap = {
            meeting:   ['text-secondary', 'bg-secondary/10', 'border-secondary'],
            lunch:     ['text-tertiary',  'bg-tertiary/10',  'border-tertiary'],
            exercise:  ['text-primary',   'bg-primary/10',   'border-primary'],
            outbound:  ['text-[#d97706]', 'bg-[#d97706]/10', 'border-[#d97706]'],
            movie_day: ['text-[#7c3aed]', 'bg-[#7c3aed]/10', 'border-[#7c3aed]'],
        };
        const selected = radio.closest('.type-option');
        selected.classList.remove('border-outline-variant/50', 'hover:border-outline');
        (colorMap[radio.value] || []).forEach(c => selected.classList.add(c));
    });
});
</script>
</body></html>