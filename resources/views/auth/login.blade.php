<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TailorPro</title>
    
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
</head>
<body class="h-full flex items-center justify-center bg-[#F4F1EA] dark:bg-slate-950 p-6 font-sans">

    <!-- Background Pattern/Circles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-accent/20 dark:bg-primary/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-primary/5 dark:bg-primary/20 blur-3xl"></div>
    </div>

    <!-- Login Container Card -->
    <div class="relative z-10 w-full max-w-md bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-[#EFECE6] dark:border-slate-800/80 p-8 rounded-3xl shadow-[0_20px_50px_rgba(74,58,42,0.08)] transition-all duration-300">
        
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-primary text-accent shadow-lg shadow-primary/20 mb-4 animate-bounce">
                <i class="fas fa-cut text-xl"></i>
            </div>
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-2">Masuk ke TailorPro</h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola pelanggan dan pesanan jahit Anda secara digital</p>
        </div>

        <!-- Form -->
        <form action="/login" method="POST" class="space-y-5">
            @csrf
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none text-xs">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full pl-10 pr-4 py-3.5 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>
                @error('email')
                    <p class="text-[10px] text-red-500 font-semibold mt-1.5 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Kata Sandi</label>
                    <a href="#" class="text-[10px] font-bold text-primary hover:text-secondary dark:text-accent dark:hover:text-accent/80 transition">Lupa Sandi?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none text-xs">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full pl-10 pr-10 py-3.5 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-white transition text-xs px-2 focus:outline-none">
                        <i id="eye-icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-[10px] text-red-500 font-semibold mt-1.5 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me checkbox -->
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-primary bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded focus:ring-primary focus:ring-offset-0 focus:outline-none cursor-pointer">
                <label for="remember" class="ml-2 text-[11px] font-medium text-grey dark:text-slate-400 cursor-pointer select-none">Ingat saya di perangkat ini</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-primary hover:bg-secondary text-accent font-bold text-xs rounded-2xl shadow-lg shadow-primary/10 hover:shadow-primary/25 transition duration-200 active:scale-95">
                <i class="fas fa-sign-in-alt text-[10px]"></i>
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative flex items-center justify-center my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-[#EFECE6] dark:border-slate-800"></div>
            </div>
            <span class="relative px-3 bg-white dark:bg-slate-900 text-[10px] font-bold text-gray-400 uppercase">atau</span>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-xs text-grey dark:text-slate-400 font-medium">
                Belum punya akun TailorPro? 
                <a href="/register" class="font-bold text-primary hover:text-secondary dark:text-accent dark:hover:text-accent/80 transition ml-0.5">Daftar Baru</a>
            </p>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }
    </script>
</body>
</html>
