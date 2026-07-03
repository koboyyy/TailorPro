<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\RiwayatStatus;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // 1. Pesanan Aktif (selain SELESAI dan DIBATALKAN)
        $pesananAktif = Pesanan::whereNotIn('status', ['SELESAI', 'DIBATALKAN'])->count();

        // 2. Pesanan dalam Finishing (PENYELESAIAN)
        $pesananFinishing = Pesanan::where('status', 'PENYELESAIAN')->count();

        // 3. Pesanan Baru Hari Ini
        $pesananBaruHariIni = Pesanan::whereDate('created_at', $now->toDateString())->count();

        // 4. Estimasi Pendapatan Bulan Ini
        // Mengambil seluruh pesanan bulan ini, lalu bersihkan format 'price' (buang titik) dan jumlahkan
        $pesananBulanIni = Pesanan::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->get();
        
        $estimasiPendapatan = 0;
        foreach ($pesananBulanIni as $pesanan) {
            // Contoh price: '250.000', diubah jadi integer 250000
            $cleanedPrice = str_replace('.', '', $pesanan->price);
            $estimasiPendapatan += (int) $cleanedPrice;
        }
        
        // Format angka ke juta
        if ($estimasiPendapatan >= 1000000) {
            $estimasiPendapatanFormatted = 'Rp ' . rtrim(rtrim(number_format($estimasiPendapatan / 1000000, 1, ',', '.'), '0'), ',') . 'jt';
        } else {
            $estimasiPendapatanFormatted = 'Rp ' . number_format($estimasiPendapatan, 0, ',', '.');
        }

        // 5. Pelanggan Baru Bulan Ini
        $pelangganBaruBulanIni = Pelanggan::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // 6. Tren Produksi (7 Hari Terakhir)
        $labelsMingguan = [];
        $dataTren = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labelsMingguan[] = $date->translatedFormat('l'); // Senin, Selasa, dst.
            
            $count = Pesanan::whereDate('created_at', $date->toDateString())->count();
            $dataTren[] = $count;
        }

        // 7. Aktifitas Hari Ini (Mengambil Riwayat Status Terbaru)
        $aktifitasHariIni = RiwayatStatus::with(['pesanan.pelanggan'])
            ->orderBy('time', 'desc')
            ->take(3)
            ->get();

        // 8. Sebaran Status Pesanan
        $sebaranStatus = [
            'Menunggu' => Pesanan::where('status', 'MENUNGGU')->count(),
            'Pemotongan' => Pesanan::where('status', 'PEMOTONGAN')->count(),
            'Penjahitan' => Pesanan::where('status', 'PENJAHITAN')->count(),
            'Penyelesaian' => Pesanan::where('status', 'PENYELESAIAN')->count(),
            'Selesai' => Pesanan::where('status', 'SELESAI')->count(),
        ];

        // 9. Tren Pendapatan Bulanan (6 Bulan)
        $labelsBulan = [];
        $dataPendapatan = [];
        $dataTarget = [30000000, 30000000, 35000000, 35000000, 40000000, 40000000];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $labelsBulan[] = $monthDate->translatedFormat('M');
            
            $pesananBulan = Pesanan::whereMonth('created_at', $monthDate->month)
                                   ->whereYear('created_at', $monthDate->year)
                                   ->get();
            $pendapatan = 0;
            foreach ($pesananBulan as $pesanan) {
                $cleanedPrice = str_replace('.', '', $pesanan->price);
                $pendapatan += (int) $cleanedPrice;
            }
            
            // If data is 0, we can use some fallback to match the screenshot layout visually if needed, but real data is better.
            $dataPendapatan[] = $pendapatan;
        }

        return view('dashboard', compact(
            'pesananAktif',
            'pesananFinishing',
            'pesananBaruHariIni',
            'estimasiPendapatanFormatted',
            'pelangganBaruBulanIni',
            'labelsMingguan',
            'dataTren',
            'aktifitasHariIni',
            'sebaranStatus',
            'labelsBulan',
            'dataPendapatan',
            'dataTarget'
        ));
    }
}
