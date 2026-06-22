<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>CollabOps | Member Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-error-container": "#93000a",
                "inverse-primary": "#76d6d5",
                "surface-container-low": "#eff4ff",
                "on-tertiary-fixed-variant": "#733512",
                "secondary-fixed-dim": "#adc7f7",
                "surface-container-lowest": "#ffffff",
                "primary-container": "#008080",
                "on-background": "#0b1c30",
                "secondary-container": "#b6d0ff",
                "on-surface": "#0b1c30",
                "on-surface-variant": "#3e4949",
                "on-secondary-fixed-variant": "#2d476f",
                "secondary": "#455f88",
                "outline": "#6e7979",
                "on-primary": "#ffffff",
                "background": "#f8f9ff",
                "on-primary-fixed": "#002020",
                "primary-fixed": "#93f2f2",
                "surface-bright": "#f8f9ff",
                "on-primary-container": "#e3fffe",
                "error-container": "#ffdad6",
                "on-tertiary-container": "#fff9f7",
                "tertiary-fixed": "#ffdbcb",
                "outline-variant": "#bdc9c8",
                "surface-dim": "#cbdbf5",
                "surface-container-high": "#dce9ff",
                "tertiary": "#8b4823",
                "primary-fixed-dim": "#76d6d5",
                "inverse-on-surface": "#eaf1ff",
                "on-secondary-fixed": "#001b3c",
                "error": "#ba1a1a",
                "on-tertiary-fixed": "#341100",
                "on-tertiary": "#ffffff",
                "on-primary-fixed-variant": "#004f4f",
                "surface-container-highest": "#d3e4fe",
                "on-secondary": "#ffffff",
                "on-secondary-container": "#3f5882",
                "surface-tint": "#006a6a",
                "inverse-surface": "#213145",
                "tertiary-fixed-dim": "#ffb692",
                "surface-variant": "#d3e4fe",
                "surface": "#f8f9ff",
                "primary": "#006565",
                "secondary-fixed": "#d6e3ff",
                "tertiary-container": "#a96039",
                "surface-container": "#e5eeff",
                "on-error": "#ffffff"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "unit": "4px",
                "card-gap": "20px",
                "sidebar-width": "260px",
                "gutter": "16px",
                "container-padding": "24px"
            },
            "fontFamily": {
                "body-md": ["Inter"],
                "headline-xl": ["Inter"],
                "headline-md": ["Inter"],
                "body-lg": ["Inter"],
                "headline-lg": ["Inter"],
                "label-md": ["Inter"]
            },
            "fontSize": {
                "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                "headline-xl": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                "headline-lg": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; color: #0b1c30; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-shadow { box-shadow: 0px 1px 3px rgba(0,0,0,0.05), 0px 4px 6px rgba(0,0,0,0.02); }
        .active-nav-border { border-left: 4px solid #008080; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-background">
<!-- Fixed SideNavBar -->
<aside class="fixed left-0 top-0 h-screen w-sidebar-width bg-on-background flex flex-col py-6 z-50">
<div class="px-6 mb-10">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary-fixed">CollabOps</h1>
<p class="font-label-md text-label-md text-surface-variant opacity-70">Enterprise Suite</p>
</div>
<nav class="flex-1 space-y-1">
    @php
        $navItems = [
            ['name' => 'Dashboard', 'icon' => 'dashboard', 'url' => url('user/dashboarduser')],
            ['name' => 'My Project Diary', 'icon' => 'assignment', 'url' => url('user/diaryuser')],
            ['name' => 'Join / Create Project', 'icon' => 'folder_shared', 'url' => url('user/joinproject')],
            ['name' => 'Calendar', 'icon' => 'calendar_today', 'url' => url('user/calendar')],
            ['name' => 'House Rules', 'icon' => 'gavel', 'url' => url('user/houseRule')],
            ['name' => 'Piket Schedule', 'icon' => 'schedule', 'url' => url('user/piket_schedule')],
        ];
    @endphp

    @foreach($navItems as $item)
        @php
            $isActive = request()->url() == $item['url'];
        @endphp
        <a class="{{ $isActive ? 'border-l-4 border-primary bg-primary-container/10 text-primary-fixed font-semibold' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }} flex items-center gap-3 px-4 py-3 transition-colors duration-200" href="{{ $item['url'] }}">
            <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
            <span class="font-body-md text-body-md">{{ $item['name'] }}</span>
        </a>
    @endforeach
</nav>
<div class="mt-auto px-4 space-y-1">
<a class="text-surface-variant hover:text-white flex items-center gap-3 px-4 py-3 hover:bg-on-secondary-fixed-variant/20 transition-colors duration-200" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-body-md text-body-md">Help Center</span>
</a>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a class="text-surface-variant hover:text-white flex items-center gap-3 px-4 py-3 hover:bg-on-secondary-fixed-variant/20 transition-colors duration-200" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        <span class="material-symbols-outlined">logout</span>
        <span class="font-body-md text-body-md">Logout</span>
    </a>
</form>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-[260px] min-h-screen">
<!-- TopNavBar -->
<header class="h-16 flex items-center justify-between px-container-padding bg-surface border-b border-outline-variant sticky top-0 z-40">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full bg-surface-container-low border-none rounded-lg pl-10 pr-4 py-2 text-body-md focus:ring-2 focus:ring-primary/20" placeholder="Search tasks or documents..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary">notifications</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary">history</span>
</div>
<div class="flex items-center gap-3 pl-6 border-l border-outline-variant">
<div class="text-right hidden sm:block">
<p class="font-label-md text-label-md text-on-surface">Alex Rivera</p>
<p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Product Designer</p>
</div>
<img class="w-10 h-10 rounded-full object-cover ring-2 ring-primary/10" data-alt="A professional corporate headshot of a young adult designer with a friendly expression. The lighting is soft and studio-quality, emphasizing a clean, high-end professional aesthetic. The background is a soft, out-of-focus modern office environment with neutral tones and teal accents that align with the corporate teal branding." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpAfEuKziAXfnRn4tjIus4OWEo9KuoXRq5IdirlX_XdIFo5gIYxMLGBTNXfIVP54nS2UhHHjjFp6ix4dJTlgmLe9EOKZZdSr8-JRbT3dKhW1UKNQaIa2b1w6eGCo3dkqM4S5GmOQxa70V7FAl0wIbuRTm3zDjrBwPiRIjqna1MhVkk9IdTBQDpoZnZzL0WKLlhP381JKHE_jLQSc0FWrJS5i_f1b_wLODjaRPM8nzQ4K7Sys9TJNOGRI04t1M-7zQTMkQbAK1FTIE"/>
</div>
</div>
</header>