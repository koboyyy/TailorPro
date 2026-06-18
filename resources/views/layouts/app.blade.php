<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? 'JahitSpace - Solusi Digital Penjahit' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#4A3A2A',
                        secondary: '#30251A',
                        accent: '#e2ddca',
                        grey: '#555555',
                        background: '#FCFCFC',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['"Crimson Pro"', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Theme Detect Script -->
    <script>
        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
</head>

<body class="h-full bg-background text-grey dark:bg-slate-950 dark:text-slate-100 font-sans">
    
    <!-- Mobile Header Toggler -->
    <div class="md:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="rounded-xl bg-primary/10 dark:bg-primary/20 p-2 text-primary dark:text-accent">
                <i class="fas fa-cut text-lg"></i>
            </div>
            <div>
                <span class="font-serif text-lg font-bold tracking-wide text-slate-800 dark:text-white">JAHITSPACE</span>
            </div>
        </div>
        <button id="mobile-sidebar-toggle" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Layout Container -->
    <div class="min-h-full flex flex-col md:flex-row">
        
        <!-- SIDEBAR -->
        <header id="global-sidebar" class="hidden md:flex flex-col border-b md:border-b-0 md:border-r border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 md:w-72 md:fixed md:inset-y-0 z-30 transition-all duration-300">
            
            <!-- LOGO -->
            <div class="flex items-center gap-3 px-6 py-8">
                <div class="">
                    <img src="{{ asset('images/logo_tailorpro.png')}}" alt="JahitSpace Logo" class="w-11 h-11 object-contain">
                </div>

                <div class="leading-tight">
                    <div class="font-bold tracking-tight text-slate-800 dark:text-white font-serif text-lg">
                        TailorPro
                    </div>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="flex-1 overflow-y-auto px-4 space-y-1">
                <div class="mb-2 px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                    MENU UTAMA
                </div>

                @php
                    $active = "bg-primary text-white font-bold shadow-md shadow-primary/10";
                    $default = "text-grey hover:bg-background dark:text-slate-400 dark:hover:bg-slate-800 hover:text-secondary dark:hover:text-slate-200";
                @endphp

                <!-- Beranda link -->
                <a href="/dashboard" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('dashboard') ? $active : $default }}">
                    <i class="fas fa-desktop w-5"></i>
                    <span>Beranda</span>
                </a>

                <!-- Pesanan link -->
                <a href="/pesanan" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('pesanan*') ? $active : $default }}">
                    <i class="fas fa-exchange-alt w-5"></i>
                    <span>Pesanan</span>
                </a>

                <!-- Hasilkan Pola link -->
                <a href="/hasilan-pola" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('hasilan-pola*') ? $active : $default }}">
                    <i class="fas fa-crop-simple w-5"></i>
                    <span>Hasilkan Pola</span>
                </a>

                <!-- Data Pelanggan link -->
                <a href="/data-pelanggan" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('data-pelanggan*') ? $active : $default }}">
                    <i class="fas fa-user-group w-5"></i>
                    <span>Data Pelanggan</span>
                </a>

                <!-- Ukuran Baju link -->
                <a href="/ukuran-baju" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('ukuran-baju*') ? $active : $default }}">
                    <i class="fas fa-ruler-combined w-5"></i>
                    <span>Ukuran Baju</span>
                </a>

                <!-- Arsip Pola link -->
                <a href="/arsip-pola" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('arsip-pola*') ? $active : $default }}">
                    <i class="fas fa-box-archive w-5"></i>
                    <span>Arsip Pola</span>
                </a>

                <!-- Laporan link -->
                <a href="/laporan" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('laporan*') ? $active : $default }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Laporan</span>
                </a>
            </nav>

            <!-- FOOTER -->
            <div class="border-t border-slate-100 p-4 dark:border-slate-800">
                <!-- THEME TOGGLE -->
                <button
                    type="button"
                    data-theme-toggle
                    class="mb-3 flex w-full items-center justify-between rounded-xl border border-slate-200 dark:border-slate-800 px-4 py-2 text-[10px] font-bold text-grey dark:text-slate-400 hover:bg-background dark:hover:bg-slate-800 transition-all"
                >
                    <span class="flex items-center gap-2">
                        <i class="fas fa-moon"></i>
                        TEMA MODE
                    </span>
                </button>

                <!-- USER CARD -->
                <div class="rounded-2xl bg-background p-3 dark:bg-slate-800/50">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl border border-primary/20 bg-primary/10 text-primary dark:border-primary/30 dark:bg-primary/20 dark:text-accent">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Admin avatar" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <div class="truncate text-xs font-bold text-slate-800 dark:text-white">
                                @if(auth()->check())
                                    {{ auth()->user()->name }}
                                @else
                                    Admin Jahit
                                @endif
                            </div>

                            <div class="text-[10px] font-medium text-grey/80 dark:text-slate-400">
                                Administrator
                            </div>
                        </div>

                        <a href="#" class="text-slate-400 transition-colors hover:text-primary">
                            <i class="fas fa-cog"></i>
                        </a>
                    </div>

                    <!-- BADGE -->
                    <div class="mt-2 inline-flex items-center gap-1 rounded-lg bg-primary/10 px-2 py-1 text-[10px] font-black uppercase text-primary dark:bg-primary/30 dark:text-accent">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        Role Aktif
                    </div>
                </div>

                <!-- LOGOUT -->
                <form id="logout-form" action="/logout" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-2 flex w-full items-center gap-3 rounded-xl px-3 py-2 text-xs font-bold text-red-500 transition-all hover:bg-red-50 dark:hover:bg-red-950/20">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </header>

        <!-- Overlay when mobile menu is open -->
        <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-20 hidden"></div>

        <!-- CONTENT -->
        <div class="flex-1 md:ml-72">

            <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#EFECE6]/70 px-4 py-5 sm:px-6 lg:px-8">
                    <!-- Breadcrumbs -->
                    <div class="text-xs text-grey font-medium tracking-wide">
                        <span>@yield('breadcrumb-parent', 'page')</span>
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="text-primary font-semibold">@yield('breadcrumb-active', 'ukuran baju')</span>
                    </div>

                    <!-- Search & User Profile -->
                    <div class="flex items-center gap-4 self-end sm:self-auto">
                        <div class="relative w-64 max-w-xs">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none text-xs">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="search-input" placeholder="Pencarian pelanggan..." class="w-full pl-9 pr-4 py-2 bg-background dark:bg-slate-800 text-secondary dark:text-white text-xs border border-transparent rounded-full shadow-sm placeholder-grey/60 focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
                        </div>

                        <div class="h-8 w-px bg-[#EFECE6]"></div>

                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-primary">Admin</span>
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Admin Profile" class="w-8 h-8 rounded-full object-cover border border-[#EFECE6]">
                        </div>
                    </div>
                </header>

            <main class="px-4 py-8 sm:px-6 lg:px-8">
                

                @if (session('success'))
                    <div class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-200">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- DARK MODE & MOBILE MENU SCRIPTS -->
    <script>
        // Theme Toggler Logic
        const themeToggleBtn = document.querySelector("[data-theme-toggle]");
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener("click", function () {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");
                    localStorage.theme = "light";
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.theme = "dark";
                }
            });
        }

        // Mobile Sidebar Toggle Logic
        const mobileToggle = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('global-sidebar');
        const overlay = document.getElementById('mobile-sidebar-overlay');

        if (mobileToggle && sidebar && overlay) {
            mobileToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }

        function toggleSidebar() {
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('fixed');
            sidebar.classList.toggle('inset-y-0');
            sidebar.classList.toggle('left-0');
            sidebar.classList.toggle('flex');
            overlay.classList.toggle('hidden');
        }
    </script>
    @yield('scripts')
</body>
</html>
