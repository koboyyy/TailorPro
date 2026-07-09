<!-- Chart Section -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 mt-6"
        >
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="font-serif text-lg font-bold text-slate-800 dark:text-white">
                        @if ($filter == '7')
                            Tren Pendapatan Harian
                        @elseif ($filter == '365')
                            Tren Pendapatan Bulanan
                        @else
                            Tren Pendapatan Harian
                        @endif
                    </h2>
                    <p class="text-xs text-gray-400 dark:text-slate-400 mt-1">
                        @if ($filter == '7')
                            Statistik performa selama 7 hari terakhir
                        @elseif ($filter == '365')
                            Statistik performa selama 1 tahun terakhir
                        @else
                            Statistik performa selama 30 hari terakhir
                        @endif
                    </p>
                </div>
                <div
                    class="flex items-center gap-4 text-xs font-medium text-gray-500 dark:text-slate-400"
                >
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-primary dark:bg-accent"></div>
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