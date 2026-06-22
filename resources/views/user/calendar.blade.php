@include ('user.topbaruser')
<style>
        body { font-family: 'Inter', sans-serif; }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            border-top: 1px solid #bdc9c8;
            border-left: 1px solid #bdc9c8;
        }
        .calendar-day {
            border-right: 1px solid #bdc9c8;
            border-bottom: 1px solid #bdc9c8;
            min-height: 120px;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #00808033; border-radius: 10px; }
    </style>
<!-- Page Header & Filters -->
<div class="bg-surface px-container-padding py-6 flex flex-col gap-6 shadow-sm z-30">
<div class="flex justify-between items-center">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">Team Calendar</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Manage deadlines, meetings, and project milestones.</p>
</div>
<button class="bg-primary-container text-white px-6 py-2.5 rounded-lg flex items-center gap-2 hover:bg-primary transition-all shadow-sm active:scale-95">
<span class="material-symbols-outlined" data-icon="add">add</span>
<span class="font-label-md text-label-md">Add Event</span>
</button>
</div>
<div class="flex items-center justify-between border-t border-outline-variant pt-6">
<div class="flex items-center gap-4">
<div class="flex items-center gap-2 bg-surface-container-high px-4 py-2 rounded-full">
<a href="{{ route('user.calendar', ['date' => $currentDate->copy()->subMonth()->format('Y-m')]) }}" class="p-1 rounded-full hover:bg-surface-variant transition-colors flex items-center justify-center text-on-surface-variant">
    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
</a>
<span class="font-label-md text-label-md text-on-surface w-28 text-center">{{ $currentDate->format('F Y') }}</span>
<a href="{{ route('user.calendar', ['date' => $currentDate->copy()->addMonth()->format('Y-m')]) }}" class="p-1 rounded-full hover:bg-surface-variant transition-colors flex items-center justify-center text-on-surface-variant">
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
<div class="flex-1 overflow-auto custom-scrollbar bg-surface-container-lowest">
<div class="calendar-grid bg-outline-variant">
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

    // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
    $startDayOfWeek = $startOfMonth->dayOfWeek;
    $daysInMonth = $endOfMonth->day;

    // Group events by date (Y-m-d)
    $eventsByDate = collect($events ?? [])->groupBy(function($event) {
        return \Carbon\Carbon::parse($event->start_date)->format('Y-m-d');
    });
@endphp

<!-- Empty cells for start of month padding -->
@for ($i = 0; $i < $startDayOfWeek; $i++)
    <div class="calendar-day bg-surface-container-low opacity-50"></div>
@endfor

<!-- Days of the Month -->
@for ($day = 1; $day <= $daysInMonth; $day++)
    @php
        $dateStr = $currentDate->copy()->setDay($day)->format('Y-m-d');
        $dayEvents = $eventsByDate->get($dateStr, collect());
        $isToday = $dateStr === $today->format('Y-m-d');
    @endphp
    <div class="calendar-day bg-white p-2 flex flex-col gap-1.5 transition-colors hover:bg-surface-container-lowest {{ $isToday ? 'ring-1 ring-primary/20 ring-inset' : '' }}">
        <span class="font-label-md text-label-md {{ $isToday ? 'text-primary font-bold bg-primary/10 rounded-full w-6 h-6 flex items-center justify-center' : 'text-on-surface-variant p-1' }} self-end">{{ $day }}</span>
        
        @foreach($dayEvents as $event)
            @php
                $uc = [
                    'meeting'=>['bg-secondary/10','text-secondary','border-secondary'],
                    'lunch'=>['bg-tertiary/10','text-tertiary','border-tertiary'],
                    'exercise'=>['bg-primary/10','text-primary','border-primary'],
                    'outbound'=>['bg-[#d97706]/10','text-[#d97706]','border-[#d97706]'],
                    'movie_day'=>['bg-[#7c3aed]/10','text-[#7c3aed]','border-[#7c3aed]']
                ];
                [$ebg,$etxt,$eborder] = $uc[$event->type] ?? ['bg-outline/10','text-outline','border-outline'];
            @endphp
            <div class="event-item {{ $ebg }} {{ $etxt }} px-2 py-1 rounded text-[11px] font-medium border-l-2 {{ $eborder }} truncate cursor-pointer hover:opacity-80" data-type="{{ $event->type }}" title="{{ $event->title }}">
                {{ $event->title }}
            </div>
        @endforeach
    </div>
@endfor

<!-- Next month padding -->
@php
    $endDayOfWeek = $endOfMonth->dayOfWeek;
    $paddingEnd = 6 - $endDayOfWeek;
@endphp
@for ($i = 0; $i < $paddingEnd; $i++)
    <div class="calendar-day bg-surface-container-low opacity-50"></div>
@endfor

</div>
</div>
<!-- Sidebar / Details Panel (Contextual) -->
<aside class="w-80 bg-surface border-l border-outline-variant p-6 flex flex-col gap-6 overflow-y-auto custom-scrollbar">
<div>
<h3 class="font-headline-md text-headline-md text-on-background mb-4">Upcoming Events</h3>
@php
    $upcomingEvents = isset($events) ? $events->where('start_date', '>=', today())->take(8) : collect();
@endphp
@if($upcomingEvents->isEmpty())
    <div class="flex flex-col items-center gap-2 py-8">
        <span class="material-symbols-outlined text-4xl text-outline/40">event_busy</span>
        <p class="text-on-surface-variant text-xs text-center">Belum ada event mendatang.</p>
    </div>
@else
    <div class="space-y-3">
    @foreach($upcomingEvents as $ev)
    @php
        $uc = [
            'meeting'=>['bg-secondary/10','text-secondary','border-secondary'],
            'lunch'=>['bg-tertiary/10','text-tertiary','border-tertiary'],
            'exercise'=>['bg-primary/10','text-primary','border-primary'],
            'outbound'=>['bg-[#d97706]/10','text-[#d97706]','border-[#d97706]'],
            'movie_day'=>['bg-[#7c3aed]/10','text-[#7c3aed]','border-[#7c3aed]']
        ];
        [$ebg,$etxt,$eborder] = $uc[$ev->type] ?? ['bg-outline/10','text-outline','border-outline'];
    @endphp
    <div class="flex gap-3 p-3 rounded-xl {{ $ebg }} border-l-4 {{ $eborder }} upcoming-item" data-type="{{ $ev->type }}">
        <div class="flex-shrink-0 text-center">
            <p class="text-[10px] font-bold {{ $etxt }} uppercase">{{ $ev->start_date->format('M') }}</p>
            <p class="text-lg font-bold text-on-background leading-none">{{ $ev->start_date->format('d') }}</p>
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-semibold text-xs text-on-background truncate">{{ $ev->title }}</p>
            @if($ev->location)
                <p class="text-[10px] text-outline mt-0.5 truncate">📍 {{ $ev->location }}</p>
            @endif
            <span class="inline-block mt-1 px-1.5 py-0.5 rounded text-[10px] font-semibold {{ $ebg }} {{ $etxt }}">{{ ucfirst($ev->type) }}</span>
        </div>
    </div>
    @endforeach
    </div>
@endif
</div>
</div>
</div>
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
<!-- Micro-interaction Script -->
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

        document.addEventListener('DOMContentLoaded', () => {
            const calendarDays = document.querySelectorAll('.calendar-day:not(.opacity-50)');
            
            calendarDays.forEach(day => {
                day.addEventListener('click', (e) => {
                    // Avoid triggering if clicking an event
                    if (e.target.closest('.cursor-pointer')) return;
                    
                    // Simple highlight effect
                    calendarDays.forEach(d => d.classList.remove('bg-primary/5'));
                    day.classList.add('bg-primary/5');
                });
            });

            // Toggle active nav logic
            const navLinks = document.querySelectorAll('aside nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.forEach(l => {
                        l.className = "text-surface-variant hover:text-white flex items-center gap-3 px-4 py-3 hover:bg-on-secondary-fixed-variant/20 transition-colors duration-200 ease-in-out";
                    });
                    link.className = "border-l-4 border-primary bg-primary-container/10 text-primary-fixed font-semibold flex items-center gap-3 px-4 py-3 transition-colors duration-200 ease-in-out";
                });
            });
        });
    </script>
</body></html>