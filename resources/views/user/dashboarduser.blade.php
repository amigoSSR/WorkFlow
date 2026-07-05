@include ('user.topbaruser')
<div class="p-container-padding space-y-8">
<!-- Welcome Hero & CTA -->
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">My Projects</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">You have {{ $todoMilestones->count() + $doingMilestones->count() }} active tasks across {{ $activeProjects->count() }} core projects.</p>
</div>
<button class="bg-primary text-on-primary px-6 py-3 rounded-lg font-semibold flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-sm">
<span class="material-symbols-outlined">add_task</span>
                    Submit Project Diary
                </button>
</section>
<!-- Projects Bento Grid (Kanban Style) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-card-gap h-full">
<!-- To Do Column -->
<div class="space-y-4">
<div class="flex items-center justify-between px-2">
<h3 class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-outline"></span> TO DO
                        </h3>
<span class="text-[11px] font-bold px-2 py-0.5 bg-surface-container-highest text-secondary rounded-full">{{ $todoMilestones->count() }}</span>
</div>
<div class="space-y-3 min-h-[150px] kanban-col" id="todo-col" data-status="Pending">
@forelse($todoMilestones as $ms)
<div class="bg-white p-4 rounded-xl custom-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing kanban-card" data-id="{{ $ms->id }}">
<div class="flex justify-between items-start mb-3">
<span class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded">{{ Str::upper($ms->project->name) }}</span>
</div>
<h4 class="font-headline-md text-[16px] text-on-surface mb-2">{{ $ms->title }}</h4>
<div class="flex items-center gap-1 text-on-surface-variant border-t border-outline-variant pt-3">
<span class="material-symbols-outlined text-[14px]">calendar_today</span>
<span class="text-[11px]">{{ $ms->due_date ? \Carbon\Carbon::parse($ms->due_date)->format('M d') : 'No Due Date' }}</span>
</div>
</div>
@empty
<div class="text-center p-4 text-outline text-sm">No tasks pending.</div>
@endforelse
</div>
</div>
<!-- Doing Column -->
<div class="space-y-4">
<div class="flex items-center justify-between px-2">
<h3 class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-primary"></span> DOING
                        </h3>
<span class="text-[11px] font-bold px-2 py-0.5 bg-primary/10 text-primary rounded-full">{{ $doingMilestones->count() }}</span>
</div>
<div class="space-y-3 min-h-[150px] kanban-col" id="doing-col" data-status="In Progress">
@forelse($doingMilestones as $ms)
<div class="bg-white p-4 rounded-xl custom-shadow border-l-4 border-primary cursor-grab active:cursor-grabbing kanban-card" data-id="{{ $ms->id }}">
<div class="flex justify-between items-start mb-3">
<span class="text-[10px] font-bold text-secondary bg-secondary/10 px-2 py-0.5 rounded">{{ Str::upper($ms->project->name) }}</span>
</div>
<h4 class="font-headline-md text-[16px] text-on-surface mb-2">{{ $ms->title }}</h4>
<div class="flex items-center justify-between pt-3 border-t border-outline-variant">
<div class="flex items-center gap-2 text-on-surface-variant">
<span class="text-[11px]">Due: {{ $ms->due_date ? \Carbon\Carbon::parse($ms->due_date)->format('M d') : '-' }}</span>
</div>
</div>
</div>
@empty
<div class="text-center p-4 text-outline text-sm">No active tasks.</div>
@endforelse
</div>
</div>
<!-- Done Column -->
<div class="space-y-4">
<div class="flex items-center justify-between px-2">
<h3 class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-on-tertiary-fixed-variant"></span> DONE
                        </h3>
