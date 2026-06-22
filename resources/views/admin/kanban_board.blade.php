<!-- Kanban Board Container -->
<div class="mt-16 p-container-padding flex-1">
<div class="flex items-center justify-between mb-8">
<div>
<h2 class="font-headline-xl text-headline-xl text-on-background">Project Board</h2>
<p class="text-on-surface-variant font-body-md">Manage and track enterprise operations across team clusters.</p>
</div>
<button class="bg-primary text-on-primary px-6 py-2.5 rounded-lg flex items-center gap-2 font-semibold hover:opacity-90 transition-all active:scale-95 shadow-sm">
<span class="material-symbols-outlined" data-icon="add">add</span>
                    Create New Project
                </button>
</div>
<!-- Kanban Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-card-gap">
<!-- Column: To Do -->
<div class="kanban-column flex flex-col gap-4">
<div class="flex items-center justify-between px-2 mb-2">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-outline"></span>
<h3 class="font-headline-md text-headline-md text-on-surface">To Do</h3>
<span class="bg-surface-container px-2 py-0.5 rounded-full text-label-md font-label-md text-secondary">3</span>
</div>
<button class="text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined" data-icon="more_horiz">more_horiz</span></button>
</div>
<!-- Card 1 -->
<div class="bg-white p-5 rounded-xl card-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing">
<div class="flex justify-between items-start mb-3">
<span class="bg-tertiary/10 text-tertiary px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">High Priority</span>
<span class="material-symbols-outlined text-outline cursor-pointer" data-icon="open_in_new">open_in_new</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Cloud Infrastructure Migration</h4>
<p class="text-on-surface-variant text-body-md mb-4 line-clamp-2">Phase 1 deployment of AWS serverless architecture for legacy subsystems.</p>
<div class="mb-4">
<div class="flex justify-between text-label-md mb-1">
<span class="text-on-surface-variant">Progress</span>
<span class="text-primary font-bold">12%</span>
</div>
<div class="w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 12%"></div>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Close up profile of a focused developer in a clean workspace with soft teal accent lighting. The image captures a modern, minimalist professional aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsMej7JzLEs9zlUv-FwjwnvIDPgqL0-bTaoK9wJOunwaJEUmanG8VOvL4a1Ngrnw6TAmqUvt1LDOaeYD2xR51khTbq56dEINkeTqp5zNbWb8V7j4cn4o6o7gVD-qZ_Xa7y3_UHrnRJdWpCfdb0wodYIpqe-XyZWbcRIu_BIy3vE9QmtsXXfVoTE1tYX0lXAOnfH8OU4ODwY_xUhViMROAu-x1IWFv8UfvRLgT-pXyRWGOS569OfC0Yi8QhKUlG4XhqIXjtnl698CM"/>
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Portrait of a project coordinator in a sleek, bright office setting. High-key lighting, soft white and gray tones with teal branding elements." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVJIZdNK1o4e86_MjvsQRWVFPKiYCbM2iTwmfli14DGVsGmbfpQShVVipWF9lDLsel0UnsV-uj_NKpJRfOfI7KgiIt0CAtx-U2LKvLIPhfV4timXqGPvVgf_UTIqk_nm4Oc7LPf-RRjo2s4TMPXerVqg2EPhbF1Ajiwt_F7G0SeT6ka-nSSBGlOgCP-P-pCF4VTc4HOUMIqbpJ9QULryoPCo2R-Iq8T4QA9ANW9TRYtIPj5wFsAXQ5tIFX-Xnvc9p-7OZFKbsqpvA"/>
<div class="w-8 h-8 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center text-[10px] font-bold border-2 border-white">+3</div>
</div>
<div class="flex items-center gap-1 text-on-surface-variant">
<span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span>
<span class="text-[12px]">Oct 24</span>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="bg-white p-5 rounded-xl card-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing">
<div class="flex justify-between items-start mb-3">
<span class="bg-secondary/10 text-secondary px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Medium</span>
<span class="material-symbols-outlined text-outline cursor-pointer" data-icon="open_in_new">open_in_new</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Security Audit Revamp</h4>
<p class="text-on-surface-variant text-body-md mb-4 line-clamp-2">Quarterly review of IAM policies and edge protection configurations.</p>
<div class="mb-4">
<div class="flex justify-between text-label-md mb-1">
<span class="text-on-surface-variant">Progress</span>
<span class="text-primary font-bold">0%</span>
</div>
<div class="w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 0%"></div>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Expert cybersecurity specialist looking thoughtfully at a monitor with subtle blue and teal reflections on their glasses. Professional and clean corporate style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuATPSqdC1N3B4v3tENfga3mCzRKvfPnLDPboQOxSE4RNs8aE10-cnTKQpHDW5N-p-mO_x72VfkTQK6gWvRj23gz0htoKcBLmW2x5fA3jpEFIl3t1AMr_cAJXtOl1sfWP9Ei3FDRa2yYrhrtH0R2C-z5RlVQjsmx2JT10q9MM5WtWba5kcoUFimnkGYrGtQGTZp7C_xsP3Js6gc7sbcDdYhH7qSBj2K72g-17jaH1hv1FKQ4D5ahtKrZ7pK0J47UrjKWXI2o1MGnrwI"/>
</div>
<div class="flex items-center gap-1 text-on-surface-variant">
<span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span>
<span class="text-[12px]">Oct 28</span>
</div>
</div>
</div>
</div>
<!-- Column: In Progress -->
<div class="kanban-column flex flex-col gap-4 bg-surface-container-low/50 rounded-xl p-2">
<div class="flex items-center justify-between px-2 mb-2">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
<h3 class="font-headline-md text-headline-md text-on-surface">In Progress</h3>
<span class="bg-primary-container/20 px-2 py-0.5 rounded-full text-label-md font-label-md text-primary">2</span>
</div>
<button class="text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined" data-icon="more_horiz">more_horiz</span></button>
</div>
<!-- Card 3 -->
<div class="bg-white p-5 rounded-xl card-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing">
<div class="flex justify-between items-start mb-3">
<span class="bg-primary/10 text-primary px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Active</span>
<span class="material-symbols-outlined text-outline cursor-pointer" data-icon="open_in_new">open_in_new</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Internal Dashboard UI</h4>
<p class="text-on-surface-variant text-body-md mb-4 line-clamp-2">Redesigning the executive monitoring dashboard using Material 3 design tokens.</p>
<div class="mb-4">
<div class="flex justify-between text-label-md mb-1">
<span class="text-on-surface-variant">Progress</span>
<span class="text-primary font-bold">64%</span>
</div>
<div class="w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 64%"></div>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Portrait of a young UX designer in a modern, plant-filled office. Professional aesthetic with a palette of whites, greys and soft teal accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-UpIhNobCDiTn1I_TQM74aJ-Da2-cDQNSvHKOiQ1MB7ZIB82_RGmK-fmVAT4Ond86mn8wWczcLZ7RtJxLhlbhHWlvNW8qaRdiHPjnUfryk5GFr8KU-Ly96h4abm3QWndJ8y0Z8VmgdSfF5SADmLsnhAPTPfYtNWbn-c0nP4lJury2VtAEJgRKWBldajKEkUKkJoKNqGjpla0SLfAxx7RF71OwwL9m0K8f_2BV_72cZtuN_F8BgSdSYRKo1edKmUcIn2nSsEFESLQ"/>
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Front-end developer working in a minimalist setting. Bright light, soft shadows, and clean corporate style photography." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_0w2tN-PYg2QvPBUeRWkPNhokfbvZ_00TT0BszUqvIY9OonYPH3mv6og97YYIT-36CE4d_cRSnudOXod8DbFywY8SKtJyjtXm4EB29c0gPkLfkEjjoCkAOv7yQlOZg3He647t0w-v-aZ_lBbiXIoSF6qvGVsucJSNFr7za2aDFiB8oMg3xH9ZlzXp3Onk0FGJBl09pq-qhtPToX7K6aGO86mk1RHIjCQiluDkh_TDmhvbiSKngBEJp8abK0Veani8wFTJdmMNK6Q"/>
</div>
<div class="flex items-center gap-1 text-on-surface-variant">
<span class="material-symbols-outlined text-[18px]" data-icon="timer">timer</span>
<span class="text-[12px]">2d left</span>
</div>
</div>
</div>
</div>
<!-- Column: Review -->
<div class="kanban-column flex flex-col gap-4">
<div class="flex items-center justify-between px-2 mb-2">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-tertiary"></span>
<h3 class="font-headline-md text-headline-md text-on-surface">Review</h3>
<span class="bg-tertiary-fixed/20 px-2 py-0.5 rounded-full text-label-md font-label-md text-tertiary">1</span>
</div>
<button class="text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined" data-icon="more_horiz">more_horiz</span></button>
</div>
<!-- Card 4 -->
<div class="bg-white p-5 rounded-xl card-shadow border border-transparent hover:border-primary transition-all cursor-grab active:cursor-grabbing">
<div class="flex justify-between items-start mb-3">
<span class="bg-tertiary/10 text-tertiary px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Awaiting Feedback</span>
<span class="material-symbols-outlined text-outline cursor-pointer" data-icon="open_in_new">open_in_new</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">API Gateway Documentation</h4>
<p class="text-on-surface-variant text-body-md mb-4 line-clamp-2">Completing Swagger documentation for the core microservices layer.</p>
<div class="mb-4">
<div class="flex justify-between text-label-md mb-1">
<span class="text-on-surface-variant">Progress</span>
<span class="text-primary font-bold">95%</span>
</div>
<div class="w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
<div class="bg-primary h-full rounded-full" style="width: 95%"></div>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="Focused technical writer in a bright, modern corporate environment. Minimalist styling with professional teal highlights." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDo3iMTl1Gukb6canmpOihBV65BfUPaxnfMuAJyrxzNEJ0INGiRNkcf92jdbvuGcjjtlC4fA4G98OW9yLgi5lh_OU1RZ8R_5ezExTjrSerjtdTVvsNQ5G-RcJr-QatN42WvDt5kARBvs-ZhnNWD4w5SgQPlG0HaKLmwpwlh7eeKtdGK1cYFJrKYtbIpJM1cezn3BscN7L31YFrlrf82judzAjtsNw1t9lZ-tjoZJo9Mp9zC8DUGJOL78WUYJaDScqe2Sr1x7-wrls"/>
</div>
<div class="flex items-center gap-1 text-tertiary">
<span class="material-symbols-outlined text-[18px]" data-icon="history_edu">history_edu</span>
<span class="text-[12px]">Pending</span>
</div>
</div>
</div>
</div>
<!-- Column: Done -->
<div class="kanban-column flex flex-col gap-4">
<div class="flex items-center justify-between px-2 mb-2">
<div class="flex items-center gap-2">
<span class="w-2.5 h-2.5 rounded-full bg-on-primary-fixed-variant"></span>
<h3 class="font-headline-md text-headline-md text-on-surface">Done</h3>
<span class="bg-surface-container-highest px-2 py-0.5 rounded-full text-label-md font-label-md text-on-surface">5</span>
</div>
<button class="text-outline hover:text-primary transition-colors"><span class="material-symbols-outlined" data-icon="more_horiz">more_horiz</span></button>
</div>
<!-- Card 5 -->
<div class="bg-white p-5 rounded-xl card-shadow border-transparent grayscale-[0.2] opacity-80 hover:opacity-100 hover:grayscale-0 transition-all cursor-pointer">
<div class="flex justify-between items-start mb-3">
<span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Completed</span>
<span class="material-symbols-outlined text-green-600" data-icon="check_circle">check_circle</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Q3 Resource Allocation</h4>
<p class="text-on-surface-variant text-body-md mb-4 line-clamp-2">Mapping personnel to key enterprise strategic initiatives for the next quarter.</p>
<div class="mb-4">
<div class="flex justify-between text-label-md mb-1">
<span class="text-on-surface-variant">Progress</span>
<span class="text-primary font-bold">100%</span>
</div>
<div class="w-full bg-surface-container-low h-1.5 rounded-full overflow-hidden">
<div class="bg-green-600 h-full rounded-full" style="width: 100%"></div>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex -space-x-2">
<img class="w-8 h-8 rounded-full border-2 border-white object-cover" data-alt="High-level project manager in a crisp white shirt, standing in a brightly lit glass-walled meeting room. Professional corporate photography with teal tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXsJRtInVh9Dcpt0v5cbuXZRivvVcZsoTMO9vQnnOTA44ibZF4H_aVHX5DhING2ceU-Zu_kKAL1318Dl2RHc5Pwe48Yfkii8Sp87dTpjZK1YVVPw4n74VSukZAe3SA8TQ9y851I17YXdneKmN6znTB21d46QsHgVbh7bdmq4rj4TtuiuHmG7118ux1jD8-gjoneApiFULhZ9h8YVq_Q10AqcahVFpCGeEVABoqYqThXvrMsieZfBvCVAH-Qe8Y3teFn6NWzjNbEdY"/>
</div>
<div class="flex items-center gap-1 text-on-surface-variant">
<span class="material-symbols-outlined text-[18px]" data-icon="done_all">done_all</span>
<span class="text-[12px]">Sept 30</span>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Floating Activity Pulse (Atmospheric Effect) -->
<div class="fixed bottom-8 right-8 pointer-events-none">
<div class="relative flex items-center justify-center">
<div class="absolute w-12 h-12 bg-primary/20 rounded-full animate-ping"></div>
<div class="relative w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center shadow-lg pointer-events-auto cursor-help" title="System Operational">
<span class="material-symbols-outlined text-[20px]" data-icon="bolt">bolt</span>
</div>
</div>
</div>
</div>

<script>
// Kanban Card Drag Simulation (Visual feedback only)
const cards = document.querySelectorAll('.kanban-column > div:not(:first-child)');
cards.forEach(card => {
    card.addEventListener('mousedown', () => {
        card.style.transform = 'scale(0.98)';
        card.style.borderColor = 'rgba(0, 128, 128, 0.4)';
    });
    card.addEventListener('mouseup', () => {
        card.style.transform = 'scale(1)';
        card.style.borderColor = 'transparent';
    });
});
</script>
