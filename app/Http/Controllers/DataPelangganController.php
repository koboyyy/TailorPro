<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index()
    {
        $pelanggans = \App\Models\Pelanggan::withCount('pesanan')->get();
        
        $totalPelanggan = $pelanggans->count();
        $pelangganAktif = $pelanggans->where('status', 'Aktif')->count();
        
        $memberBaru = $pelanggans->filter(function($p) {
            return \Carbon\Carbon::parse($p->member_since)->diffInDays(now()) <= 30;
        })->count();
        
        $repeatOrder = $totalPelanggan > 0 
            ? round(($pelanggans->where('pesanan_count', '>', 1)->count() / $totalPelanggan) * 100)
            : 0;
            
        $customers = $pelanggans->map(function ($c) {
            $words = explode(' ', $c->name);
            $initials = '';
            foreach (array_slice($words, 0, 2) as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            if (empty($initials)) $initials = 'NN';

            $date = \Carbon\Carbon::parse($c->member_since);
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $formattedDate = $months[$date->format('n') - 1] . ' ' . $date->format('Y');

            $statusColor = $c->status === 'Aktif' ? 'text-green-500' : 'text-gray-400';
            
            $badgeBg = 'bg-[#F6EFE6]';
            $badgeText = 'text-[#8C7A6B]';
            if ($c->pesanan_count > 10) {
                $badgeBg = 'bg-[#E8EAF6]';
                $badgeText = 'text-[#3F51B5]';
            } elseif ($c->pesanan_count >= 5) {
                $badgeBg = 'bg-[#E0F2F1]';
                $badgeText = 'text-[#00796B]';
            } elseif ($c->pesanan_count == 0) {
                $badgeBg = 'bg-gray-100';
                $badgeText = 'text-gray-500';
            }
            
            return [
                'id' => $c->id,
                'name' => $c->name,
                'member_since' => $formattedDate,
                'phone' => $c->phone ?? '-',
                'address' => $c->address ?? '-',
                'total_orders' => $c->pesanan_count,
                'badge_bg' => $badgeBg,
                'badge_text' => $badgeText,
                'status' => $c->status,
                'status_color' => $statusColor,
                'avatar' => null,
                'initials' => $initials,
                'row_bg' => 'bg-white',
            ];
        })->values()->toArray();

        return view('data-pelanggan.index', compact(
            'customers', 
            'totalPelanggan', 
            'pelangganAktif', 
            'memberBaru', 
            'repeatOrder'
        ));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif,Menunggu',
        ]);

        $pelanggan = \App\Models\Pelanggan::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? '-',
            'address' => $validated['address'] ?? '-',
            'status' => $validated['status'],
            'member_since' => now(),
            'avatar_url' => 'bg-['.['#2D6A4F', '#8C6D58', '#2F3E46', '#457B9D', '#E76F51', '#2A9D8F'][rand(0, 5)].'] text-white',
        ]);

        return response()->json(['success' => true, 'data' => $pelanggan]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif,Menunggu',
        ]);

        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        $pelanggan->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? '-',
            'address' => $validated['address'] ?? '-',
            'status' => $validated['status'],
        ]);

        return response()->json(['success' => true, 'data' => $pelanggan]);
    }

    public function destroy($id)
    {
        $pelanggan = \App\Models\Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return response()->json(['success' => true]);
    }
}
