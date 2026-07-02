<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\UkuranBaju;
use App\Models\Pesanan;
use App\Models\RiwayatStatus;
use App\Models\PolaBusana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        User::updateOrCreate(
            ['email' => 'admin@tailorpro.com'],
            [
                'name' => 'Admin Jahit',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Seed Pelanggans & Ukuran Baju
        $pelanggansData = [
            [
                'name' => 'Siti Aminah',
                'phone' => '081234567890',
                'address' => 'Jl. Mawar No. 12, Jakarta',
                'status' => 'Aktif',
                'member_since' => '2026-01-10',
                'avatar_url' => 'bg-[#2D6A4F] text-white',
                'sizes' => [
                    'l_badan' => 88, 'l_pinggang' => 76, 'l_punggung' => 40, 'p_bahu' => 12,
                    'p_lengan' => 24, 'l_lengan' => 32, 't_susu' => 25, 't_pinggang' => 38,
                    'l_pinggul' => 94, 'p_baju' => 70, 'p_rok' => 0
                ]
            ],
            [
                'name' => 'Budi Santoso',
                'phone' => '082234567891',
                'address' => 'Jl. Melati No. 4, Bandung',
                'status' => 'Aktif',
                'member_since' => '2026-02-15',
                'avatar_url' => 'bg-[#8C6D58] text-white',
                'sizes' => [
                    'l_badan' => 92, 'l_pinggang' => 80, 'l_punggung' => 42, 'p_bahu' => 13,
                    'p_lengan' => 25, 'l_lengan' => 34, 't_susu' => 26, 't_pinggang' => 39,
                    'l_pinggul' => 96, 'p_baju' => 72, 'p_rok' => 0
                ]
            ],
            [
                'name' => 'Dewi Sartika',
                'phone' => '083234567892',
                'address' => 'Jl. Dahlia No. 8, Yogyakarta',
                'status' => 'Aktif',
                'member_since' => '2026-03-20',
                'avatar_url' => 'bg-[#2F3E46] text-white',
                'sizes' => [
                    'l_badan' => 84, 'l_pinggang' => 68, 'l_punggung' => 38, 'p_bahu' => 11,
                    'p_lengan' => 23, 'l_lengan' => 30, 't_susu' => 24, 't_pinggang' => 37,
                    'l_pinggul' => 90, 'p_baju' => 65, 'p_rok' => 0
                ]
            ],
            [
                'name' => 'Anita Wijaya',
                'phone' => '084234567893',
                'address' => 'Jl. Kenanga No. 15, Surabaya',
                'status' => 'Aktif',
                'member_since' => '2026-04-05',
                'avatar_url' => 'bg-[#457B9D] text-white',
                'sizes' => [
                    'l_badan' => 96, 'l_pinggang' => 84, 'l_punggung' => 44, 'p_bahu' => 14,
                    'p_lengan' => 26, 'l_lengan' => 36, 't_susu' => 27, 't_pinggang' => 40,
                    'l_pinggul' => 100, 'p_baju' => 75, 'p_rok' => 0
                ]
            ],
            [
                'name' => 'Ahmad Subagja',
                'phone' => '085234567894',
                'address' => 'Jl. Anggrek No. 20, Semarang',
                'status' => 'Aktif',
                'member_since' => '2026-05-12',
                'avatar_url' => 'bg-[#2563EB] text-white',
                'sizes' => [
                    'l_badan' => 96, 'l_pinggang' => 80, 'l_punggung' => 44, 'p_bahu' => 14,
                    'p_lengan' => 24, 'l_lengan' => 34, 't_susu' => 26, 't_pinggang' => 39,
                    'l_pinggul' => 98, 'p_baju' => 72, 'p_rok' => 0
                ]
            ],
        ];

        foreach ($pelanggansData as $data) {
            $pelanggan = Pelanggan::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'status' => $data['status'],
                'member_since' => $data['member_since'],
                'avatar_url' => $data['avatar_url'],
            ]);

            // Create Ukuran Baju
            $pelanggan->ukuranBaju()->create($data['sizes']);
        }

        // 3. Seed Pesanans & Riwayat Status
        $siti = Pelanggan::where('name', 'Siti Aminah')->first();
        $budi = Pelanggan::where('name', 'Budi Santoso')->first();
        $dewi = Pelanggan::where('name', 'Dewi Sartika')->first();
        $anita = Pelanggan::where('name', 'Anita Wijaya')->first();

        // Siti's order
        if ($siti) {
            $pesanan1 = Pesanan::create([
                'pelanggan_id' => $siti->id,
                'type' => "Gamis Syar'i",
                'quantity' => 1,
                'start_date' => '2026-08-17',
                'deadline' => '2026-08-25',
                'price' => '250.000',
                'status' => 'PENJAHITAN',
                'progress' => 65,
                'notes' => 'Tidak ada catatan tambahan',
                'l_badan' => 88, 'l_pinggang' => 76, 'l_punggung' => 40, 'p_bahu' => 12,
                'p_lengan' => 24, 'l_lengan' => 32, 't_susu' => 25, 't_pinggang' => 38,
                'l_pinggul' => 94, 'p_baju' => 70, 'p_rok' => 0
            ]);

            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'PENJAHITAN',
                'time' => '2026-08-20 14:20:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'PEMOTONGAN',
                'time' => '2026-08-18 09:15:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'MENUNGGU',
                'time' => '2026-08-17 10:00:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
        }

        // Budi's order
        if ($budi) {
            $pesanan2 = Pesanan::create([
                'pelanggan_id' => $budi->id,
                'type' => 'Kemeja Batik',
                'quantity' => 1,
                'start_date' => '2026-08-12',
                'deadline' => '2026-08-18',
                'price' => '180.000',
                'status' => 'PEMOTONGAN',
                'progress' => 30,
                'notes' => 'Kerah tegak, kancing dalam.',
                'l_badan' => 92, 'l_pinggang' => 80, 'l_punggung' => 42, 'p_bahu' => 13,
                'p_lengan' => 25, 'l_lengan' => 34, 't_susu' => 26, 't_pinggang' => 39,
                'l_pinggul' => 96, 'p_baju' => 72, 'p_rok' => 0
            ]);

            RiwayatStatus::create([
                'pesanan_id' => $pesanan2->id,
                'status' => 'PEMOTONGAN',
                'time' => '2026-08-14 11:30:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan2->id,
                'status' => 'MENUNGGU',
                'time' => '2026-08-12 09:00:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
        }

        // Dewi's order
        if ($dewi) {
            $pesanan3 = Pesanan::create([
                'pelanggan_id' => $dewi->id,
                'type' => 'Kebaya Wisuda',
                'quantity' => 1,
                'start_date' => '2026-08-10',
                'deadline' => '2026-08-16',
                'price' => '350.000',
                'status' => 'PENYELESAIAN',
                'progress' => 90,
                'notes' => 'Bahan brokat dengan furing satin.',
                'l_badan' => 84, 'l_pinggang' => 68, 'l_punggung' => 38, 'p_bahu' => 11,
                'p_lengan' => 23, 'l_lengan' => 30, 't_susu' => 24, 't_pinggang' => 37,
                'l_pinggul' => 90, 'p_baju' => 65, 'p_rok' => 0
            ]);

            RiwayatStatus::create([
                'pesanan_id' => $pesanan3->id,
                'status' => 'PENYELESAIAN',
                'time' => '2026-08-15 16:00:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan3->id,
                'status' => 'PENJAHITAN',
                'time' => '2026-08-13 10:30:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan3->id,
                'status' => 'PEMOTONGAN',
                'time' => '2026-08-11 14:00:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan3->id,
                'status' => 'MENUNGGU',
                'time' => '2026-08-10 11:00:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
        }

        // Anita's order
        if ($anita) {
            $pesanan4 = Pesanan::create([
                'pelanggan_id' => $anita->id,
                'type' => 'Dress Casual',
                'quantity' => 2,
                'start_date' => '2026-08-15',
                'deadline' => '2026-08-22',
                'price' => '120.000',
                'status' => 'MENUNGGU',
                'progress' => 5,
                'notes' => 'Model loose dress casual.',
                'l_badan' => 96, 'l_pinggang' => 84, 'l_punggung' => 44, 'p_bahu' => 14,
                'p_lengan' => 26, 'l_lengan' => 36, 't_susu' => 27, 't_pinggang' => 40,
                'l_pinggul' => 100, 'p_baju' => 75, 'p_rok' => 0
            ]);

            RiwayatStatus::create([
                'pesanan_id' => $pesanan4->id,
                'status' => 'MENUNGGU',
                'time' => '2026-08-15 09:45:00',
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
        }

        // 4. Seed Pola Busana
        $ahmad = Pelanggan::where('name', 'Ahmad Subagja')->first();
        if ($ahmad) {
            PolaBusana::create([
                'pelanggan_id' => $ahmad->id,
                'name' => 'Pola Baju - Ahmad Subagja',
                'type' => 'BAJU',
                'date_created' => '2026-06-10',
                'status' => 'Aktif',
                'l_dada' => 96,
                'p_baju' => 72,
                'l_bahu' => 44,
                'p_lengan' => 24,
                'l_pinggang' => 80,
                'l_pinggul' => 98,
                'p_celana' => 95,
                'p_rok' => 0
            ]);
        }
        if ($siti) {
            PolaBusana::create([
                'pelanggan_id' => $siti->id,
                'name' => 'Pola Celana - Siti Aminah',
                'type' => 'CELANA',
                'date_created' => '2026-06-12',
                'status' => 'Draf',
                'l_dada' => 88,
                'p_baju' => 70,
                'l_bahu' => 40,
                'p_lengan' => 24,
                'l_pinggang' => 76,
                'l_pinggul' => 94,
                'p_celana' => 90,
                'p_rok' => 0
            ]);
        }
    }
}
