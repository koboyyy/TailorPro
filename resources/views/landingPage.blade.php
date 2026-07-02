<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailor Pro - Solusi Digital Penjahit</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #4A3A2A;
            --color-secondary: #30251A;
            --color-accent: #E2DDCA;
            --color-background: #FCFCFC;
            --color-surface: #FFFFFF;
            --color-text: #333333;
            --color-on-surface: #333333;
            --color-grey: #555555;
        }
        .dark {
            --color-primary: #d5c4b4;
            --color-secondary: #e4d9cd;
            --color-accent: #35301d;
            --color-background: #030303;
            --color-surface: #131313;
            --color-text: #cccccc;
            --color-on-surface: #cccccc;
            --color-grey: #555555;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--color-primary)',
                        secondary: 'var(--color-secondary)',
                        accent: 'var(--color-accent)',
                        surface: 'var(--color-surface)',
                        'on-surface': 'var(--color-on-surface)',
                        grey: 'var(--color-grey)',
                        background: 'var(--color-background)',
                        text: 'var(--color-text)',
                    },
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                        serif: ['"DM Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #4a3a2a;
        }
        ::-webkit-scrollbar-thumb {
            background: #30251a;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #e2ddca;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-sans antialiased text-primary bg-background">
    <!-- Navbar -->
    <nav
        class="absolute w-full z-10 top-0 py-6 px-8 md:px-16 flex justify-between items-center text-accent"
    >
        <div class="flex items-center gap-2">
            <i class="fas fa-cut text-2xl text-accent"></i>
            <span class="font-serif text-2xl font-bold">TailorPro</span>
        </div>
        <div class="hidden md:flex gap-8 text-sm font-medium">
            <a href="#fitur" class="hover:text-white transition">Fitur</a>
            <a href="#harga" class="hover:text-white transition">Harga</a>
            <a href="#tentang" class="hover:text-white transition">Tentang Kami</a>
        </div>
        <div class="hidden md:flex gap-4 items-center text-sm font-medium">
            <a href="/login" class="hover:text-white transition">Login</a>
            <a href="/register" class="hover:text-white transition">Register</a>
        </div>
        <!-- Mobile Menu Icon -->
        <div class="md:hidden">
            <i class="fas fa-bars text-xl"></i>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative bg-primary pt-32 pb-20 md:pt-48 md:pb-32 px-8 md:px-16 overflow-hidden flex flex-col md:flex-row items-center justify-between"
    >
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img
                src="{{ asset('images/hero_background.png') }}"
                alt="Hero Background"
                class="w-full h-full object-cover opacity-30"
            />
        </div>

        <div class="relative z-10 md:w-5/12 text-accent mb-12 md:mb-0">
            <h1 class="font-serif text-5xl md:text-7xl font-bold mb-6 leading-tight">TylorPro</h1>
            <p class="text-accent/80 text-lg md:text-xl font-light mb-10 leading-relaxed">TailorPro hadir untuk membantu penjahit, butik, dan konveksi mengelola data pelanggan, ukuran baju, referensi desain, hingga tracking pengerjaan secara lebih praktis dan profesional.</p>
            <a
                href="/login"
                class="inline-block border border-accent text-accent px-10 py-3 rounded-full hover:bg-accent hover:text-primary transition duration-300 font-medium text-lg"
            >
                Login
            </a>
        </div>
    </section>

    <!-- Fitur Utama Section -->
    <section id="fitur" class="bg-secondary py-24 px-8 md:px-16">
        <div class="max-w-6xl mx-auto text-center mb-16">
            <h2 class="font-serif text-4xl font-bold text-accent mb-4">Fitur Utama</h2>
            <p class="text-accent/70 text-lg max-w-2xl mx-auto">Dirancang untuk membantu pekerjaan jadi lebih cepat, mudah, dan nyaman.</p>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-ruler-combined text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Ukuran Baju</h3>
                <p class="text-accent/60 text-sm">Catat dan simpan ukuran pelanggan dengan lengkap dan rapi.</p>
            </div>
            <!-- Card 2 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-tshirt text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Hasilkan Pola Otomatis</h3>
                <p class="text-accent/60 text-sm">Buat pola pakaian otomatis berdasarkan data ukuran pelanggan.</p>
            </div>
            <!-- Card 3 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="far fa-image text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Referensi Desain Baju</h3>
                <p class="text-accent/60 text-sm">Simpan foto referensi desain pakaian dari pelanggan.</p>
            </div>
            <!-- Card 4 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="far fa-calendar-check text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Jadwal Pengerjaan</h3>
                <p class="text-accent/60 text-sm">Atur jadwal jahit, fitting, hingga deadline pesanan dengan lebih terorganisir.</p>
            </div>
            <!-- Card 5 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-users text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Data Pelanggan</h3>
                <p class="text-accent/60 text-sm">Kelola seluruh informasi pelanggan dalam satu tempat.</p>
            </div>
            <!-- Card 6 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-route text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Tracking Pengerjaan</h3>
                <p class="text-accent/60 text-sm">Pantau progres penerimaan pesanan secara real-time.</p>
            </div>
            <!-- Card 7 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-cloud text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Simpan Data Aman</h3>
                <p class="text-accent/60 text-sm">Semua data pelanggan dan ukuran tersimpan dengan aman dan mudah dicari.</p>
            </div>
            <!-- Card 8 -->
            <div
                class="bg-primary border border-secondary rounded-2xl p-8 flex flex-col items-center text-center hover:bg-secondary/40 transition duration-300 group cursor-pointer"
            >
                <div
                    class="w-16 h-16 rounded-full bg-secondary/30 flex items-center justify-center mb-6 group-hover:bg-accent/10 transition"
                >
                    <i class="fas fa-mobile-alt text-2xl text-accent"></i>
                </div>
                <h3 class="text-accent font-semibold text-lg mb-2">Responsif</h3>
                <p class="text-accent/60 text-sm">Dapat diakses melalui laptop, tablet, maupun smartphone.</p>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="bg-background py-24 px-8 md:px-16 border-t border-[#EFECE6]">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-5/12">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-secondary rounded-2xl transform translate-x-4 translate-y-4 opacity-10"
                    ></div>
                    <img
                        src="{{ asset('images/tailor_working.png') }}"
                        alt="Tentang TailorPro"
                        class="relative rounded-2xl shadow-xl w-full object-cover aspect-[4/3] md:aspect-square"
                    />
                </div>
            </div>
            <div class="w-full md:w-7/12">
                <h2 class="font-serif text-4xl font-bold text-primary mb-2">Tentang Kami</h2>
                <h3 class="text-secondary font-medium text-lg mb-6">
                    TailorPro = Solusi Digital untuk Penjahit & Konveksi Modern
                </h3>

                <div class="space-y-4 text-primary/80 leading-relaxed">
                    <p>TailorPro hadir sebagai aplikasi web pencatatan ukuran baju yang dirancang untuk membantu penjahit, butik, dan konveksi dalam mengelola proses kerja secara lebih mudah, cepat, dan terorganisir.</p>
                    <p>Kami memahami bahwa pencatatan ukuran pelanggan, pengelolaan pesanan, hingga tracking pengerjaan sering kali masih dilakukan secara manual dan berisiko menyebabkan data hilang atau tertukar. Karena itu, TailorPro dibuat untuk memberikan solusi digital yang praktis dan efisien.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Harga Section -->
    <section id="harga" class="bg-background py-24 px-8 md:px-16">
        <div class="max-w-6xl mx-auto text-center mb-16">
            <h2 class="font-serif text-4xl font-bold text-primary mb-4">Daftar Harga</h2>
            <p class="text-primary/70 text-lg max-w-2xl mx-auto">Pilih paket yang sesuai dengan kebutuhan jasa jahit anda</p>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Free Plan -->
            <div
                class="bg-white border border-[#EFECE6] rounded-3xl p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300"
            >
                <div class="flex flex-col items-center mb-8 border-b border-[#EFECE6] pb-8">
                    <div
                        class="w-12 h-12 rounded-full bg-accent flex items-center justify-center mb-4"
                    >
                        <i class="fas fa-leaf text-primary"></i>
                    </div>
                    <h3 class="font-bold text-xl text-primary mb-2">Free</h3>
                    <p class="text-sm text-primary/60">Gratis untuk semua kalangan</p>
                    <div class="mt-6 flex items-baseline">
                        <span class="text-4xl font-bold text-primary">Rp0</span>
                        <span class="text-primary/60 ml-1">/ bulan</span>
                    </div>
                </div>
                <div class="flex-grow">
                    <ul class="space-y-4 text-primary/80 text-sm">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Pencatatan ukuran
                            baju
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Referensi desain baju
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Simpan data aman
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Multi devices
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> 100 data pelanggan
                        </li>
                    </ul>
                </div>
                <div class="mt-10">
                    <button
                        class="w-full py-3 rounded-full border-2 border-secondary text-secondary font-medium hover:bg-secondary hover:text-white transition duration-300"
                    >
                        Pilih Paket
                    </button>
                </div>
            </div>

            <!-- Pro Plan -->
            <div
                class="bg-white border-2 border-secondary/20 rounded-3xl p-10 shadow-[0_8px_30px_rgb(0,0,0,0.08)] flex flex-col relative transform md:-translate-y-4 hover:shadow-[0_20px_40px_rgb(0,0,0,0.12)] transition duration-300"
            >
                <div
                    class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-secondary text-white px-4 py-1 rounded-full text-xs font-bold tracking-wider uppercase"
                >
                    Terpopuler
                </div>
                <div class="flex flex-col items-center mb-8 border-b border-gray-100 pb-8">
                    <div
                        class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center mb-4 text-white"
                    >
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="font-bold text-xl text-primary mb-2">Pro</h3>
                    <p class="text-sm text-primary/60">Cocok untuk penjahit profesional</p>
                    <div class="mt-6 flex items-baseline">
                        <span class="text-4xl font-bold text-primary">Rp89.000</span>
                        <span class="text-primary/60 ml-1">/ bulan</span>
                    </div>
                </div>
                <div class="flex-grow">
                    <ul class="space-y-4 text-primary/80 text-sm">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Pencatatan ukuran
                            baju
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Hasilkan pola
                            otomatis
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Referensi desain baju
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Jadwal pengerjaan
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Data pelanggan
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Tracking pengerjaan
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Simpan data aman
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-secondary"></i> Multi devices
                        </li>
                    </ul>
                </div>
                <div class="mt-10">
                    <button
                        class="w-full py-3 rounded-full bg-secondary text-white font-medium hover:bg-primary transition duration-300 shadow-lg shadow-secondary/30"
                    >
                        Mulai Berlangganan
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary/95 pt-20 pb-10 px-8 md:px-16 border-t border-white/5">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <i class="fas fa-cut text-2xl text-accent"></i>
                    <span class="font-serif text-2xl font-bold text-accent">TailorPro</span>
                </div>
                <p class="text-accent/60 text-sm leading-relaxed max-w-sm">TailorPro hadir untuk membantu penjahit, butik, dan konveksi mengelola data pelanggan, ukuran baju, referensi desain, hingga tracking pengerjaan secara lebih praktis dan profesional.</p>
            </div>

            <div>
                <h4 class="text-accent font-semibold text-lg mb-6">Navigasi</h4>
                <ul class="space-y-3 text-accent/60 text-sm">
                    <li><a href="#fitur" class="hover:text-accent transition">Fitur Utama</a></li>
                    <li>
                        <a href="#tentang" class="hover:text-accent transition">Tentang Kami</a>
                    </li>
                    <li><a href="#harga" class="hover:text-accent transition">Harga</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-accent font-semibold text-lg mb-6">Media Sosial</h4>
                <ul class="space-y-3 text-accent/60 text-sm">
                    <li>
                        <a href="#" class="hover:text-accent transition flex items-center gap-2"
                            ><i class="fab fa-instagram w-4"></i> Instagram</a
                        >
                    </li>
                    <li>
                        <a href="#" class="hover:text-accent transition flex items-center gap-2"
                            ><i class="fab fa-tiktok w-4"></i> Tiktok</a
                        >
                    </li>
                    <li>
                        <a href="#" class="hover:text-accent transition flex items-center gap-2"
                            ><i class="fab fa-facebook-f w-4"></i> Facebook</a
                        >
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="max-w-6xl mx-auto pt-8 border-t border-accent/10 flex flex-col md:flex-row justify-between items-center text-xs text-accent/40"
        >
            <p>&copy; TailorPro 2026. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
