<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? 'TailorPro - Solusi Digital Penjahit' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Vite (Tailwind + JS) -->
    @vite (['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Detect Script -->
    <script>
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="h-full bg-background text-grey dark:bg-slate-950 dark:text-slate-100 font-sans">
    <!-- Mobile Header Toggler -->
    <div
        class="md:hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-6 py-4 flex justify-between items-center"
    >
        <div class="flex items-center gap-3">
            <div
                class="rounded-xl bg-primary/10 dark:bg-primary/20 p-2 text-primary dark:text-accent"
            >
                <i class="fas fa-cut text-lg"></i>
            </div>
            <div>
                <span
                    class="font-serif text-lg font-bold tracking-wide text-slate-800 dark:text-white"
                    >JAHITSPACE</span
                >
            </div>
        </div>
        <button
            id="mobile-sidebar-toggle"
            class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white focus:outline-none"
        >
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Layout Container -->
    <div class="min-h-full flex flex-col md:flex-row">
        <!-- SIDEBAR -->
        <header
            id="global-sidebar"
            class="hidden md:flex flex-col border-b md:border-b-0 md:border-r border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900 md:w-72 md:fixed md:inset-y-0 z-30 transition-all duration-300"
        >
            <!-- LOGO -->
            <div class="flex items-center gap-3 px-6 py-8">
                <div class="">
                    <img
                        src="{{ asset('images/logo_tailorpro.png')}}"
                        alt="JahitSpace Logo"
                        class="w-11 h-11 object-contain"
                    />
                </div>

                <div class="leading-tight">
                    <div
                        class="font-bold tracking-tight text-slate-800 dark:text-white font-serif text-lg"
                    >
                        TailorPro
                    </div>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="flex-1 overflow-y-auto px-4 space-y-1">
                <div
                    class="mb-2 px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500"
                >
                    MENU UTAMA
                </div>

                @php
                    $active = "bg-primary text-white font-bold shadow-md shadow-primary/10";
                    $default = "text-grey hover:bg-background dark:text-slate-400 dark:hover:bg-slate-800 hover:text-secondary dark:hover:text-slate-200";
                @endphp

                <!-- Beranda link -->
                <a
                    href="/dashboard"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('dashboard') ? $active : $default }}"
                >
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Beranda</span>
                </a>

                <!-- Pesanan link -->
                <a
                    href="/pesanan"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('pesanan*') ? $active : $default }}"
                >
                    <i class="fas fa-file-invoice w-5"></i>
                    <span>Pesanan</span>
                </a>

                <!-- Pola Busana link -->
                <a
                    href="/pola-busana"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('pola-busana*') || Request::is('hasilkan-pola*') ? $active : $default }}"
                >
                    <i class="fas fa-pen-ruler w-5"></i>
                    <span>Pola Busana</span>
                </a>

                <!-- Pelanggan link -->
                <a
                    href="/data-pelanggan"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('data-pelanggan*') ? $active : $default }}"
                >
                    <i class="fas fa-user-group w-5"></i>
                    <span>Pelanggan</span>
                </a>

                <!-- Laporan link -->
                <a
                    href="/laporan"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all {{ Request::is('laporan*') ? $active : $default }}"
                >
                    <i class="fas fa-file-alt w-5"></i>
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
                        <div
                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl border border-primary/20 bg-primary/10 text-primary dark:border-primary/30 dark:bg-primary/20 dark:text-accent"
                        >
                            <img
                                src="{{ auth()->check() && auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->check() ? auth()->user()->name : 'Admin') . '&background=E5E7EB&color=374151' }}"
                                alt="Admin avatar"
                                class="w-full h-full object-cover"
                            />
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <div class="truncate text-xs font-bold text-slate-800 dark:text-white">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @else
                                    Admin Jahit
                                @endif
                            </div>

                            <div class="text-[10px] font-medium text-grey/80 dark:text-slate-400">
                                Administrator
                            </div>
                        </div>

                        <button
                            onclick="
                                document.getElementById('profile-modal').classList.remove('hidden')
                            "
                            class="text-slate-400 transition-colors hover:text-primary"
                        >
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>

                    <!-- BADGE -->
                    <div
                        class="mt-2 inline-flex items-center gap-1 rounded-lg bg-primary/10 px-2 py-1 text-[10px] font-black uppercase text-primary dark:bg-primary/30 dark:text-accent"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        Role Aktif
                    </div>
                </div>

                <!-- LOGOUT -->
                <form id="logout-form" action="/logout" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </header>

        <!-- Overlay when mobile menu is open -->
        <div
            id="mobile-sidebar-overlay"
            class="fixed inset-0 bg-black/30 backdrop-blur-sm z-20 hidden"
        ></div>

        <!-- CONTENT -->
        <div class="flex-1 md:ml-72">
            <header
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#EFECE6]/70 px-4 py-5 sm:px-6 lg:px-8"
            >
                <!-- Breadcrumbs -->
                <div class="text-xs text-grey font-medium tracking-wide">
                    <span>@yield ('breadcrumb-parent', 'page')</span>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-primary font-semibold">
                        @yield ('breadcrumb-active', 'ukuran baju')
                    </span>
                </div>

                <!-- Search & User Profile -->
                <div class="flex items-center gap-4 self-end sm:self-auto">
                    <form
                        action="{{ url('/data-pelanggan') }}"
                        method="GET"
                        class="relative w-64 max-w-xs"
                    >
                        <span
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 pointer-events-none text-xs"
                        >
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            id="search-input"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Pencarian pelanggan..."
                            class="w-full pl-9 pr-4 py-2 bg-background dark:bg-slate-800 text-secondary dark:text-white text-xs border border-transparent rounded-full shadow-sm placeholder-grey/60 focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        />
                    </form>

                    <div class="h-8 w-px bg-[#EFECE6]"></div>

                    <button
                        onclick="
                            document.getElementById('profile-modal').classList.remove('hidden')
                        "
                        class="flex items-center gap-3 hover:opacity-80 transition-opacity focus:outline-none"
                    >
                        <span class="text-xs font-semibold text-primary">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @else
                                Admin
                            @endif
                        </span>
                        <img
                            src="{{ auth()->check() && auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->check() ? auth()->user()->name : 'Admin') . '&background=4A3A2A&color=fff' }}"
                            alt="Admin Profile"
                            class="w-8 h-8 rounded-full object-cover border border-[#EFECE6]"
                        />
                    </button>
                </div>
            </header>

            <main class="px-4 py-8 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div
                        class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-200"
                    >
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield ('content')
            </main>
        </div>
    </div>

    <!-- DARK MODE & MOBILE MENU SCRIPTS -->
    <script>
        // Theme Toggler Logic
        const themeToggleBtn = document.querySelector('[data-theme-toggle]');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function () {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
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

    <!-- Profile Modal -->
    <div id="profile-modal" class="fixed inset-0 z-50 hidden">
        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            onclick="document.getElementById('profile-modal').classList.add('hidden')"
        ></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-slate-900 rounded-2xl shadow-xl w-[90%] max-w-md max-h-[90vh] overflow-hidden flex flex-col"
        >
            <div class="p-6 overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold font-serif text-slate-800 dark:text-white">
                        Profil Admin
                    </h2>
                    <button
                        onclick="document.getElementById('profile-modal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                    >
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <div class="flex justify-center mb-6 relative group">
                        <div
                            class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-200 relative"
                        >
                            <img
                                id="avatar-preview"
                                src="{{ auth()->check() && auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->check() ? auth()->user()->name : 'Admin') . '&background=E5E7EB&color=374151' }}"
                                alt="Preview"
                                class="w-full h-full object-cover"
                            />
                            <div
                                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                                onclick="document.getElementById('avatar-input').click()"
                            >
                                <i class="fas fa-camera text-white text-xl"></i>
                            </div>
                        </div>
                        <input
                            type="file"
                            id="avatar-input"
                            name="avatar"
                            class="hidden"
                            accept="image/*"
                            onchange="previewImage(this)"
                        />
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-slate-400 mb-1"
                                >Nama Lengkap</label
                            >
                            <input
                                type="text"
                                name="name"
                                value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                required
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary dark:text-white"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-slate-400 mb-1"
                                >Email</label
                            >
                            <input
                                type="email"
                                name="email"
                                value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                required
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary dark:text-white"
                            />
                        </div>
                        <hr class="border-gray-100 dark:border-slate-800 my-4" />
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-slate-400 mb-1"
                                >Password Saat Ini (kosongkan jika tidak diubah)</label
                            >
                            <input
                                type="password"
                                name="current_password"
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary dark:text-white"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-slate-400 mb-1"
                                >Password Baru</label
                            >
                            <input
                                type="password"
                                name="new_password"
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary dark:text-white"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-600 dark:text-slate-400 mb-1"
                                >Konfirmasi Password Baru</label
                            >
                            <input
                                type="password"
                                name="new_password_confirmation"
                                class="w-full px-3 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary dark:text-white"
                            />
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full mt-6 py-2.5 bg-primary hover:bg-secondary text-white text-sm font-bold rounded-xl transition-colors"
                    >
                        Simpan Perubahan
                    </button>
                </form>

                <hr class="border-gray-100 dark:border-slate-800 my-6" />

                <button
                    onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    "
                    class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 dark:bg-red-900/20 dark:hover:bg-red-900/40 text-sm font-bold rounded-xl transition-colors flex items-center justify-center gap-2"
                >
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @yield ('scripts')
</body>
</html>
