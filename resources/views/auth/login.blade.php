<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>CollabOps | Enterprise Suite Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-error": "#ffffff",
                "surface-container-lowest": "#ffffff",
                "surface-container": "#e5eeff",
                "error": "#ba1a1a",
                "on-secondary-fixed-variant": "#2d476f",
                "surface-dim": "#cbdbf5",
                "surface": "#f8f9ff",
                "on-primary-fixed-variant": "#004f4f",
                "on-error-container": "#93000a",
                "on-background": "#0b1c30",
                "inverse-on-surface": "#eaf1ff",
                "primary-fixed-dim": "#76d6d5",
                "tertiary-container": "#a96039",
                "outline-variant": "#bdc9c8",
                "surface-container-highest": "#d3e4fe",
                "primary-fixed": "#93f2f2",
                "primary": "#006565",
                "secondary-container": "#b6d0ff",
                "on-tertiary": "#ffffff",
                "secondary": "#455f88",
                "on-primary": "#ffffff",
                "inverse-primary": "#76d6d5",
                "surface-bright": "#f8f9ff",
                "on-secondary-container": "#3f5882",
                "surface-container-low": "#eff4ff",
                "secondary-fixed": "#d6e3ff",
                "surface-container-high": "#dce9ff",
                "on-tertiary-fixed-variant": "#733512",
                "on-secondary-fixed": "#001b3c",
                "error-container": "#ffdad6",
                "on-primary-container": "#e3fffe",
                "inverse-surface": "#213145",
                "tertiary-fixed": "#ffdbcb",
                "primary-container": "#008080",
                "background": "#f8f9ff",
                "tertiary-fixed-dim": "#ffb692",
                "outline": "#6e7979",
                "on-surface-variant": "#3e4949",
                "on-primary-fixed": "#002020",
                "tertiary": "#8b4823",
                "surface-variant": "#d3e4fe",
                "surface-tint": "#006a6a",
                "secondary-fixed-dim": "#adc7f7",
                "on-tertiary-fixed": "#341100",
                "on-surface": "#0b1c30",
                "on-secondary": "#ffffff",
                "on-tertiary-container": "#fff9f7"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "unit": "4px",
                "sidebar-width": "260px",
                "gutter": "16px",
                "container-padding": "24px",
                "card-gap": "20px"
            },
            "fontFamily": {
                "label-md": ["Inter"],
                "headline-lg-mobile": ["Inter"],
                "headline-md": ["Inter"],
                "headline-xl": ["Inter"],
                "body-md": ["Inter"],
                "headline-lg": ["Inter"],
                "body-lg": ["Inter"]
            },
            "fontSize": {
                "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                "headline-lg-mobile": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                "headline-md": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                "headline-xl": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                "headline-lg": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        body {
            background-color: #F8FAFC;
            font-family: 'Inter', sans-serif;
        }
        .login-card-shadow {
            box-shadow: 0px 1px 3px rgba(0,0,0,0.05), 0px 4px 6px rgba(0,0,0,0.02);
        }
        .btn-interaction:active {
            transform: scale(0.98);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-background min-h-screen flex items-center justify-center p-container-padding overflow-hidden">
<!-- Atmospheric Background Decoration -->
<div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
<div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-primary/5 blur-[120px]"></div>
<div class="absolute top-[60%] -right-[5%] w-[30%] h-[30%] rounded-full bg-secondary/5 blur-[100px]"></div>
<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[2px] bg-gradient-to-r from-transparent via-outline-variant/20 to-transparent"></div>
</div>
<!-- Login Container -->
<main class="relative z-10 w-full max-w-[440px]">
<!-- Brand Header (Above Card) -->
<div class="text-center mb-8">
<div class="inline-flex items-center gap-3 mb-2">
<div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center shadow-lg">
<span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">deployed_code</span>
</div>
<h1 class="font-headline-xl text-headline-xl text-on-background tracking-tight">CollabOps</h1>
</div>
<p class="font-body-md text-body-md text-on-surface-variant">Enterprise Operations Suite • v4.2.0</p>
</div>
<!-- Login Card -->
<div class="bg-surface-container-lowest login-card-shadow rounded-xl p-8 md:p-10 border border-outline-variant/30 relative overflow-hidden">
<!-- Subtle Identity Accent -->
<div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-primary-container to-secondary"></div>
<div class="mb-8">
<h2 class="font-headline-lg text-headline-lg text-on-background">Sign In</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Access your project dashboard and resources.</p>
</div>
<form class="space-y-6" method="POST" action="{{ route('login') }}">
@csrf
@if ($errors->any())
<div class="bg-error-container border border-error rounded-lg p-4 mb-4">
<p class="font-label-md text-label-md text-on-error-container">{{ $errors->first() }}</p>
</div>
@endif
<!-- Email Field -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-on-surface-variant ml-1" for="email">Email Address</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline text-[20px] group-focus-within:text-primary transition-colors">mail</span>
</div>
<input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface placeholder:text-outline/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.com" required autofocus autocomplete="username" type="email"/>
@error('email')
<p class="text-error font-label-md text-label-md mt-1">{{ $message }}</p>
@enderror
</div>
</div>
<!-- Password Field -->
<div class="space-y-2">
<div class="flex justify-between items-center ml-1">
<label class="block font-label-md text-label-md text-on-surface-variant" for="password">Password</label>
@if (Route::has('password.request'))
<a class="font-label-md text-label-md text-primary hover:underline transition-all" href="{{ route('password.request') }}">Forgot password?</a>
@endif
</div>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline text-[20px] group-focus-within:text-primary transition-colors">lock</span>
</div>
<input class="w-full pl-10 pr-10 py-3 bg-white border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface placeholder:text-outline/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" type="password"/>
<button class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-on-surface transition-colors" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
@error('password')
<p class="text-error font-label-md text-label-md mt-1">{{ $message }}</p>
@enderror
</div>
<!-- Remember Me -->
<div class="flex items-center">
<input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary cursor-pointer" id="remember" name="remember" type="checkbox"/>
<label class="ml-2 font-body-md text-body-md text-on-surface-variant cursor-pointer select-none" for="remember">Remember this device for 30 days</label>
</div>
<!-- Action Button -->
<button class="w-full bg-primary-container text-white py-3.5 rounded-lg font-label-md text-label-md font-semibold btn-interaction transition-all flex items-center justify-center gap-2 hover:bg-primary shadow-md active:shadow-sm" type="submit">
<span>Sign In to CollabOps</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</button>
</form>
<!-- Footer -->
<footer class="mt-10 text-center space-y-4">
<p class="font-body-md text-body-md text-on-surface-variant">
                New to the platform? <a class="text-primary font-semibold hover:underline" href="#">Request an invite</a>
</p>
<div class="flex justify-center items-center gap-6 font-label-md text-label-md text-outline">
<a class="hover:text-on-surface-variant transition-colors" href="#">Privacy Policy</a>
<span class="w-1 h-1 rounded-full bg-outline/30"></span>
<a class="hover:text-on-surface-variant transition-colors" href="#">Terms of Service</a>
<span class="w-1 h-1 rounded-full bg-outline/30"></span>
<a class="hover:text-on-surface-variant transition-colors" href="#">Security</a>
</div>
</footer>
</div>
</main>
</body></html>
