@extends('layouts.app')

@section('content')
<div class=" mx-auto space-y-6 pb-10">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-on-surface mb-2">Laporan Penjualan</h1>
            <p class="text-grey dark:text-on-surface text-sm">Pantau performa bisnis dan pertumbuhan pendapatan Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-surface border border-gray-200 dark:border-surface rounded-xl text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-surface transition-colors shadow-sm">
                <i class="fa-regular fa-calendar text-gray-400"></i>
                30 Hari Terakhir
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs ml-1"></i>
            </button>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-surface border border-gray-200 dark:border-surface rounded-xl text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-surface transition-colors shadow-sm">
                <i class="fa-solid fa-download text-gray-400"></i>
                Cetak PDF
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Card 1 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-surface transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pendapatan</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-on-surface">Rp 48.250.000</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-arrow-trend-up"></i> +18.4%
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-surface rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-surface rounded-full opacity-50"></div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-surface transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pesanan</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-on-surface">156</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-arrow-trend-up"></i> +5.2%
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-surface rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-surface rounded-full opacity-50"></div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-surface transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Pelanggan Baru</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-on-surface">42</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-user-plus"></i> +12
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-surface rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-surface rounded-full opacity-50"></div>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface mt-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="font-serif text-lg font-bold text-slate-800 dark:text-on-surface">Tren Pendapatan Bulanan</h2>
                <p class="text-xs text-gray-400 dark:text-on-surface mt-1">Statistik performa selama 6 bulan terakhir</p>
            </div>
            <div class="flex items-center gap-4 text-xs font-medium text-gray-500 dark:text-on-surface">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-primary dark:bg-surface"></div>
                    Pendapatan
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-slate-600"></div>
                    Target
                </div>
            </div>
        </div>
        
        <div class="relative h-[300px] w-full">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface mt-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-serif text-lg font-bold text-slate-800 dark:text-on-surface">Transaksi Terakhir</h2>
            <a href="#" class="text-sm font-bold text-primary dark:text-accent hover:text-secondary dark:hover:text-white transition-colors">Lihat Semua Transaksi</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-surface">
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">ID Transaksi</th>
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">Pelanggan</th>
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">Layanan</th>
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">Tanggal</th>
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">Jumlah</th>
                        <th class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <!-- Row 1 -->
                    <tr class="border-b border-gray-50 dark:border-surface hover:bg-gray-50/80 dark:hover:bg-surface/50 transition-colors">
                        <td class="py-4 px-2 font-bold text-gray-600 dark:text-on-surface">#TX-9021</td>
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Andi+Saputra&background=E5E7EB&color=374151" class="w-8 h-8 rounded-full object-cover">
                                <span class="font-bold text-slate-800 dark:text-on-surface">Andi Saputra</span>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-gray-500 dark:text-on-surface">Jas Formal Custom</td>
                        <td class="py-4 px-2 text-gray-400 dark:text-slate-500 font-medium">24 Jun 2024</td>
                        <td class="py-4 px-2 font-bold text-slate-800 dark:text-on-surface">Rp 3.500.000</td>
                        <td class="py-4 px-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/50 tracking-wider">SELESAI</span>
                        </td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr class="border-b border-gray-50 dark:border-surface hover:bg-gray-50/80 dark:hover:bg-surface/50 transition-colors">
                        <td class="py-4 px-2 font-bold text-gray-600 dark:text-on-surface">#TX-9020</td>
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Wijaya&background=E5E7EB&color=374151" class="w-8 h-8 rounded-full object-cover">
                                <span class="font-bold text-slate-800 dark:text-on-surface">Sarah Wijaya</span>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-gray-500 dark:text-on-surface">Kebaya Modifikasi</td>
                        <td class="py-4 px-2 text-gray-400 dark:text-slate-500 font-medium">23 Jun 2024</td>
                        <td class="py-4 px-2 font-bold text-slate-800 dark:text-on-surface">Rp 2.150.000</td>
                        <td class="py-4 px-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50 tracking-wider">DIPROSES</span>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="border-b border-gray-50 dark:border-surface hover:bg-gray-50/80 dark:hover:bg-surface/50 transition-colors">
                        <td class="py-4 px-2 font-bold text-gray-600 dark:text-on-surface">#TX-9019</td>
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Kevin+Pratama&background=E5E7EB&color=374151" class="w-8 h-8 rounded-full object-cover">
                                <span class="font-bold text-slate-800 dark:text-on-surface">Kevin Pratama</span>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-gray-500 dark:text-on-surface">Alterasi Celana (4x)</td>
                        <td class="py-4 px-2 text-gray-400 dark:text-slate-500 font-medium">22 Jun 2024</td>
                        <td class="py-4 px-2 font-bold text-slate-800 dark:text-on-surface">Rp 600.000</td>
                        <td class="py-4 px-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-orange-50 dark:bg-orange-950/30 text-orange-600 dark:text-orange-400 border border-orange-100 dark:border-orange-900/50 tracking-wider">SIAP AMBIL</span>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-surface/50 transition-colors">
                        <td class="py-4 px-2 font-bold text-gray-600 dark:text-on-surface">#TX-9018</td>
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-slate-700 border border-gray-200 dark:border-slate-600 flex items-center justify-center text-xs font-bold text-gray-500 dark:text-on-surface">RM</div>
                                <span class="font-bold text-slate-800 dark:text-on-surface">Ria Monica</span>
                            </div>
                        </td>
                        <td class="py-4 px-2 text-gray-500 dark:text-on-surface">Dress Pesta Satin</td>
                        <td class="py-4 px-2 text-gray-400 dark:text-slate-500 font-medium">21 Jun 2024</td>
                        <td class="py-4 px-2 font-bold text-slate-800 dark:text-on-surface">Rp 1.850.000</td>
                        <td class="py-4 px-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/50 tracking-wider">SELESAI</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        const primaryColor = isDarkMode ? '#e2ddca' : '#4A3A2A';
        const targetColor = isDarkMode ? '#475569' : '#D1D5DB';
        const gridColor = isDarkMode ? '#1e293b' : '#F3F4F6';
        const tickColor = isDarkMode ? '#94a3b8' : '#9CA3AF';

        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Pendapatan',
                    data: [32, 28, 45, 38, 52, 48],
                    borderColor: primaryColor,
                    backgroundColor: primaryColor,
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: primaryColor,
                    pointBorderColor: isDarkMode ? '#0f172a' : '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Target',
                    data: [30, 30, 35, 35, 40, 40],
                    borderColor: targetColor,
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [4, 4],
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 0
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: isDarkMode ? '#ffffff' : '#1F2937',
                        titleColor: isDarkMode ? '#0f172a' : '#ffffff',
                        bodyColor: isDarkMode ? '#0f172a' : '#ffffff',
                        padding: 12,
                        titleFont: { size: 13, family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + context.parsed.y + ' Juta';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 50,
                        ticks: {
                            stepSize: 10,
                            color: tickColor,
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            callback: function(value, index, values) {
                                if (value === 0) return 'Rp 0';
                                return 'Rp ' + value + 'M';
                            }
                        },
                        border: {
                            display: false,
                        },
                        grid: {
                            color: gridColor,
                            drawBorder: false,
                        }
                    },
                    x: {
                        ticks: {
                            color: tickColor,
                            font: {
                                size: 12,
                                family: 'Inter'
                            }
                        },
                        border: {
                            display: false
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
            }
        };

        const myChart = new Chart(ctx, config);

        // Update chart colors on theme toggle
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    const isDark = document.documentElement.classList.contains('dark');
                    const newPrimary = isDark ? '#e2ddca' : '#4A3A2A';
                    const newTarget = isDark ? '#475569' : '#D1D5DB';
                    const newGrid = isDark ? '#1e293b' : '#F3F4F6';
                    const newTick = isDark ? '#94a3b8' : '#9CA3AF';
                    const newPointBorder = isDark ? '#0f172a' : '#ffffff';

                    myChart.data.datasets[0].borderColor = newPrimary;
                    myChart.data.datasets[0].backgroundColor = newPrimary;
                    myChart.data.datasets[0].pointBackgroundColor = newPrimary;
                    myChart.data.datasets[0].pointBorderColor = newPointBorder;
                    myChart.data.datasets[1].borderColor = newTarget;

                    myChart.options.scales.y.grid.color = newGrid;
                    myChart.options.scales.y.ticks.color = newTick;
                    myChart.options.scales.x.ticks.color = newTick;
                    
                    myChart.options.plugins.tooltip.backgroundColor = isDark ? '#ffffff' : '#1F2937';
                    myChart.options.plugins.tooltip.titleColor = isDark ? '#0f172a' : '#ffffff';
                    myChart.options.plugins.tooltip.bodyColor = isDark ? '#0f172a' : '#ffffff';

                    myChart.update();
                }
            });
        });
        observer.observe(document.documentElement, { attributes: true });
    });
</script>
@endsection
