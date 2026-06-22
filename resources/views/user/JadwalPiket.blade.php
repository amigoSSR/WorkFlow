@include ('user.topbaruser')
<!-- Content Canvas -->
<div class="p-container-padding space-y-card-gap">
<!-- Title and Action Row -->
<div class="flex justify-between items-end">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">Jadwal Piket - Monitoring Mingguan</h2>
<p class="font-body-md text-body-md text-outline">Manage and monitor team rotations across operational zones.</p>
</div>
<div class="flex gap-3">
<button class="px-4 py-2 border border-outline rounded-lg flex items-center gap-2 font-label-md text-label-md hover:bg-surface-container transition-all">
<span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        June 12 - June 18, 2024
                    </button>
<button class="px-6 py-2 bg-primary text-white rounded-lg flex items-center gap-2 font-label-md text-label-md hover:bg-surface-tint shadow-sm transition-all active:scale-95">
<span class="material-symbols-outlined text-[18px]">person_add</span>
                        Assign Member
                    </button>
</div>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-12 gap-card-gap">
<!-- Main Schedule View (Span 9) -->
<div class="col-span-9 space-y-card-gap">
<!-- Weekly Calendar -->
<div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] overflow-hidden">
<div class="grid grid-cols-7 border-b border-outline-variant">
<!-- Header -->
<div class="p-4 text-center border-r border-outline-variant bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Mon</p>
<p class="text-headline-md font-headline-md">12</p>
</div>
<div class="p-4 text-center border-r border-outline-variant bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Tue</p>
<p class="text-headline-md font-headline-md">13</p>
</div>
<div class="p-4 text-center border-r border-outline-variant bg-primary-container text-white">
<p class="text-label-md font-bold text-on-primary-container opacity-80 uppercase tracking-wider">Wed</p>
<p class="text-headline-md font-headline-md">14</p>
</div>
<div class="p-4 text-center border-r border-outline-variant bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Thu</p>
<p class="text-headline-md font-headline-md">15</p>
</div>
<div class="p-4 text-center border-r border-outline-variant bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Fri</p>
<p class="text-headline-md font-headline-md">16</p>
</div>
<div class="p-4 text-center border-r border-outline-variant bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Sat</p>
<p class="text-headline-md font-headline-md">17</p>
</div>
<div class="p-4 text-center bg-surface-container-low">
<p class="text-label-md font-bold text-outline uppercase tracking-wider">Sun</p>
<p class="text-headline-md font-headline-md">18</p>
</div>
</div>
<!-- Calendar Slots -->
<div class="grid grid-cols-7 h-[600px]">
<!-- Column Iterations (Simplified for logic) -->
<!-- Monday -->
<div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
<div class="bg-secondary-container/10 p-2 rounded border-l-4 border-secondary">
<p class="text-[10px] font-bold text-secondary uppercase">Server Room</p>
<p class="text-body-md font-semibold text-on-surface">Alex Rivera</p>
</div>
<div class="bg-tertiary-container/10 p-2 rounded border-l-4 border-tertiary">
<p class="text-[10px] font-bold text-tertiary uppercase">Break Area</p>
<p class="text-body-md font-semibold text-on-surface">Sarah Chen</p>
</div>
</div>
<!-- Tuesday -->
<div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
<div class="bg-primary-container/10 p-2 rounded border-l-4 border-primary">
<p class="text-[10px] font-bold text-primary uppercase">Meeting Pods</p>
<p class="text-body-md font-semibold text-on-surface">Mark J.</p>
</div>
</div>
<!-- Wednesday (Today) -->
<div class="border-r border-outline-variant p-2 space-y-2 bg-surface-container-low/30 overflow-y-auto custom-scrollbar">
<div class="bg-secondary-container/10 p-2 rounded border-l-4 border-secondary">
<p class="text-[10px] font-bold text-secondary uppercase">Server Room</p>
<p class="text-body-md font-semibold text-on-surface">Lena Vos</p>
<div class="mt-2 flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
<span class="text-[9px] text-outline">Checked-in: 08:00</span>
</div>
</div>
<div class="bg-primary-container/10 p-2 rounded border-l-4 border-primary">
<p class="text-[10px] font-bold text-primary uppercase">Meeting Pods</p>
<p class="text-body-md font-semibold text-on-surface">Dianne H.</p>
</div>
<div class="bg-tertiary-container/10 p-2 rounded border-l-4 border-tertiary">
<p class="text-[10px] font-bold text-tertiary uppercase">Break Area</p>
<p class="text-body-md font-semibold text-on-surface">Toby Larz</p>
</div>
</div>
<!-- Thursday -->
<div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
<div class="bg-secondary-container/10 p-2 rounded border-l-4 border-secondary">
<p class="text-[10px] font-bold text-secondary uppercase">Server Room</p>
<p class="text-body-md font-semibold text-on-surface">Alex Rivera</p>
</div>
</div>
<!-- Friday -->
<div class="border-r border-outline-variant p-2 space-y-2 overflow-y-auto custom-scrollbar">
<div class="bg-primary-container/10 p-2 rounded border-l-4 border-primary">
<p class="text-[10px] font-bold text-primary uppercase">Meeting Pods</p>
<p class="text-body-md font-semibold text-on-surface">Chris P.</p>
</div>
</div>
<!-- Saturday (Weekend) -->
<div class="border-r border-outline-variant p-2 bg-surface-container-lowest/50 flex items-center justify-center">
<p class="text-outline text-label-md italic">No Rotation</p>
</div>
<!-- Sunday (Weekend) -->
<div class="p-2 bg-surface-container-lowest/50 flex items-center justify-center">
<p class="text-outline text-label-md italic">No Rotation</p>
</div>
</div>
</div>
<!-- Zone Coverage Chart -->
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<div class="flex justify-between items-center mb-6">
<h3 class="font-headline-md text-headline-md">Zone Staffing Levels</h3>
<div class="flex items-center gap-4">
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-primary"></span>
<span class="text-label-md text-outline">High</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-secondary"></span>
<span class="text-label-md text-outline">Optimal</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-tertiary"></span>
<span class="text-label-md text-outline">Low</span>
</div>
</div>
</div>
<div class="h-32 flex items-end gap-12 px-4">
<div class="flex-1 flex flex-col items-center gap-3">
<div class="w-full bg-primary-container/20 rounded-t-lg relative group h-24">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg transition-all duration-500" style="height: 85%"></div>
<div class="opacity-0 group-hover:opacity-100 absolute -top-8 bg-on-background text-white text-[10px] px-2 py-1 rounded transition-opacity">85% Occupancy</div>
</div>
<span class="text-label-md font-bold text-outline">Server Room</span>
</div>
<div class="flex-1 flex flex-col items-center gap-3">
<div class="w-full bg-secondary-container/20 rounded-t-lg relative group h-24">
<div class="absolute bottom-0 w-full bg-secondary rounded-t-lg transition-all duration-500" style="height: 60%"></div>
<div class="opacity-0 group-hover:opacity-100 absolute -top-8 bg-on-background text-white text-[10px] px-2 py-1 rounded transition-opacity">60% Occupancy</div>
</div>
<span class="text-label-md font-bold text-outline">Meeting Pods</span>
</div>
<div class="flex-1 flex flex-col items-center gap-3">
<div class="w-full bg-tertiary-container/20 rounded-t-lg relative group h-24">
<div class="absolute bottom-0 w-full bg-tertiary rounded-t-lg transition-all duration-500" style="height: 45%"></div>
<div class="opacity-0 group-hover:opacity-100 absolute -top-8 bg-on-background text-white text-[10px] px-2 py-1 rounded transition-opacity">45% Occupancy</div>
</div>
<span class="text-label-md font-bold text-outline">Break Area</span>
</div>
<div class="flex-1 flex flex-col items-center gap-3">
<div class="w-full bg-surface-container-highest rounded-t-lg relative group h-24">
<div class="absolute bottom-0 w-full bg-outline-variant rounded-t-lg transition-all duration-500" style="height: 20%"></div>
<div class="opacity-0 group-hover:opacity-100 absolute -top-8 bg-on-background text-white text-[10px] px-2 py-1 rounded transition-opacity">20% Occupancy</div>
</div>
<span class="text-label-md font-bold text-outline">Outdoor Lounge</span>
</div>
</div>
</div>
</div>
<!-- Side Panel (Span 3) -->
<div class="col-span-3 space-y-card-gap">
<!-- Statistics Card -->
<div class="bg-primary text-white p-6 rounded-xl shadow-lg relative overflow-hidden">
<div class="relative z-10">
<h4 class="text-label-md font-bold uppercase opacity-80 mb-1">Today's Summary</h4>
<div class="text-headline-xl font-headline-xl mb-4">12 / 15</div>
<div class="space-y-3">
<div class="flex justify-between items-center text-body-md">
<span>Active Shifts</span>
<span class="font-bold">12</span>
</div>
<div class="w-full bg-white/20 h-1 rounded-full overflow-hidden">
<div class="bg-primary-fixed h-full" style="width: 80%"></div>
</div>
<p class="text-[11px] opacity-70">3 members currently on leave. Replacement assigned for Server Room.</p>
</div>
</div>
<div class="absolute -right-8 -bottom-8 opacity-10">
<span class="material-symbols-outlined text-[120px]">verified_user</span>
</div>
</div>
<!-- Recent Activity Feed -->
<div class="bg-white rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)] flex flex-col h-[520px]">
<div class="p-6 border-b border-outline-variant">
<h3 class="font-headline-md text-headline-md">Recent Activity</h3>
</div>
<div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar">
<!-- Activity Item -->
<div class="flex gap-4 relative">
<div class="absolute left-[11px] top-6 bottom-[-24px] w-[2px] bg-outline-variant"></div>
<div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[14px] text-green-600" style="font-variation-settings: 'FILL' 1">check_circle</span>
</div>
<div>
<p class="text-body-md font-semibold">Lena Vos checked-in</p>
<p class="text-[11px] text-outline">08:02 AM • Server Room</p>
</div>
</div>
<div class="flex gap-4 relative">
<div class="absolute left-[11px] top-6 bottom-[-24px] w-[2px] bg-outline-variant"></div>
<div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[14px] text-blue-600" style="font-variation-settings: 'FILL' 1">swap_horiz</span>
</div>
<div>
<p class="text-body-md font-semibold">Shift Swap Approved</p>
<p class="text-[11px] text-outline">07:45 AM • Alex Rivera ➔ Mark J.</p>
</div>
</div>
<div class="flex gap-4 relative">
<div class="absolute left-[11px] top-6 bottom-[-24px] w-[2px] bg-outline-variant"></div>
<div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[14px] text-orange-600" style="font-variation-settings: 'FILL' 1">warning</span>
</div>
<div>
<p class="text-body-md font-semibold">Late Check-in</p>
<p class="text-[11px] text-outline">07:15 AM • Toby Larz (15m late)</p>
</div>
</div>
<div class="flex gap-4 relative">
<div class="absolute left-[11px] top-6 bottom-[-24px] w-[2px] bg-outline-variant"></div>
<div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[14px] text-green-600" style="font-variation-settings: 'FILL' 1">check_circle</span>
</div>
<div>
<p class="text-body-md font-semibold">Chris P. checked-out</p>
<p class="text-[11px] text-outline">Yesterday 05:00 PM • Meeting Pods</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center z-10">
<span class="material-symbols-outlined text-[14px] text-gray-400">more_horiz</span>
</div>
<div>
<p class="text-body-md font-semibold">View History</p>
<p class="text-[11px] text-outline">Show activities from previous week</p>
</div>
</div>
</div>
</div>
<!-- Staff on Duty List -->
<div class="bg-white p-6 rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_4px_6px_rgba(0,0,0,0.02)]">
<h3 class="font-headline-md text-headline-md mb-4">Staff on Duty</h3>
<div class="space-y-4">
<div class="flex items-center gap-3 group cursor-pointer">
<div class="relative">
<img class="w-10 h-10 rounded-full border border-outline-variant" data-alt="Close-up portrait of a young professional woman with glasses, smiling warmly. She is wearing a modern corporate outfit. The background is a blurred office setting with cool blue and green accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDt0FhHr0KZB3mx1YGC_pPbAKbo43ZcwH_mCDkBYm8yfhWOeOIBa1IkoIOoXXbvg4M7yujsw0EQojuj0aUzRT0EtDQUmYOmJBvdjI8BNdmwIJfDXGZUBKXzExn2lKz2AiHwRzp8DUen6i4I-t0gscof57fk948EN_d81fS7cYcrGvKLIaFc9NCehJcFdGADxr45qXKMG0c7tHSK04r6TRKlHQJVAQg-qRT_nx1FJOvu2eXM9Ndt61_rTXaZ-dN1ZIaalgFVPl8zfhs"/>
<span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
</div>
<div>
<p class="text-body-md font-semibold group-hover:text-primary transition-colors">Lena Vos</p>
<p class="text-[11px] text-outline">Tier 2 Engineer</p>
</div>
</div>
<div class="flex items-center gap-3 group cursor-pointer">
<div class="relative">
<img class="w-10 h-10 rounded-full border border-outline-variant" data-alt="Portrait of a diverse male professional in a modern office environment. He is wearing a dark blue shirt and has a focused, professional expression. The office in the background is bright and airy with minimalist furniture." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFnsDD7EZjuZSaqwVgvVO9wtbT0rKtdUJfPa2mpRi-lp92qtHiE7b-hq_zTcv4gSO63s915AC6ufxuKX8bdOb3T4pTlmYZgVqxhuyaOsPnW1qDTtrDc9ndnBABqjjv5DIbZd5Aaa-QTFIxYfLnRnpr-hITW7BdFDF4dablB1EiRg0xB5aoqNyHRQpwM4_6j5EII6Y7wmL_zrAAJRQ50yLgUy1DZuhN6d1k1iTpU4F_pu1dwt6Vbty6RrTusbpCrxgv4mYEZIvoUxQ"/>
<span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
</div>
<div>
<p class="text-body-md font-semibold group-hover:text-primary transition-colors">Dianne H.</p>
<p class="text-[11px] text-outline">Security Ops</p>
</div>
</div>
<button class="w-full text-center text-primary font-label-md text-label-md mt-2 py-2 hover:bg-surface-container transition-all rounded-lg">View All Team members</button>
</div>
</div>
</div>
</div>
</div>
</main>
<script>
        // Micro-interactions for schedule items
        document.querySelectorAll('.calendar-slot-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateY(-2px)';
                item.style.boxShadow = '0 4px 6px -1px rgb(0 0 0 / 0.1)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateY(0)';
                item.style.boxShadow = 'none';
            });
        });

        // Simple animation for the "Today" highlight
        const todayHeader = document.querySelector('.bg-primary-container');
        if(todayHeader) {
            todayHeader.classList.add('transition-all', 'duration-700');
        }
    </script>
</body></html>