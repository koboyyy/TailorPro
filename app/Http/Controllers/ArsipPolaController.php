<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipPolaController extends Controller
{
    public function index()
    {
        $rawPatterns = \App\Models\PolaBusana::with('pelanggan.ukuranBaju')->orderBy('created_at', 'desc')->get();
        
        $patterns = $rawPatterns->map(function ($p) {
            $pelanggan = $p->pelanggan;
            $ukuran = $pelanggan ? $pelanggan->ukuranBaju : null;
            $initials = 'NN';
            $avatarBg = 'bg-[#2D6A4F] text-white';
            
            if ($pelanggan) {
                $words = explode(' ', $pelanggan->name);
                $initials = '';
                foreach (array_slice($words, 0, 2) as $w) {
                    $initials .= strtoupper(substr($w, 0, 1));
                }
                if (empty($initials)) $initials = 'NN';
                
                $colorPool = ['bg-[#2D6A4F]', 'bg-[#8C6D58]', 'bg-[#2F3E46]', 'bg-[#457B9D]', 'bg-[#E76F51]', 'bg-[#2A9D8F]'];
                $avatarBg = $colorPool[$pelanggan->id % count($colorPool)] . ' text-white';
            }

            $date = \Carbon\Carbon::parse($p->date_created);
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $formattedDate = $date->format('j') . ' ' . $months[$date->format('n') - 1] . ' ' . $date->format('Y');

            return [
                'id' => $p->id,
                'name' => $p->name,
                'type' => $p->type,
                'customerName' => $pelanggan ? $pelanggan->name : 'Unknown',
                'customerCode' => $pelanggan ? 'ID #' . $pelanggan->id : '-',
                'avatarBg' => $avatarBg,
                'initials' => $initials,
                'date' => $formattedDate,
                'status' => $p->status,
                'l_dada' => $p->l_dada,
                'p_baju' => $p->p_baju,
                'l_bahu' => $p->l_bahu,
                'p_lengan' => $p->p_lengan,
                'l_pinggang' => $p->l_pinggang,
                'l_pinggul' => $p->l_pinggul,
                'p_celana' => $p->p_celana,
                'p_rok' => $p->p_rok,
                // Full ukuran from relations
                'ukuran' => $ukuran ? [
                    'l_badan' => $ukuran->l_badan,
                    'l_pinggang' => $ukuran->l_pinggang,
                    'l_punggung' => $ukuran->l_punggung,
                    'p_bahu' => $ukuran->p_bahu,
                    'p_lengan' => $ukuran->p_lengan,
                    'l_lengan' => $ukuran->l_lengan,
                    't_susu' => $ukuran->t_susu,
                    't_pinggang' => $ukuran->t_pinggang,
                    'l_pinggul' => $ukuran->l_pinggul,
                    'p_baju' => $ukuran->p_baju,
                    'p_rok' => $ukuran->p_rok,
                ] : null,
            ];
        });

        return view('arsip-pola.index', compact('patterns'));
    }

    public function destroy($id)
    {
        $pattern = \App\Models\PolaBusana::findOrFail($id);
        $pattern->delete();
        return response()->json(['success' => true]);
    }
}
