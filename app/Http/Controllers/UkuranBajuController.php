<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\UkuranBaju;
use Carbon\Carbon;

class UkuranBajuController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('ukuranBaju')->orderBy('created_at', 'desc')->get();
        
        $customers = $pelanggans->map(function ($c) {
            $words = explode(' ', $c->name);
            $initials = '';
            foreach (array_slice($words, 0, 2) as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            if (empty($initials)) $initials = 'NN';
            
            $ukuran = $c->ukuranBaju;

            // Extract avatar styling from db or assign random
            $avatarBg = $c->avatar_url ?? 'bg-[#2D6A4F] text-white';

            $updatedAt = $ukuran ? $ukuran->updated_at : $c->updated_at;
            
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $formattedDate = $updatedAt->format('j') . ' ' . $months[$updatedAt->format('n') - 1] . ' ' . $updatedAt->format('Y');

            return [
                'id' => $c->id,
                'name' => $c->name,
                'initials' => $initials,
                'avatarBg' => $avatarBg,
                'l_badan' => $ukuran->l_badan ?? 0,
                'l_pinggang' => $ukuran->l_pinggang ?? 0,
                'l_punggung' => $ukuran->l_punggung ?? 0,
                'p_bahu' => $ukuran->p_bahu ?? 0,
                'p_lengan' => $ukuran->p_lengan ?? 0,
                'l_lengan' => $ukuran->l_lengan ?? 0,
                'l_dada' => $ukuran->l_dada ?? 0,
                't_susu' => $ukuran->t_susu ?? 0,
                't_pinggang' => $ukuran->t_pinggang ?? 0,
                'l_pinggul' => $ukuran->l_pinggul ?? 0,
                'p_baju' => $ukuran->p_baju ?? 0,
                'l_ketiak' => $ukuran->l_ketiak ?? 0,
                'p_rok' => $ukuran->p_rok ?? 0,
                'updated_at' => $formattedDate,
            ];
        });

        return view('ukuran-baju.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            // fields below are numeric or nullable
        ]);

        $pelangganId = $request->id;

        if ($pelangganId) {
            // Edit mode
            $pelanggan = Pelanggan::find($pelangganId);
            if ($pelanggan) {
                $pelanggan->name = $request->name;
                $pelanggan->save();
            } else {
                return response()->json(['success' => false, 'message' => 'Pelanggan tidak ditemukan']);
            }
        } else {
            // Create mode: Create basic Pelanggan first
            $colorPool = ['bg-[#2D6A4F]', 'bg-[#8C6D58]', 'bg-[#2F3E46]', 'bg-[#457B9D]', 'bg-[#E76F51]', 'bg-[#2A9D8F]'];
            $avatarUrl = $colorPool[rand(0, 5)] . ' text-white';

            $pelanggan = Pelanggan::create([
                'name' => $request->name,
                'phone' => '-',
                'address' => '-',
                'status' => 'Aktif',
                'member_since' => now()->format('Y-m-d'),
                'avatar_url' => $avatarUrl,
            ]);
            $pelangganId = $pelanggan->id;
        }

        // Prepare data with default 0
        $ukuranData = [
            'l_badan' => $request->input('l_badan', 0) ?: 0,
            'l_pinggang' => $request->input('l_pinggang', 0) ?: 0,
            'l_punggung' => $request->input('l_punggung', 0) ?: 0,
            'p_bahu' => $request->input('p_bahu', 0) ?: 0,
            'p_lengan' => $request->input('p_lengan', 0) ?: 0,
            'l_lengan' => $request->input('l_lengan', 0) ?: 0,
            'l_dada' => $request->input('l_dada', 0) ?: 0,
            't_susu' => $request->input('t_susu', 0) ?: 0,
            't_pinggang' => $request->input('t_pinggang', 0) ?: 0,
            'l_pinggul' => $request->input('l_pinggul', 0) ?: 0,
            'p_baju' => $request->input('p_baju', 0) ?: 0,
            'l_ketiak' => $request->input('l_ketiak', 0) ?: 0,
            'p_rok' => $request->input('p_rok', 0) ?: 0,
        ];

        // Update or Create Ukuran Baju
        UkuranBaju::updateOrCreate(
            ['pelanggan_id' => $pelangganId],
            $ukuranData
        );

        return response()->json(['success' => true, 'id' => $pelangganId]);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $pelanggan->delete(); // This should cascade or we delete related sizes too
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
