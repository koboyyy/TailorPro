@extends ('layouts.app')

@section('breadcrumb-parent', 'dashboard')
@section('breadcrumb-active', 'beranda')

@section ('content')
    <div class="mx-auto space-y-6">
        <!-- Greeting Section -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-2">
                Selamat Datang, Admin
            </h1>
            <p class="text-grey text-sm">Anda memiliki {{ $pesananAktif }} pesanan aktif dan {{ $pesananFinishing }} pesanan yang sedang di finishing.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between">
                    <p class="text-[11px] font-bold text-grey tracking-wider">TOTAL PESANAN AKTIF</p>
                    <i class="fa-solid fa-ruler-combined text-grey/60 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pesananAktif }}
                    </h3>
                    <p class="text-[11px] text-grey/80 dark:text-slate-400 font-medium">sedang berjalan</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between">
                    <p class="text-[11px] font-bold text-grey tracking-wider">PESANAN BARU HARI INI</p>
                    <i class="fa-solid fa-plus text-grey/60 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pesananBaruHariIni }}
                    </h3>
                    <p class="text-[11px] text-grey/80 dark:text-slate-400 font-medium">dibuat hari ini</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between">
                    <p class="text-[11px] font-bold text-grey tracking-wider">ESTIMASI PENDAPATAN</p>
                    <i class="fa-solid fa-money-bill-wave text-grey/60 text-sm"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $estimasiPendapatanFormatted }}
                    </h3>
                    <p class="text-[11px] text-grey/80 dark:text-slate-400 font-medium">bulan ini</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between">
                    <p class="text-[11px] font-bold text-grey tracking-wider">PELANGGAN BARU</p>
                    <i class="fa-regular fa-circle-user text-grey/60 text-base"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pelangganBaruBulanIni }}
                    </h3>
                    <p class="text-[11px] text-grey/80 dark:text-slate-400 font-medium">bulan ini</p>
                </div>
            </div>
        </div>

        <!-- Main Section: Chart & Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- Chart Section -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800"
            >
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-serif text-lg font-bold text-primary dark:text-white">
                        Tren Produksi
                    </h2>
                    <button
                        class="px-4 py-1.5 text-xs text-grey border border-gray-200 dark:border-slate-800 rounded-full hover:bg-background transition-colors"
                    >
                        7 Hari Terakhir
                    </button>
                </div>

                <div class="relative h-64 w-full">
                    <canvas id="productionChart"></canvas>
                </div>
            </div>

            <!-- Activity Section -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col h-full"
            >
                <h2 class="font-serif text-lg font-bold text-primary dark:text-white mb-6">
                    Aktifitas hari Ini
                </h2>

                <div class="space-y-6 flex-1">
                    @forelse($aktifitasHariIni as $aktifitas)
                        @php
                            // Tentukan warna berdasarkan status
                            $color = 'bg-gray-400';
                            if ($aktifitas->status == 'PENJAHITAN') $color = 'bg-[#E5D4B2]';
                            elseif ($aktifitas->status == 'PEMOTONGAN') $color = 'bg-secondary';
                            elseif ($aktifitas->status == 'MENUNGGU') $color = 'bg-[#8E443A]';
                            elseif ($aktifitas->status == 'PENYELESAIAN') $color = 'bg-green-500';
                        @endphp
                        <!-- Activity Item -->
                        <div class="flex gap-4 relative">
                            <div class="mt-1.5">
                                <div class="w-2 h-2 rounded-full {{ $color }}"></div>
                            </div>
                            <div>
                                <p class="text-sm text-secondary dark:text-slate-300 font-medium">
                                    <span class="font-bold">{{ $aktifitas->pesanan->pelanggan->name ?? 'Pelanggan' }}</span> - {{ ucwords(strtolower(str_replace('_', ' ', $aktifitas->status))) }}
                                </p>
                                <p class="text-xs text-grey mt-1">{{ $aktifitas->pesanan->type ?? 'Pakaian' }} • {{ $aktifitas->time ? $aktifitas->time->diffForHumans() : '' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-grey text-center py-4">Belum ada aktifitas hari ini.</div>
                    @endforelse
                </div>

                <a
                    href="/pesanan"
                    class="block text-center w-full mt-6 py-3 border border-gray-200 dark:border-slate-800 rounded-xl text-sm font-medium text-grey hover:bg-background transition-colors"
                >
                    Lihat Semua
                </a>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('productionChart').getContext('2d');

            let chartInstance = null;

            function getChartConfig(darkMode) {
                // Gradient for the chart area
                let gradient = ctx.createLinearGradient(0, 0, 0, 300);
                if (darkMode) {
                    gradient.addColorStop(0, 'rgba(255, 255, 255, 0.1)'); // Lighter color for dark mode
                    gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
                } else {
                    gradient.addColorStop(0, 'rgba(74, 58, 42, 0.2)');
                    gradient.addColorStop(1, 'rgba(74, 58, 42, 0)');
                }

                const data = {
                    labels: {!! json_encode($labelsMingguan) !!},
                    datasets: [
                        {
                            label: 'Pesanan Baru',
                            data: {!! json_encode($dataTren) !!},
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: darkMode ? '#ffffff' : '#4A3A2A',
                            borderWidth: 3,
                            tension: 0.4, // smooth curves
                            pointBackgroundColor: darkMode ? '#0f172a' : '#ffffff',
                            pointBorderColor: darkMode ? '#ffffff' : '#4A3A2A',
                            pointBorderWidth: 2,
                            pointRadius: function (context) {
                                return context.dataIndex === context.dataset.data.length - 1 ? 6 : 0;
                            },
                            pointHoverRadius: 6,
                        },
                    ],
                };

                return {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                enabled: true,
                                backgroundColor: darkMode ? '#1e293b' : '#4A3A2A',
                                titleColor: darkMode ? '#f8fafc' : '#ffffff',
                                bodyColor: darkMode ? '#e2e8f0' : '#ffffff',
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                ticks: {
                                    stepSize: Math.ceil(Math.max(...data.datasets[0].data) / 4) || 4,
                                    color: darkMode ? '#94a3b8' : '#555555',
                                    font: {
                                        size: 12,
                                    },
                                },
                                border: {
                                    display: false,
                                },
                                grid: {
                                    color: darkMode ? '#1e293b' : '#F3F4F6',
                                    drawBorder: false,
                                },
                            },
                            x: {
                                ticks: {
                                    color: darkMode ? '#94a3b8' : '#555555',
                                    font: {
                                        size: 12,
                                    },
                                },
                                border: {
                                    display: false,
                                },
                                grid: {
                                    display: false,
                                },
                            },
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                    },
                    plugins: [
                        {
                            id: 'verticalLine',
                            beforeDraw: (chart) => {
                                const ctx = chart.canvas.getContext('2d');
                                const xAxis = chart.scales.x;
                                const yAxis = chart.scales.y;

                                const activeIndex = chart.data.datasets[0].data.length - 1;
                                const x = xAxis.getPixelForValue(activeIndex);
                                const yTop = yAxis.getPixelForValue(
                                    chart.data.datasets[0].data[activeIndex]
                                );
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
                            },
                        },
                    ],
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

            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class') {
                        initOrUpdateChart();
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });
        });
    </script>
@endsection
