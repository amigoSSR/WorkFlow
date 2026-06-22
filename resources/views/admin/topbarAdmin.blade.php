<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>CollabOps | Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
        body { font-family: 'Inter', sans-serif; background-color: #f8f9ff; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .sidebar-active {
            border-left: 4px solid #008080;
            background-color: rgba(0, 128, 128, 0.1);
            color: #002020;
            font-weight: 600;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #bdc9c8; border-radius: 10px; }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="text-on-surface">
<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-screen w-sidebar-width bg-on-background dark:bg-inverse-surface flex flex-col py-6 shadow-sm z-50">
<div class="px-6 mb-8">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary-fixed">CollabOps</h1>
<p class="text-label-md font-label-md text-surface-variant uppercase tracking-wider">Enterprise Suite</p>
</div>
<nav class="flex-1 flex flex-col gap-1 overflow-y-auto custom-scrollbar">
@php
    $current = Route::currentRouteName();
@endphp
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.dashboard' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.dashboard') }}">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-body-md text-body-md">Overview</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.users' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.users') }}">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-body-md text-body-md">User Management</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.projects' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.projects') }}">
<span class="material-symbols-outlined" data-icon="assignment">assignment</span>
<span class="font-body-md text-body-md">Project Management</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.diary' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.diary') }}">
<span class="material-symbols-outlined" data-icon="auto_stories">auto_stories</span>
<span class="font-body-md text-body-md">Diary &amp; Activity</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.checkup' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.checkup') }}">
<span class="material-symbols-outlined" data-icon="fact_check">fact_check</span>
<span class="font-body-md text-body-md">Weekly Check-up</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.calendar' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.calendar') }}">
<span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
<span class="font-body-md text-body-md">Calendar</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.house.rules' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.house.rules') }}">
<span class="material-symbols-outlined" data-icon="gavel">gavel</span>
<span class="font-body-md text-body-md">House Rules</span>
</a>
<a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 {{ $current === 'admin.piket' ? 'sidebar-active' : 'text-surface-variant hover:text-white hover:bg-on-secondary-fixed-variant/20' }}" href="{{ route('admin.piket') }}">
<span class="material-symbols-outlined" data-icon="cleaning_services">cleaning_services</span>
<span class="font-body-md text-body-md">Piket</span>
</a>
</nav>
<div class="px-6 mt-auto pt-6 border-t border-on-secondary-fixed-variant/30 flex flex-col gap-2">
<a class="text-surface-variant hover:text-white flex items-center gap-3 py-2 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="help">help</span>
<span class="font-body-md text-body-md">Help Center</span>
</a>
<form method="POST" action="{{ route('logout') }}" class="m-0">
@csrf
<button type="submit" class="text-surface-variant hover:text-white flex items-center gap-3 py-2 transition-colors w-full">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-body-md text-body-md">Logout</span>
</button>
</form>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-[260px] min-h-screen">
<!-- TopAppBar -->
<header class="sticky top-0 right-0 w-full h-16 bg-surface dark:bg-on-background border-b border-outline-variant flex items-center justify-between px-container-padding z-40">
<!-- Left: Navigation -->
<nav class="hidden md:flex items-center gap-8">

</nav>
<!-- Right: Actions & Profile -->
<div class="flex items-center gap-6 ml-auto">
<button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full transition-all active:scale-95" title="Notifications">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full transition-all active:scale-95" title="History">
<span class="material-symbols-outlined" data-icon="history">history</span>
</button>
<!-- Profile Avatar -->
<div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
<div class="text-right hidden sm:block">
<p class="text-sm font-semibold text-on-surface">Admin User</p>
<p class="text-xs text-on-surface-variant">Administrator</p>
</div>
<div class="h-10 w-10 rounded-full overflow-hidden border-2 border-primary flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="A professional headshot of a corporate administrator in a high-tech office environment. The person is smiling confidently, wearing modern business attire. The lighting is soft and cinematic, with a blurred background of a sleek, minimalist digital command center featuring soft teal and white tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXnL2K6AyEzuHi8r9kVMMMU8sK4i5QYaxTjAn4hoyLIcXogOu0zLAnnpcb_MgqpMukJTl611Wv4ZrkYJ0R27uLx1ff6J_OlvAqO8yIbvNxbql15wpPRAMR18ACjcmWYRnu6GA8S9hibFrVHkyXL-F6uFMzLsHA8V4MFEH9ZXkroYW4-jOUPrEUTo5L0B0sy4bY2fC8I_8fgdNzy7dsMwlrSTg8K1DSI-HwNeOP0HDW4V5aPi8NmZeXLTcDMgvO3jmKDC5bZ6ClFGA"/>
</div>
</div>
</div>
</header>

<!-- Include Kanban Board Content -->