<span class="text-[11px] font-bold px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">{{ $doneMilestones->count() }}</span>
</div>
<div class="space-y-3 min-h-[150px] opacity-70 grayscale-[0.2] kanban-col" id="done-col" data-status="Done">
@forelse($doneMilestones as $ms)
<div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant/30 cursor-grab active:cursor-grabbing kanban-card" data-id="{{ $ms->id }}">
<h4 class="font-headline-md text-[14px] text-on-surface mb-1 line-through">{{ $ms->title }}</h4>
<p class="text-[11px] text-on-surface-variant">In: {{ $ms->project->name }}</p>
</div>
@empty
<div class="text-center p-4 text-outline text-sm">No finished tasks.</div>
@endforelse
</div>
</div>
</div>
<!-- Read Only Modules -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-card-gap">
<!-- Calendar (Read Only) -->
<section class="bg-white p-6 rounded-xl custom-shadow space-y-6">
<div class="flex items-center justify-between">
<h3 class="font-headline-md text-headline-md text-on-background flex items-center gap-2">
<span class="material-symbols-outlined text-primary">calendar_month</span>
                            Project Deadlines
                        </h3>
<div class="flex gap-2">
<button class="p-1 hover:bg-surface-container-low rounded"><span class="material-symbols-outlined text-sm">chevron_left</span></button>
<span class="text-label-md font-bold text-on-surface-variant">OCT 2023</span>
<button class="p-1 hover:bg-surface-container-low rounded"><span class="material-symbols-outlined text-sm">chevron_right</span></button>
</div>
</div>
<div class="space-y-4">
@forelse($activeProjects as $proj)
<div class="flex gap-4 items-start p-3 hover:bg-surface-container-low rounded-lg transition-colors cursor-default">
<div class="flex flex-col items-center bg-primary-container text-on-primary-container rounded p-2 min-w-[48px]">
<span class="text-[10px] font-bold uppercase">{{ \Carbon\Carbon::parse($proj->deadline)->format('M') }}</span>
<span class="text-lg font-bold">{{ \Carbon\Carbon::parse($proj->deadline)->format('d') }}</span>
</div>
<div class="flex-1">
<p class="font-label-md text-label-md text-on-surface">{{ $proj->name }}</p>
<p class="text-[12px] text-on-surface-variant">Status: {{ $proj->status }}</p>
</div>
</div>
@empty
<div class="text-center p-4 text-outline text-sm">No project deadlines.</div>
@endforelse
</div>
</section>
<!-- Rules & Piket (Read Only) -->
<div class="grid grid-rows-2 gap-card-gap">
<!-- Piket Schedule -->
<section class="bg-white p-6 rounded-xl custom-shadow border-l-4 border-secondary">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-md text-headline-md text-on-background flex items-center gap-2">
<span class="material-symbols-outlined text-secondary">cleaning_services</span>
                                Piket Schedule
                            </h3>
<span class="text-[11px] font-bold text-secondary uppercase tracking-widest">This Week</span>
</div>
<div class="flex justify-between gap-2 overflow-x-auto scrollbar-hide">
@foreach(['senin' => 'MON', 'selasa' => 'TUE', 'rabu' => 'WED', 'kamis' => 'THU', 'jumat' => 'FRI'] as $dayKey => $dayName)
@php 
    $dayPikets = $pikets->where('day', $dayKey); 
    $isToday = strtolower(\Carbon\Carbon::now()->translatedFormat('l')) == $dayKey;
@endphp
<div class="flex-1 text-center p-2 rounded-lg {{ $isToday ? 'bg-primary/10 border border-primary/20' : 'bg-surface-container-low border border-transparent' }}">
<p class="text-[10px] {{ $isToday ? 'text-primary font-bold' : 'text-on-surface-variant' }}">{{ $dayName }}</p>
@forelse($dayPikets as $p)
<p class="font-bold {{ $isToday ? 'text-primary' : 'text-on-surface' }} text-xs">{{ explode(' ', $p->user->name)[0] }}</p>
@empty
<p class="text-xs text-outline">-</p>
@endforelse
</div>
@endforeach
</div>
</section>
<!-- House Rules -->
<section class="bg-white p-6 rounded-xl custom-shadow">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-md text-headline-md text-on-background flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary">policy</span>
                                Quick House Rules
                            </h3>
