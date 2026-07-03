@extends ('layouts.app')

@section('breadcrumb-parent', 'halaman')
@section('breadcrumb-active', 'beranda')

@section ('content')
    <div class="mx-auto space-y-6">
        <!-- Greeting Section -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-2">
                Selamat Datang, Admin
            </h1>
            <p class="text-grey text-sm">Anda memiliki {{ $pesananAktif }} pesanan aktif.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-medium text-grey tracking-wide">Total Pesanan Aktif</p>
                    <i class="fa-solid fa-window-maximize text-grey/60 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pesananAktif }}
                    </h3>
                    <p class="text-[10px] text-grey/80 dark:text-slate-400 font-medium">+3 dari minggu lalu</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-medium text-grey tracking-wide">Pesanan Baru Hari Ini</p>
                    <i class="fa-solid fa-plus text-grey/60 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pesananBaruHariIni }}
                    </h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-medium text-grey tracking-wide">Estimasi Pendapatan</p>
                    <i class="fa-solid fa-money-bill-wave text-grey/60 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $estimasiPendapatanFormatted }}
                    </h3>
                    <p class="text-[10px] text-grey/80 dark:text-slate-400 font-medium">bulan ini</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-40"
            >
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-medium text-grey tracking-wide">Pelanggan Baru</p>
                    <i class="fa-regular fa-circle-user text-grey/60 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-serif text-4xl font-bold text-secondary dark:text-white mb-1">
                        {{ $pelangganBaruBulanIni }}
                    </h3>
                    <p class="text-[10px] text-grey/80 dark:text-slate-400 font-medium">bulan ini</p>
                </div>
            </div>
        </div>

        <!-- Main Section: Chart & Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <!-- Left Panel: Status Alur Kerja -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                <div class="mb-6">
                    <h2 class="font-serif text-lg font-bold text-primary dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-route"></i> Status Alur Kerja
                    </h2>
                    <p class="text-xs text-grey mt-1">Sebaran pesanan berdasarkan tahapan produksi saat ini.</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-center justify-between gap-8 h-64">
                    <div class="relative h-56 w-56 mx-auto">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <!-- Custom Legend -->
                    <div class="flex flex-col gap-2 mx-auto md:mx-0 w-40">
                        <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full" style="background-color: #D4A373"></span> Menunggu</div>
                        <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full" style="background-color: #E29578"></span> Pemotongan</div>
                        <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full" style="background-color: #8F7E75"></span> Penjahitan</div>
                        <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full" style="background-color: #5B7B7A"></span> Penyelesaian</div>
                        <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full" style="background-color: #6A8A5C"></span> Selesai</div>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Aktifitas Hari Ini -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col">
                <div class="mb-6">
                    <h2 class="font-serif text-lg font-bold text-primary dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left"></i> Aktifitas Hari Ini
                    </h2>
                    <p class="text-xs text-grey mt-1">Riwayat aktifitas hari ini.</p>
                </div>

                <div class="space-y-6 flex-1 overflow-y-auto max-h-64 pr-2">
                    @forelse($aktifitasHariIni as $aktifitas)
                        <div class="flex gap-4 relative">
                            <div class="mt-1.5 flex flex-col items-center">
                                @php
                                    $statusColor = match(strtolower($aktifitas->status)) {
                                        'menunggu' => '#D4A373',
                                        'pemotongan' => '#E29578',
                                        'penjahitan' => '#8F7E75',
                                        'penyelesaian' => '#5B7B7A',
                                        'selesai' => '#6A8A5C',
                                        default => '#D1D5DB'
                                    };
                                @endphp
                                <div class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $statusColor }}"></div>
                                @if(!$loop->last)
                                    <div class="w-px h-10 bg-gray-200 mt-1"></div>
                                @endif
                            </div>
                            <div class="pb-2">
                                <p class="text-sm text-secondary dark:text-slate-300 font-medium">
                                    <span class="font-bold">{{ $aktifitas->pesanan->pelanggan->name ?? 'Pelanggan' }}</span> <span class="text-gray-300 mx-1">—</span> <span class="text-xs">{{ ucwords(strtolower(str_replace('_', ' ', $aktifitas->status))) }}</span>
                                </p>
                                <p class="text-[11px] text-grey mt-0.5">{{ $aktifitas->pesanan->type ?? 'Pakaian' }} <span class="text-gray-300 mx-1">•</span> {{ $aktifitas->time ? $aktifitas->time->diffForHumans() : '' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-grey text-center py-4">Belum ada aktifitas hari ini.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Bottom Section: Tren Pendapatan -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 mt-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="font-serif text-lg font-bold text-primary dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-chart-line"></i> Tren Pendapatan Bulanan
                    </h2>
                    <p class="text-xs text-grey mt-1">Statistik performa selama 6 bulan terakhir</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full bg-[#4A3A2A]"></span> Pendapatan</div>
                    <div class="flex items-center gap-2 text-xs text-grey"><span class="w-3 h-3 rounded-full bg-[#D1D5DB]"></span> Target</div>
                </div>
            </div>

            <div class="relative h-72 w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // -- DONUT CHART --
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const sebaranStatus = {!! json_encode($sebaranStatus) !!};
            
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Pemotongan', 'Penjahitan', 'Penyelesaian', 'Selesai'],
                    datasets: [{
                        data: [
                            sebaranStatus.Menunggu, 
                            sebaranStatus.Pemotongan, 
                            sebaranStatus.Penjahitan, 
                            sebaranStatus.Penyelesaian, 
                            sebaranStatus.Selesai
                        ],
                        backgroundColor: ['#D4A373', '#E29578', '#8F7E75', '#5B7B7A', '#6A8A5C'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });

            // -- LINE CHART --
            const revCtx = document.getElementById('revenueChart').getContext('2d');
            const revLabels = {!! json_encode($labelsBulan) !!};
            const revData = {!! json_encode($dataPendapatan) !!};
            const targetData = {!! json_encode($dataTarget) !!};

            new Chart(revCtx, {
                type: 'line',
                data: {
                    labels: revLabels,
                    datasets: [
                        {
                            label: 'Pendapatan',
                            data: revData,
                            borderColor: '#4A3A2A',
                            backgroundColor: '#4A3A2A',
                            borderWidth: 2,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#4A3A2A',
                        },
                        {
                            label: 'Target',
                            data: targetData,
                            borderColor: '#D1D5DB',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            tension: 0.4,
                            pointRadius: 0,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { 
                            enabled: true,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000) + 'M';
                                },
                                stepSize: 10000000,
                                font: { size: 10 },
                                color: '#9CA3AF'
                            },
                            grid: {
                                color: '#F3F4F6',
                                drawBorder: false,
                            },
                            border: { display: false }
                        },
                        x: {
                            ticks: {
                                font: { size: 10 },
                                color: '#9CA3AF'
                            },
                            grid: {
                                display: false
                            },
                            border: { display: true, color: '#E5E7EB' }
                        }
                    }
                }
            });
        });
    </script>
@endsection
