@include ('user.topbaruser')
<div class="p-container-padding space-y-8">
<!-- Welcome Hero & CTA -->
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">My Projects</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">You have 12 active tasks across 3 core projects today.</p>
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
<span class="text-[11px] font-bold px-2 py-0.5 bg-surface-container-highest text-secondary rounded-full">4</span>
</div>
<div class="space-y-3">
<!-- Card 1 -->
<div class="bg-white p-4 rounded-xl custom-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing">
<div class="flex justify-between items-start mb-3">
<span class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded">INFRASTRUCTURE</span>
<span class="material-symbols-outlined text-on-surface-variant text-sm">more_horiz</span>
</div>
<h4 class="font-headline-md text-[16px] text-on-surface mb-2">Cloud Migration Mapping</h4>
<p class="font-body-md text-body-md text-on-surface-variant line-clamp-2 mb-4">Define resource allocation for Q4 migration phase.</p>
<div class="flex items-center justify-between pt-3 border-t border-outline-variant">
<div class="flex -space-x-2">
<img class="w-6 h-6 rounded-full border-2 border-white" data-alt="Close up avatar profile photo of a diverse team member, professional lighting, soft background." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAapgBm9j7tWQJWap20GT-4XHFYDc9ZWXnnDZ9BPaI7O8NBTcJ-JA-5KOkpuQeQ05Dt6AxtOq4Vteg3jUqzCd_CN76xeXinDDmMdfV-8MEnjxu2sP3bp3zuVa4SjblqYNC51HHwKgc7976Sj7c2XLR5Wizzll5v7hiBGPAj8KH-HXrp5oDn9WTtjzCwXMzn_TAxFWuxYCgH9a8BFJxB34HW_IRq6n2K0FLUQWBFv9TrPH57QUs3WUj1cWGeVyoDGVAI6FExTQ81GwM"/>
</div>
<div class="flex items-center gap-1 text-on-surface-variant">
<span class="material-symbols-outlined text-[14px]">calendar_today</span>
<span class="text-[11px]">Oct 24</span>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="bg-white p-4 rounded-xl custom-shadow border border-transparent hover:border-primary transition-all">
<div class="flex justify-between items-start mb-3">
<span class="text-[10px] font-bold text-tertiary bg-tertiary/10 px-2 py-0.5 rounded">DESIGN</span>
</div>
<h4 class="font-headline-md text-[16px] text-on-surface mb-2">Asset Audit: Iconography</h4>
<div class="w-full bg-surface-container-low h-1.5 rounded-full mb-3 overflow-hidden">
<div class="bg-primary h-full w-1/3"></div>
</div>
<div class="flex items-center justify-between text-on-surface-variant">
<span class="text-[11px]">3/10 Assets</span>
<span class="material-symbols-outlined text-[14px]">attach_file</span>
</div>
</div>
</div>
</div>
<!-- Doing Column -->
<div class="space-y-4">
<div class="flex items-center justify-between px-2">
<h3 class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-primary"></span> DOING
                        </h3>
<span class="text-[11px] font-bold px-2 py-0.5 bg-primary/10 text-primary rounded-full">2</span>
</div>
<div class="space-y-3">
<div class="bg-white p-4 rounded-xl custom-shadow border-l-4 border-primary">
<div class="flex justify-between items-start mb-3">
<span class="text-[10px] font-bold text-secondary bg-secondary/10 px-2 py-0.5 rounded">OPS-CORE</span>
</div>
<h4 class="font-headline-md text-[16px] text-on-surface mb-2">Security Patch v2.4 Deployment</h4>
<div class="flex items-center gap-2 mb-4">
<span class="bg-error-container text-on-error-container text-[10px] px-2 py-0.5 rounded font-bold">URGENT</span>
</div>
<div class="flex items-center justify-between pt-3 border-t border-outline-variant">
<div class="flex items-center gap-2">
<img class="w-6 h-6 rounded-full" data-alt="Avatar of a senior technical lead with professional studio lighting, looking confident, modern teal color palette." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlJfMu6raMqI_WXS4J7nxPniL2SLJ7pmtiYYwEAnqNU4sGKMt7Wz1Ie7mILWNsdw1ravxR0nRgPLnj4_5fivWl5X3_IjVIJMLbDp81TtUCtHS-b8pgY1ut3tg205n_0dOwX0yk-8gtnJgbsMQAeCdZQuOv4R9gA1eCMQQEYtiN6f8C5idh6H1TiGFyu8NUrzw_n4FdvaEPq1Tv6NqwOqU0ohtS1nuLb7x_AEkqgCk5IqyE7CxKYI7QIKYBCZirPl36kENERXQCZbw"/>
<span class="text-[11px] text-on-surface-variant">Assigned to me</span>
</div>
</div>
</div>
</div>
</div>
<!-- Done Column -->
<div class="space-y-4">
<div class="flex items-center justify-between px-2">
<h3 class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-on-tertiary-fixed-variant"></span> DONE
                        </h3>