<a class="text-primary text-[11px] font-bold hover:underline" href="#">View Full Policy</a>
</div>
<ul class="space-y-3">
@forelse($houseRules as $rule)
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
<span class="text-body-md text-on-surface-variant">{{ $rule->title }}</span>
</li>
@empty
<li class="text-outline text-sm">No house rules defined.</li>
@endforelse
</ul>
</section>
</div>
</div>
</div>
</main>
<!-- Overlay Form (Initially Hidden - Interactive Logic) -->
<div class="fixed inset-0 z-[100] bg-on-background/60 backdrop-blur-sm flex items-center justify-center p-4 hidden transition-opacity duration-300 opacity-0" id="diary-modal">
<div class="bg-white w-full max-w-xl rounded-2xl custom-shadow overflow-hidden transform scale-95 transition-transform duration-300">
<div class="p-6 bg-primary-container text-on-primary-container flex items-center justify-between">
<div>
<h3 class="font-headline-lg text-headline-lg font-bold">New Project Diary Entry</h3>
<p class="text-[12px] opacity-80">Log your progress for Oct 24, 2023</p>
</div>
<button class="text-on-primary-container/70 hover:text-on-primary-container" onclick="toggleDiaryModal()">
<span class="material-symbols-outlined">close</span>
</button>
</div>
<form class="p-8 space-y-6">
<div>
<label class="block font-label-md text-label-md text-on-surface-variant mb-2">PROJECT CATEGORY</label>
<select class="w-full border-outline-variant rounded-lg focus:ring-primary focus:border-primary">
<option>Cloud Migration</option>
<option>Asset Audit</option>
<option>Security Patching</option>
<option>Administrative</option>
</select>
</div>
<div>
<label class="block font-label-md text-label-md text-on-surface-variant mb-2">WORK LOG</label>
<textarea class="w-full border-outline-variant rounded-lg focus:ring-primary focus:border-primary text-body-md" placeholder="What did you achieve today? Any blockers?" rows="4"></textarea>
</div>
<div class="grid grid-cols-2 gap-4">
<div>
<label class="block font-label-md text-label-md text-on-surface-variant mb-2">HOURS SPENT</label>
<input class="w-full border-outline-variant rounded-lg focus:ring-primary focus:border-primary" step="0.5" type="number"/>
</div>
<div>
<label class="block font-label-md text-label-md text-on-surface-variant mb-2">STATUS</label>
<div class="flex gap-2">
<button class="flex-1 py-2 border rounded-lg text-[12px] font-bold border-outline-variant hover:border-primary" type="button">ON TRACK</button>
<button class="flex-1 py-2 border rounded-lg text-[12px] font-bold border-outline-variant hover:border-error" type="button">DELAYED</button>
</div>
</div>
</div>
<div class="pt-4 flex justify-end gap-4">
<button class="px-6 py-2 text-on-surface-variant font-bold" onclick="toggleDiaryModal()" type="button">Cancel</button>
<button class="px-8 py-2 bg-primary text-on-primary rounded-lg font-bold hover:shadow-lg transition-all" type="submit">Submit Entry</button>
</div>
</form>
</div>
</div>
<script>
        function toggleDiaryModal() {
            const modal = document.getElementById('diary-modal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.querySelector('.bg-white').classList.remove('scale-95');
                }, 10);
            } else {
                modal.classList.add('opacity-0');
                modal.querySelector('.bg-white').classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // Connect the "Submit Project Diary" button to the modal
        document.querySelector('button.bg-primary').addEventListener('click', toggleDiaryModal);
        
        // Micro-interaction for cards
        document.querySelectorAll('.custom-shadow').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0px)';
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cols = document.querySelectorAll('.kanban-col');
            cols.forEach(col => {
                new Sortable(col, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'bg-primary/10',
                    onEnd: function (evt) {
                        const itemEl = evt.item;
                        const toList = evt.to;
                        const newStatus = toList.getAttribute('data-status');
                        const milestoneId = itemEl.getAttribute('data-id');
                        
                        if (evt.from !== evt.to) {
                            fetch(`/user/dashboard/milestone/${milestoneId}/status`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ status: newStatus })
                            }).then(res => res.json()).then(data => {
                                if (!data.success) {
                                    alert('Failed to update status');
                                }
                            }).catch(err => {
                                console.error('Error updating status:', err);
                            });
                        }
                    }
                });
            });
        });
    </script>
</body></html>