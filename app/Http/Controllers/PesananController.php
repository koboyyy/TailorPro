<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\UkuranBaju; // Pastikan model ini sudah ada
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Ambil data pelanggan beserta ukuran baju masternya dan map ke format yang dibutuhkan frontend
        $customers = Pelanggan::with('ukuranBaju')->get()->map(function ($pelanggan) {
            $words = explode(' ', $pelanggan->name);
            $initials = '';
            foreach (array_slice($words, 0, 2) as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            if (empty($initials)) $initials = 'NN';

            $colorPool = ['bg-[#2D6A4F]', 'bg-[#8C6D58]', 'bg-[#2F3E46]', 'bg-[#457B9D]', 'bg-[#E76F51]', 'bg-[#2A9D8F]'];
            $avatarBg = $colorPool[$pelanggan->id % count($colorPool)] . ' text-white';
            
            $ukuran = $pelanggan->ukuranBaju;

            return [
                'id' => $pelanggan->id,
                'name' => $pelanggan->name,
                'initials' => $initials,
                'avatarBg' => $avatarBg,
                'l_badan' => $ukuran->l_badan ?? null,
                'l_pinggang' => $ukuran->l_pinggang ?? null,
                'l_punggung' => $ukuran->l_punggung ?? null,
                'p_bahu' => $ukuran->p_bahu ?? null,
                'p_lengan' => $ukuran->p_lengan ?? null,
                'l_lengan' => $ukuran->l_lengan ?? null,
                'l_dada' => $ukuran->l_dada ?? null,
                't_susu' => $ukuran->t_susu ?? null,
                't_pinggang' => $ukuran->t_pinggang ?? null,
                'l_pinggul' => $ukuran->l_pinggul ?? null,
                'p_baju' => $ukuran->p_baju ?? null,
                'l_ketiak' => $ukuran->l_ketiak ?? null,
                'p_rok' => $ukuran->p_rok ?? '-',
            ];
        });

        // Ambil data pesanan beserta relasi pelanggan dan map ke format frontend
        $rawOrders = Pesanan::with(['pelanggan', 'riwayatStatus'])->orderBy('created_at', 'desc')->get();
        
        $orders = $rawOrders->map(function ($pesanan) {
            $pelanggan = $pesanan->pelanggan;
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

            return [
                'id' => $pesanan->id,
                'customer' => $pelanggan ? $pelanggan->name : 'Unknown',
                'initials' => $initials,
                'avatarBg' => $avatarBg,
                'type' => $pesanan->type,
                'quantity' => $pesanan->quantity,
                'start_date' => $pesanan->start_date,
                'deadline' => $pesanan->deadline,
                'price' => $pesanan->price,
                'notes' => $pesanan->notes,
                'status' => $pesanan->status,
                'progress' => $pesanan->progress,
                'l_badan' => $pesanan->l_badan,
                'l_pinggang' => $pesanan->l_pinggang,
                'l_punggung' => $pesanan->l_punggung,
                'p_bahu' => $pesanan->p_bahu,
                'p_lengan' => $pesanan->p_lengan,
                'l_lengan' => $pesanan->l_lengan,
                'l_dada' => $pesanan->l_dada,
                't_susu' => $pesanan->t_susu,
                't_pinggang' => $pesanan->t_pinggang,
                'l_pinggul' => $pesanan->l_pinggul,
                'p_baju' => $pesanan->p_baju,
                'l_ketiak' => $pesanan->l_ketiak,
                'p_rok' => $pesanan->p_rok,
                'photo' => $pesanan->photo_reference,
            ];
        });

        $orderTimeline = [];
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        foreach ($rawOrders as $pesanan) {
            $timeline = $pesanan->riwayatStatus->sortByDesc('time')->map(function ($rs) use ($months) {
                $time = $rs->time;
                $formattedTime = $time->format('j') . ' ' . $months[$time->format('n') - 1] . ' ' . $time->format('Y') . ', ' . $time->format('H:i');
                return [
                    'status' => $rs->status,
                    'time' => $formattedTime,
                    'author' => $rs->author ?? 'Admin',
                    'location' => $rs->location ?? 'Workshop',
                ];
            });
            $orderTimeline[$pesanan->id] = $timeline->values()->toArray();
        }

        return view('pesanan.index', compact('customers', 'orders', 'orderTimeline'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'type' => 'required|string',
            'quantity' => 'required|numeric',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'price' => 'required|string',
        ]);

        // 1. Kumpulkan field ukuran
        $sizeData = $request->only([
            'l_badan',
            'l_pinggang',
            'l_punggung',
            'p_bahu',
            'p_lengan',
            'l_lengan',
            'l_dada',
            't_susu',
            't_pinggang',
            'l_pinggul',
            'p_baju',
            'l_ketiak',
            'p_rok'
        ]);

        // 2. Update atau Buat data master di tabel `ukuran_bajus`
        // Ini akan mencari ukuran berdasarkan pelanggan_id. 
        // Jika ada, ukurannya diupdate. Jika belum ada, akan dibuatkan baris baru.
        UkuranBaju::updateOrCreate(
            ['pelanggan_id' => $request->pelanggan_id],
            $sizeData
        );

        // 3. Simpan / Update Pesanan
        if ($request->id) {
            // Jika ada ID pesanan, berarti mode EDIT
            $pesanan = Pesanan::findOrFail($request->id);
            $pesanan->update($request->all());
            $message = 'Pesanan berhasil diperbarui!';
        } else {
            // Jika tidak ada ID, berarti mode TAMBAH BARU
            $pesanan = Pesanan::create($request->all());
            $message = 'Pesanan baru berhasil dibuat!';
        }

        // PERUBAHAN: Redirect kembali ke route dengan pesan sukses
        return redirect()->route('pesanan.index')->with('success', $message);
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $pesanan->status = $request->status;
        $pesanan->progress = $request->progress;
        $pesanan->save();

        // Tambah riwayat status
        $pesanan->riwayatStatus()->create([
            'status' => $pesanan->status,
            'time' => now(),
            'author' => 'Admin', // In real app, this would be auth()->user()->name
            'location' => 'Workshop',
        ]);

        return response()->json(['success' => true, 'message' => 'Status pesanan berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return response()->json(['success' => true, 'message' => 'Pesanan berhasil dihapus!']);
    }
}