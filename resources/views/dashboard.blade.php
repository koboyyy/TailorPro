@extends('layouts.app')

@section('content')
<div class="mx-auto space-y-6">
    
    <!-- Greeting Section -->
    <div class="mb-8">
        <h1 class="font-serif text-3xl font-bold text-primary dark:text-secondary mb-2">Selamat Datang, Admin</h1>
        <p class="text-grey text-sm dark:text-on-surface">Anda memiliki 12 pesanan aktif dan 3 jadwal fitting untuk hari ini.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card 1 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-40">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold text-grey tracking-wider">TOTAL PESANAN AKTIF</p>
                <i class="fa-solid fa-ruler-combined text-grey/60 text-sm"></i>
            </div>
            <div>
                <h3 class="font-serif text-4xl font-bold text-secondary dark:text-secondary mb-1">56</h3>
                <p class="text-[11px] text-grey/80 dark:text-on-surface font-medium">+3 dari minggu lalu</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-40">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold text-grey tracking-wider">PESANAN BARU HARI INI</p>
                <i class="fa-solid fa-plus text-grey/60 text-sm"></i>
            </div>
            <div>
                <h3 class="font-serif text-4xl font-bold text-secondary dark:text-secondary mb-1">4</h3>
                <p class="text-[11px] text-grey/80 dark:text-on-surface font-medium">membutuhkan review</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-40">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold text-grey tracking-wider">ESTIMASI PENDAPATAN</p>
                <i class="fa-solid fa-money-bill-wave text-grey/60 text-sm"></i>
            </div>
            <div>
                <h3 class="font-serif text-4xl font-bold text-secondary dark:text-secondary mb-1">Rp 50jt</h3>
                <p class="text-[11px] text-grey/80 dark:text-on-surface font-medium">bulan ini</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col justify-between h-40">
            <div class="flex items-center justify-between">
                <p class="text-[11px] font-bold text-grey tracking-wider">PELANGGAN BARU</p>
                <i class="fa-regular fa-circle-user text-grey/60 text-base"></i>
            </div>
            <div>
                <h3 class="font-serif text-4xl font-bold text-secondary dark:text-secondary mb-1">15</h3>
                <p class="text-[11px] text-grey/80 dark:text-on-surface font-medium">bulan ini</p>
            </div>
        </div>
        
    </div>

    <!-- Main Section: Chart & Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        
        <!-- Chart Section -->
        <div class="lg:col-span-2 bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-serif text-lg font-bold text-primary dark:text-secondary">Tren Produksi</h2>
                <button class="px-4 py-1.5 text-xs text-grey border border-gray-200 dark:border-surface rounded-full hover:bg-background transition-colors">
                    7 Hari Terakhir
                </button>
            </div>
            
            <div class="relative h-64 w-full">
                <canvas id="productionChart"></canvas>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="bg-white dark:bg-surface rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-surface flex flex-col h-full">
            <h2 class="font-serif text-lg font-bold text-primary dark:text-secondary mb-6">Aktifitas hari Ini</h2>
            
            <div class="space-y-6 flex-1">
                
                <!-- Activity Item -->
                <div class="flex gap-4 relative">
                    <div class="mt-1.5">
                        <div class="w-2 h-2 rounded-full bg-[#E5D4B2]"></div>
                    </div>
                    <div>
                        <p class="text-sm text-secondary dark:text-on-surface font-medium"><span class="font-bold">Siti Aminah</span> - Dalam Penjahitan</p>
                        <p class="text-xs text-grey mt-1">Kebaya Moderen • 10 menit lalu</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex gap-4 relative">
                    <div class="mt-1.5">
                        <div class="w-2 h-2 rounded-full bg-secondary"></div>
                    </div>
                    <div>
                        <p class="text-sm text-secondary dark:text-on-surface font-medium"><span class="font-bold">Budi Santoso</span> - Selesai Pemotongan</p>
                        <p class="text-xs text-grey mt-1">Batik • 56 menit lalu</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex gap-4 relative">
                    <div class="mt-1.5">
                        <div class="w-2 h-2 rounded-full bg-[#8E443A]"></div>
                    </div>
                    <div>
                        <p class="text-sm text-secondary dark:text-on-surface font-medium"><span class="font-bold">Nur Faziha</span> - Bahan Tiba</p>
                        <p class="text-xs text-grey mt-1">Gamis • 3 jam yang lalu</p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex gap-4 relative">
                    <div class="mt-1.5">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    </div>
                    <div>
                        <p class="text-sm text-secondary dark:text-on-surface font-medium"><span class="font-bold">Diana Putri</span> - Pesanan Selesai</p>
                        <p class="text-xs text-grey mt-1">Kurung Melayu • 10 menit lalu</p>
                    </div>
                </div>

            </div>
            
            <button class="w-full mt-6 py-3 border border-gray-200 dark:border-surface rounded-xl text-sm font-medium text-grey hover:bg-background transition-colors">
                Lihat Semua
            </button>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('productionChart').getContext('2d');
        
        let chartInstance = null;
        
        function getChartConfig(darkMode) {
            // Gradient for the chart area
            let gradient = ctx.createLinearGradient(0, 0, 0, 300);
            if (darkMode) {
                gradient.addColorStop(0, 'rgba(228, 217, 205, 0.15)'); // secondary color for dark mode
                gradient.addColorStop(1, 'rgba(228, 217, 205, 0)');
            } else {
                gradient.addColorStop(0, 'rgba(74, 58, 42, 0.2)'); 
                gradient.addColorStop(1, 'rgba(74, 58, 42, 0)');
            }

            const data = {
                labels: ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'],
                datasets: [{
                    label: 'Tren Produksi',
                    data: [8, 12, 9, 11, 16, 10, 12],
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: darkMode ? '#e4d9cd' : '#4A3A2A',
                    borderWidth: 3,
                    tension: 0.4, // smooth curves
                    pointBackgroundColor: darkMode ? '#131313' : '#ffffff',
                    pointBorderColor: darkMode ? '#e4d9cd' : '#4A3A2A',
                    pointBorderWidth: 2,
                    pointRadius: function(context) {
                        return context.dataIndex === 4 ? 6 : 0; 
                    },
                    pointHoverRadius: 6
                }]
            };

            return {
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
                            backgroundColor: darkMode ? '#131313' : '#4A3A2A',
                            titleColor: darkMode ? '#f8fafc' : '#ffffff',
                            bodyColor: darkMode ? '#e2e8f0' : '#ffffff',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 16,
                            ticks: {
                                stepSize: 4,
                                color: darkMode ? '#cccccc' : '#555555',
                                font: {
                                    size: 12
                                }
                            },
                            border: {
                                display: false
                            },
                            grid: {
                                color: darkMode ? '#131313' : '#F3F4F6',
                                drawBorder: false,
                            }
                        },
                        x: {
                            ticks: {
                                color: darkMode ? '#cccccc' : '#555555',
                                font: {
                                    size: 12
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
                },
                plugins: [{
                    id: 'verticalLine',
                    beforeDraw: (chart) => {
                        const ctx = chart.canvas.getContext('2d');
                        const xAxis = chart.scales.x;
                        const yAxis = chart.scales.y;
                        
                        const activeIndex = 4;
                        const x = xAxis.getPixelForValue(activeIndex);
                        const yTop = yAxis.getPixelForValue(chart.data.datasets[0].data[activeIndex]);
                        const yBottom = yAxis.bottom;

                        ctx.save();
                        ctx.beginPath();
                        ctx.moveTo(x, yTop);
                        ctx.lineTo(x, yBottom);
                        ctx.lineWidth = 1;
                        ctx.strokeStyle = darkMode ? '#475569' : '#555555';
                        ctx.setLineDash([5, 5]);
                        ctx.stroke();
                        ctx.restore();
                    }
                }]
            };
        }

        function initOrUpdateChart() {
            const finalDarkMode = document.documentElement.classList.contains('dark');

            if (chartInstance) {
                chartInstance.destroy();
            }
            chartInstance = new Chart(ctx, getChartConfig(finalDarkMode));
        }

        initOrUpdateChart();
        
        const observer = new MutationObserver(mutations => {
            mutations.forEach(mutation => {
                if (mutation.attributeName === 'class') {
                    initOrUpdateChart();
                }
            });
        });
        observer.observe(document.documentElement, { attributes: true });
    });
</script>
@endsection
