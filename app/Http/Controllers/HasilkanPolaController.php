<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\UkuranBaju;

class HasilkanPolaController extends Controller
{
    public function index()
    {
        // Ambil semua data ukuran baju beserta data relasi pelanggan
        $ukuranPelanggan = UkuranBaju::with('pelanggan')->get();

        // Buat array berisi data ukuran + data pelanggan detail
        $result = $ukuranPelanggan->map(function ($item) {
            $pelanggan = $item->pelanggan;

            return [
                'id' => $item->id,
                'pelanggan_id' => $item->pelanggan_id,
                // Data pelanggan - ambil dari atribut sebenarnya, sesuai struktur database
                'nama_pelanggan' => $pelanggan ? ($pelanggan->name ?? '') : '',
                'inisial' => $pelanggan && isset($pelanggan->name) && $pelanggan->name ? strtoupper(implode('', array_map(function ($part) {
                    return mb_substr($part, 0, 1);
                }, preg_split('/[\s\-]+/u', trim($pelanggan->name))))) : '',
                'avatar_bg' => $pelanggan && isset($pelanggan->name) && $pelanggan->name
                    ? [
                        'bg-blue-600 text-white',    // Default for A-G
                        'bg-green-700 text-white',   // H-N
                        'bg-amber-800 text-white',   // O-U
                        'bg-red-700 text-white',     // V-Z
                    ][$index = min(
                            3,
                            ceil((ord(strtoupper(mb_substr(trim($pelanggan->name), 0, 1))) - ord('A')) / 7)
                        )]
                    : 'bg-gray-300 text-gray-600',

                'telepon' => $pelanggan ? ($pelanggan->phone ?? '') : '',
                'alamat' => $pelanggan ? ($pelanggan->address ?? '') : '',
                'status_pelanggan' => $pelanggan ? ($pelanggan->status ?? '') : '',
                'member_since' => $pelanggan ? ($pelanggan->member_since ?? '') : '',
                'avatar_url' => $pelanggan ? ($pelanggan->avatar_url ?? '') : '',
                // Data ukuran baju
                'l_badan' => $item->l_badan,
                'l_pinggang' => $item->l_pinggang,
                'l_punggung' => $item->l_punggung,
                'p_bahu' => $item->p_bahu,
                'p_lengan' => $item->p_lengan,
                'l_lengan' => $item->l_lengan,
                'l_dada' => $item->l_dada,
                't_susu' => $item->t_susu,
                't_pinggang' => $item->t_pinggang,
                'l_pinggul' => $item->l_pinggul,
                'p_baju' => $item->p_baju,
                'l_ketiak' => $item->l_ketiak,
                'p_rok' => $item->p_rok,
                // Timestamp
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        })->toArray();

        return view('hasilkan-pola.index', [
            'ukuranPelanggan' => $result
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'type' => 'required|string',
            'status' => 'required|string',
        ]);

        $pelanggan = \App\Models\Pelanggan::with('ukuranBaju')->findOrFail($request->pelanggan_id);
        $ukuran = $pelanggan->ukuranBaju;

        \App\Models\PolaBusana::create([
            'pelanggan_id' => $pelanggan->id,
            'name' => 'Pola ' . ucfirst(strtolower($request->type)) . ' - ' . $pelanggan->name,
            'type' => $request->type,
            'date_created' => now(),
            'status' => $request->status,
            'l_dada' => $ukuran->l_badan ?? null,
            'p_baju' => $ukuran->p_baju ?? null,
            'l_bahu' => $ukuran->l_punggung ?? null,
            'p_lengan' => $ukuran->p_lengan ?? null,
            'l_pinggang' => $ukuran->l_pinggang ?? null,
            'l_pinggul' => $ukuran->l_pinggul ?? null,
            'p_celana' => $ukuran->p_celana ?? null,
            'p_rok' => $ukuran->p_rok ?? '-',
        ]);

        return response()->json(['success' => true]);
    }
}
