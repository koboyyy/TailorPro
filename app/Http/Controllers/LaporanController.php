<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', '30');
        $startDate = Carbon::now()->subDays((int)$filter)->startOfDay();

        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // --- Total Pesanan & Growth ---
        $totalPesanan = Pesanan::count();
        
        $pesananBulanIni = Pesanan::whereMonth('created_at', $now->month)
                                  ->whereYear('created_at', $now->year)->count();
        $pesananBulanLalu = Pesanan::whereMonth('created_at', $lastMonth->month)
                                   ->whereYear('created_at', $lastMonth->year)->count();
        
        $pesananGrowth = 0;
        if ($pesananBulanLalu > 0) {
            $pesananGrowth = (($pesananBulanIni - $pesananBulanLalu) / $pesananBulanLalu) * 100;
        } elseif ($pesananBulanIni > 0) {
            $pesananGrowth = 100;
        }

        // --- Pelanggan Baru & Growth ---
        $pelangganBaru = Pelanggan::whereMonth('created_at', $now->month)
                                  ->whereYear('created_at', $now->year)->count();
        $pelangganBulanLalu = Pelanggan::whereMonth('created_at', $lastMonth->month)
                                       ->whereYear('created_at', $lastMonth->year)->count();
        $pelangganGrowth = $pelangganBaru - $pelangganBulanLalu;

        // --- Total Pendapatan & Growth ---
        $allPesanan = Pesanan::all();
        $totalPendapatan = 0;
        foreach($allPesanan as $p) {
            $totalPendapatan += (int)preg_replace('/[^0-9]/', '', $p->price);
        }

        $pendapatanBulanIni = 0;
        $pesananBulanIniList = Pesanan::whereMonth('created_at', $now->month)
                                      ->whereYear('created_at', $now->year)->get();
        foreach($pesananBulanIniList as $p) {
            $pendapatanBulanIni += (int)preg_replace('/[^0-9]/', '', $p->price);
        }

        $pendapatanBulanLalu = 0;
        $pesananBulanLaluList = Pesanan::whereMonth('created_at', $lastMonth->month)
                                       ->whereYear('created_at', $lastMonth->year)->get();
        foreach($pesananBulanLaluList as $p) {
            $pendapatanBulanLalu += (int)preg_replace('/[^0-9]/', '', $p->price);
        }

        $pendapatanGrowth = 0;
        if ($pendapatanBulanLalu > 0) {
            $pendapatanGrowth = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        } elseif ($pendapatanBulanIni > 0) {
            $pendapatanGrowth = 100;
        }

        // --- Transaksi Filtered ---
        $transaksiTerakhir = Pesanan::with('pelanggan')
                                    ->where('created_at', '>=', $startDate)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // --- Data Chart Pendapatan ---
        $chartData = [];
        $chartLabels = [];
        $chartTarget = [];
        
        if ($filter == '7') {
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartLabels[] = $date->translatedFormat('d M');
                
                $sum = 0;
                $orders = Pesanan::whereDate('created_at', $date->toDateString())->get();
                foreach($orders as $o) {
                    $sum += (int)preg_replace('/[^0-9]/', '', $o->price);
                }
                
                $chartData[] = $sum;
                $chartTarget[] = 500000;
            }
        } elseif ($filter == '365') {
            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $chartLabels[] = $month->translatedFormat('M Y');
                
                $sum = 0;
                $orders = Pesanan::whereMonth('created_at', $month->month)
                                 ->whereYear('created_at', $month->year)
                                 ->get();
                foreach($orders as $o) {
                    $sum += (int)preg_replace('/[^0-9]/', '', $o->price);
                }
                
                $chartData[] = $sum;
                $chartTarget[] = 5000000;
            }
        } else {
            // Default 30 days
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartLabels[] = $date->translatedFormat('d M');
                
                $sum = 0;
                $orders = Pesanan::whereDate('created_at', $date->toDateString())->get();
                foreach($orders as $o) {
                    $sum += (int)preg_replace('/[^0-9]/', '', $o->price);
                }
                
                $chartData[] = $sum;
                $chartTarget[] = 500000;
            }
        }

        return view('laporan.index', compact(
            'totalPendapatan', 'pendapatanGrowth',
            'totalPesanan', 'pesananGrowth',
            'pelangganBaru', 'pelangganGrowth',
            'transaksiTerakhir',
            'chartLabels', 'chartData', 'chartTarget',
            'filter'
        ));
    }

    public function pdf(Request $request)
    {
        $filter = $request->query('filter', '30');
        $startDate = Carbon::now()->subDays((int)$filter)->startOfDay();
        
        $transaksi = Pesanan::with('pelanggan')
                            ->where('created_at', '>=', $startDate)
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        $totalPendapatanFilter = 0;
        foreach($transaksi as $t) {
            $totalPendapatanFilter += (int)preg_replace('/[^0-9]/', '', $t->price);
        }

        $pdf = Pdf::loadView('laporan.pdf', compact('transaksi', 'filter', 'totalPendapatanFilter'));
        // Mengatur ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('laporan-transaksi-' . $filter . '-hari.pdf');
    }
}
