<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - JahitSpace</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,300..900;1,300..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E130B',
                        secondary: '#412E15',
                        accent: '#e2ddca',
                        background: '#F8F9FA',
                        sidebar: '#FAF9F6'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['"Crimson Pro"', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-primary bg-background">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-sidebar border-r border-gray-200 flex flex-col flex-shrink-0">
            <!-- Logo -->
            <div class="p-6 flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo JahitSpace" class="w-12 h-12 object-contain">
                <span class="font-serif font-bold text-xl text-primary">JahitSpace</span>
            </div>
            
            <!-- Menu -->
            <div class="px-4 py-2 flex-1 overflow-y-auto">
                <p class="text-[10px] font-bold text-gray-400 mb-4 px-2 tracking-widest uppercase">Menu Utama</p>
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#54433A] text-white rounded-xl shadow-sm">
                        <i class="fa-solid fa-border-all w-5"></i>
                        <span class="font-medium text-sm">Dashboard</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-100 hover:text-gray-800 rounded-xl transition-colors">
                        <i class="fa-solid fa-ruler w-5"></i>
                        <span class="font-medium text-sm">Ukuran Baju</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-100 hover:text-gray-800 rounded-xl transition-colors">
                        <i class="fa-solid fa-shirt w-5"></i>
                        <span class="font-medium text-sm">Hasilkan Pola</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-100 hover:text-gray-800 rounded-xl transition-colors">
                        <i class="fa-solid fa-bars-progress w-5"></i>
                        <span class="font-medium text-sm">Status Pengerjaan</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-100 hover:text-gray-800 rounded-xl transition-colors">
                        <i class="fa-solid fa-users w-5"></i>
                        <span class="font-medium text-sm">Data Pelanggan</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-100 hover:text-gray-800 rounded-xl transition-colors">
                        <i class="fa-solid fa-file-lines w-5"></i>
                        <span class="font-medium text-sm">Laporan</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-background">
            
            <!-- Topbar -->
            <header class="h-20 bg-background flex items-center justify-between px-8 border-b border-gray-200 flex-shrink-0">
                <!-- Breadcrumbs -->
                <div class="text-sm text-gray-400">
                    page / <span class="text-gray-600">ukuran baju</span>
                </div>
                
                <!-- Right side -->
                <div class="flex items-center gap-6">
                    <!-- Search -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Pencarian" class="pl-10 pr-4 py-2.5 bg-white border border-gray-100 shadow-sm rounded-full text-sm focus:outline-none focus:ring-1 focus:ring-gray-200 w-64 text-gray-600">
                    </div>
                    
                    <!-- Profile -->
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-700">Admin</span>
                        <img src="https://ui-avatars.com/api/?name=Admin&background=8B7355&color=fff" alt="Admin" class="w-9 h-9 rounded-full object-cover">
                    </div>
                </div>
            </header>
            
            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8 relative">
                @yield('content')
            </main>
            
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>