<span class="text-[11px] font-bold px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded-full">6</span>
</div>
<div class="space-y-3 opacity-70 grayscale-[0.2]">
<div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant/30">
<h4 class="font-headline-md text-[14px] text-on-surface mb-1 line-through">Quarterly Review Deck</h4>
<p class="text-[11px] text-on-surface-variant">Completed 2 days ago</p>
</div>
<div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant/30">
<h4 class="font-headline-md text-[14px] text-on-surface mb-1 line-through">Onboarding New Hires</h4>
<p class="text-[11px] text-on-surface-variant">Completed 5 days ago</p>
</div>
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
<div class="flex gap-4 items-start p-3 hover:bg-surface-container-low rounded-lg transition-colors cursor-default">
<div class="flex flex-col items-center bg-primary-container text-on-primary-container rounded p-2 min-w-[48px]">
<span class="text-[10px] font-bold uppercase">Oct</span>
<span class="text-lg font-bold">28</span>
</div>
<div class="flex-1">
<p class="font-label-md text-label-md text-on-surface">Sprint Retrospective</p>
<p class="text-[12px] text-on-surface-variant">10:00 AM - 11:30 AM • Main Hall</p>
</div>
</div>
<div class="flex gap-4 items-start p-3 hover:bg-surface-container-low rounded-lg transition-colors cursor-default">
<div class="flex flex-col items-center bg-secondary-container text-on-secondary-container rounded p-2 min-w-[48px]">
<span class="text-[10px] font-bold uppercase">Nov</span>
<span class="text-lg font-bold">02</span>
</div>
<div class="flex-1">
<p class="font-label-md text-label-md text-on-surface">Client Feedback Session</p>
<p class="text-[12px] text-on-surface-variant">02:00 PM - 03:00 PM • Remote</p>
</div>
</div>
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
<div class="flex-1 text-center p-2 rounded-lg bg-surface-container-low border border-transparent">
<p class="text-[10px] text-on-surface-variant">MON</p>
<p class="font-bold text-on-surface">John D.</p>
</div>
<div class="flex-1 text-center p-2 rounded-lg bg-primary/10 border border-primary/20">
<p class="text-[10px] text-primary font-bold">TUE</p>
<p class="font-bold text-primary">Me (Alex)</p>
</div>
<div class="flex-1 text-center p-2 rounded-lg bg-surface-container-low">
<p class="text-[10px] text-on-surface-variant">WED</p>
<p class="font-bold text-on-surface">Sarah K.</p>
</div>
<div class="flex-1 text-center p-2 rounded-lg bg-surface-container-low">
<p class="text-[10px] text-on-surface-variant">THU</p>
<p class="font-bold text-on-surface">Mike R.</p>
</div>
<div class="flex-1 text-center p-2 rounded-lg bg-surface-container-low">
<p class="text-[10px] text-on-surface-variant">FRI</p>
<p class="font-bold text-on-surface">Elena V.</p>
</div>
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
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
<span class="text-body-md text-on-surface-variant">Meeting rooms must be booked 24h in advance.</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
<span class="text-body-md text-on-surface-variant">Quiet hours are strictly 1:00 PM to 3:00 PM.</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
<span class="text-body-md text-on-surface-variant">Project Diaries must be submitted daily before 5:00 PM.</span>
</li>
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
</body></html>