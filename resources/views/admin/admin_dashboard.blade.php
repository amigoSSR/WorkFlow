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
<!-- Bento Grid Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-card-gap mb-8">
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-primary">
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-primary text-[32px]">folder_managed</span>
<span class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded">+12%</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Total Projects</p>
<h3 class="text-[32px] font-bold text-on-background leading-tight">124</h3>
</div>
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-secondary">
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-secondary text-[32px]">groups</span>
<span class="px-2 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded">Active</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Active Members</p>
<h3 class="text-[32px] font-bold text-on-background leading-tight">842</h3>
</div>
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-tertiary">
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-tertiary text-[32px]">task_alt</span>
<span class="px-2 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold rounded">98% Goal</span>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Tasks Completed</p>
<h3 class="text-[32px] font-bold text-on-background leading-tight">3,120</h3>
</div>
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] border-l-4 border-[#7c3aed]">
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-[#7c3aed] text-[32px]">edit_note</span>
<a href="{{ route('admin.diary') }}" class="px-2 py-1 bg-[#7c3aed]/10 text-[#7c3aed] text-[10px] font-bold rounded hover:bg-[#7c3aed]/20 transition">View All</a>
</div>
<p class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wide">Today's Activities</p>
<h3 class="text-[32px] font-bold text-on-background leading-tight">{{ $todayActivities ?? 0 }}</h3>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-card-gap">
<!-- Activity Graph Section -->
<div class="lg:col-span-8 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<div class="flex items-center justify-between mb-8">
<div>
<h4 class="font-headline-md text-headline-md text-on-background">Activity Analytics</h4>
<p class="text-body-md text-on-surface-variant">Team performance monitoring (Last 30 Days)</p>
</div>
<select class="bg-surface-container-low border-none rounded-lg text-label-md px-4 py-2 outline-none">
<option>Monthly</option>
<option>Weekly</option>
</select>
</div>
<!-- Chart with real data -->
<div class="relative h-[300px] w-full">
    <canvas id="activityChart"></canvas>
</div>
<div class="flex justify-between mt-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest px-2">
@foreach($chartLabels ?? [] as $label)
    <span>{{ $label }}</span>
@endforeach
</div>
</div>
<!-- Recent Activity Feed -->
<div class="lg:col-span-4 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] flex flex-col">
<div class="flex items-center justify-between mb-6">
<h4 class="font-headline-md text-headline-md text-on-background">Activity Feed</h4>
<a class="text-primary text-label-md font-label-md hover:underline" href="{{ route('admin.diary') }}">View All</a>
</div>
<div class="flex-1 space-y-6 overflow-y-auto max-h-[350px] pr-2 custom-scrollbar">
<div class="flex gap-4">
<div class="h-10 w-10 shrink-0 rounded-full bg-primary-fixed-dim flex items-center justify-center text-on-primary-fixed-variant">
<span class="material-symbols-outlined" data-icon="edit_square">edit_square</span>
</div>
<div>
<p class="text-body-md font-semibold text-on-background">Diary Updated</p>
<p class="text-body-md text-on-surface-variant">Sarah Jensen updated her daily project diary for Project Helios.</p>
<span class="text-[12px] text-outline mt-1 block">2 minutes ago</span>
</div>
</div>
<div class="flex gap-4">
<div class="h-10 w-10 shrink-0 rounded-full bg-secondary-fixed-dim flex items-center justify-center text-on-secondary-fixed-variant">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
</div>
<div>
<p class="text-body-md font-semibold text-on-background">New Member</p>
<p class="text-body-md text-on-surface-variant">Alex Rivera was added to the DevOps Engineering team.</p>
<span class="text-[12px] text-outline mt-1 block">1 hour ago</span>
</div>
</div>
<div class="flex gap-4">
<div class="h-10 w-10 shrink-0 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined" data-icon="warning">warning</span>
</div>
<div>
<p class="text-body-md font-semibold text-on-background">Rule Violation</p>
<p class="text-body-md text-on-surface-variant">Manual override detected on House Rule #14: Access Control.</p>
<span class="text-[12px] text-outline mt-1 block">3 hours ago</span>
</div>
</div>
<div class="flex gap-4">
<div class="h-10 w-10 shrink-0 rounded-full bg-surface-container-highest flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined" data-icon="cleaning_services">cleaning_services</span>
</div>
<div>
<p class="text-body-md font-semibold text-on-background">Piket Completion</p>
<p class="text-body-md text-on-surface-variant">Common Area sanitation completed by Night Shift Team A.</p>
<span class="text-[12px] text-outline mt-1 block">5 hours ago</span>
</div>
</div>
</div>
</div>
</div>
<!-- Management Sections (Asymmetric Grid) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-card-gap mt-8">
<!-- Editable Calendar Preview -->
<div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<div class="flex items-center justify-between mb-4">
<h5 class="font-headline-md text-headline-md text-on-background">Calendar</h5>
<a class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" href="{{ route('admin.calendar') }}">
<span class="material-symbols-outlined text-primary" data-icon="edit">edit</span>
</a>
</div>
<div class="space-y-4">
<div class="p-3 bg-surface-container-low rounded-lg border-l-2 border-primary">
<p class="text-label-md font-bold text-primary">TODAY</p>
<p class="text-body-md font-semibold text-on-background">Stakeholder Sync</p>
<p class="text-[12px] text-on-surface-variant">10:00 AM - 11:30 AM</p>
</div>
<div class="p-3 bg-surface-container-lowest rounded-lg border border-outline-variant">
<p class="text-label-md font-bold text-outline">TOMORROW</p>
<p class="text-body-md font-semibold text-on-background">Sprint Planning</p>
<p class="text-[12px] text-on-surface-variant">09:00 AM - 12:00 PM</p>
</div>
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
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-[18px] text-primary mt-0.5" data-icon="verified">verified</span>
<span class="text-body-md text-on-surface-variant">Mandatory MFA for all project access.</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-[18px] text-primary mt-0.5" data-icon="verified">verified</span>
<span class="text-body-md text-on-surface-variant">No deployment after Friday 4:00 PM.</span>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-[18px] text-primary mt-0.5" data-icon="verified">verified</span>
<span class="text-body-md text-on-surface-variant">Document all API changes in Wiki.</span>
</li>
</ul>
</div>
<!-- Piket Schedule Preview -->
<div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<div class="flex items-center justify-between mb-4">
<h5 class="font-headline-md text-headline-md text-on-background">Piket Duty</h5>
<a class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" href="{{ route('admin.piket') }}">
<span class="material-symbols-outlined text-primary" data-icon="edit">edit</span>
</a>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left text-body-md">
<thead>
<tr class="border-b border-outline-variant">
<th class="pb-2 font-semibold">Member</th>
<th class="pb-2 font-semibold text-right">Zone</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-2.5">Marcus Aurelius</td>
<td class="py-2.5 text-right font-medium">Server Room</td>
</tr>
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-2.5">Elena Gilbert</td>
<td class="py-2.5 text-right font-medium">Break Area</td>
</tr>
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-2.5">Jordan Smith</td>
<td class="py-2.5 text-right font-medium">Lobby A</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Activity Chart (real data from controller)
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Activities',
                    data: @json($chartData ?? []),
                    backgroundColor: 'rgba(0, 101, 101, 0.15)',
                    borderColor: 'rgba(0, 101, 101, 0.8)',
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(0, 101, 101, 0.4)',
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
                            label: ctx => ` ${ctx.raw} activit${ctx.raw !== 1 ? 'ies' : 'y'}`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#94a3b8', font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: { color: '#94a3b8', font: { size: 11 }, display: false },
                        grid: { display: false }
                    }
                }
            }
        });

        // Micro-interaction for active scaling on buttons
        document.querySelectorAll('button, a').forEach(btn => {
            btn.addEventListener('mousedown', () => btn.classList.add('scale-95'));
            btn.addEventListener('mouseup', () => btn.classList.remove('scale-95'));
            btn.addEventListener('mouseleave', () => btn.classList.remove('scale-95'));
        });
    </script>
</body></html>
