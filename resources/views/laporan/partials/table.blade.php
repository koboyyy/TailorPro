<!-- Table Section -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 mt-6"
        >
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-serif text-lg font-bold text-slate-800 dark:text-white">
                    Transaksi Terakhir
                </h2>
                <a
                    href="#"
                    class="text-sm font-bold text-primary dark:text-accent hover:text-secondary dark:hover:text-white transition-colors"
                    >Lihat Semua Transaksi</a
                >
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-slate-800">
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                ID Transaksi
                            </th>
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                Pelanggan
                            </th>
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                Layanan
                            </th>
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                Tanggal
                            </th>
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                Jumlah
                            </th>
                            <th
                                class="py-4 px-2 text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider uppercase"
                            >
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($transaksiTerakhir as $t)
                            <tr
                                class="border-b border-gray-50 dark:border-slate-800/50 hover:bg-gray-50/80 dark:hover:bg-slate-800/50 transition-colors"
                            >
                                <td class="py-4 px-2 font-bold text-gray-600 dark:text-slate-300">
                                    #TX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4 px-2">
                                    <div class="flex items-center gap-3">
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode($t->pelanggan->name ?? 'Unknown') }}&background=E5E7EB&color=374151"
                                            class="w-8 h-8 rounded-full object-cover"
                                        />
                                        <span
                                            class="font-bold text-slate-800 dark:text-white"
                                            >{{ $t->pelanggan->name ?? 'Unknown' }}</span
                                        >
                                    </div>
                                </td>
                                <td class="py-4 px-2 text-gray-500 dark:text-slate-400">
                                    {{ $t->type }}
                                </td>
                                <td class="py-4 px-2 text-gray-400 dark:text-slate-500 font-medium">
                                    {{ \Carbon\Carbon::parse($t->created_at)->format('d M Y') }}
                                </td>
                                <td class="py-4 px-2 font-bold text-slate-800 dark:text-white">
                                    Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $t->price), 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-2">
                                    @php
                                    $statusColor = 'bg-gray-50 text-gray-600 border-gray-100 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-700';
                                    if(in_array(strtoupper($t->status), ['SELESAI', 'DIAMBIL'])) {
                                        $statusColor = 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-950/30 dark:text-emerald-400 dark:border-emerald-900/50';
                                    } elseif(strtoupper($t->status) == 'DIPROSES') {
                                        $statusColor = 'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/50';
                                    } elseif(strtoupper($t->status) == 'MENUNGGU') {
                                        $statusColor = 'bg-orange-50 text-orange-600 border-orange-100 dark:bg-orange-950/30 dark:text-orange-400 dark:border-orange-900/50';
                                    }
                                @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold tracking-wider {{ $statusColor }}"
                                        >{{ strtoupper($t->status) }}</span
                                    >
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-500">
                                    Belum ada transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>