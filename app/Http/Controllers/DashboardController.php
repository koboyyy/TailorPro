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
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'pesananAktif',
            'pesananFinishing',
            'pesananBaruHariIni',
            'estimasiPendapatanFormatted',
            'pelangganBaruBulanIni',
            'labelsMingguan',
            'dataTren',
            'aktifitasHariIni'
        ));
    }
}
