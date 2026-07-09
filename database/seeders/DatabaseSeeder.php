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
                    'l_badan' => 92, 'l_pinggang' => 74, 'l_punggung' => 36, 'p_bahu' => 12,
                    'p_lengan' => 55, 'l_lengan' => 32, 'l_dada' => 34, 't_susu' => 25, 
                    't_pinggang' => 38, 'l_pinggul' => 98, 'p_baju' => 135, 'l_ketiak' => 46, 'p_rok' => 95
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
                    'l_badan' => 104, 'l_pinggang' => 88, 'l_punggung' => 44, 'p_bahu' => 16,
                    'p_lengan' => 26, 'l_lengan' => 38, 'l_dada' => 42, 't_susu' => 0, 
                    't_pinggang' => 42, 'l_pinggul' => 102, 'p_baju' => 72, 'l_ketiak' => 52, 'p_rok' => 100
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
                    'l_badan' => 88, 'l_pinggang' => 70, 'l_punggung' => 35, 'p_bahu' => 11,
                    'p_lengan' => 53, 'l_lengan' => 30, 'l_dada' => 33, 't_susu' => 24, 
                    't_pinggang' => 36, 'l_pinggul' => 92, 'p_baju' => 65, 'l_ketiak' => 44, 'p_rok' => 92
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
                    'l_badan' => 96, 'l_pinggang' => 80, 'l_punggung' => 38, 'p_bahu' => 13,
                    'p_lengan' => 24, 'l_lengan' => 34, 'l_dada' => 36, 't_susu' => 26, 
                    't_pinggang' => 40, 'l_pinggul' => 100, 'p_baju' => 105, 'l_ketiak' => 48, 'p_rok' => 95
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
                    'l_badan' => 110, 'l_pinggang' => 94, 'l_punggung' => 46, 'p_bahu' => 17,
                    'p_lengan' => 62, 'l_lengan' => 40, 'l_dada' => 44, 't_susu' => 0, 
                    't_pinggang' => 44, 'l_pinggul' => 108, 'p_baju' => 76, 'l_ketiak' => 54, 'p_rok' => 105
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
                'l_badan' => 92, 'l_pinggang' => 74, 'l_punggung' => 36, 'p_bahu' => 12,
                'p_lengan' => 55, 'l_lengan' => 32, 'l_dada' => 34, 't_susu' => 25, 
                't_pinggang' => 38, 'l_pinggul' => 98, 'p_baju' => 135, 'l_ketiak' => 46, 'p_rok' => 95
            ]);

            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'PENJAHITAN',
                'time' => now()->subMinutes(30),
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'PEMOTONGAN',
                'time' => now()->subHours(2),
                'author' => 'Admin',
                'location' => 'Workshop'
            ]);
            RiwayatStatus::create([
                'pesanan_id' => $pesanan1->id,
                'status' => 'MENUNGGU',
                'time' => now()->subHours(5),
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
                'l_badan' => 104, 'l_pinggang' => 88, 'l_punggung' => 44, 'p_bahu' => 16,
                'p_lengan' => 26, 'l_lengan' => 38, 'l_dada' => 42, 't_susu' => 0, 
                't_pinggang' => 42, 'l_pinggul' => 102, 'p_baju' => 72, 'l_ketiak' => 52, 'p_rok' => 100
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
                'l_badan' => 88, 'l_pinggang' => 70, 'l_punggung' => 35, 'p_bahu' => 11,
                'p_lengan' => 53, 'l_lengan' => 30, 'l_dada' => 33, 't_susu' => 24, 
                't_pinggang' => 36, 'l_pinggul' => 92, 'p_baju' => 65, 'l_ketiak' => 44, 'p_rok' => 92
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
                'l_badan' => 96, 'l_pinggang' => 80, 'l_punggung' => 38, 'p_bahu' => 13,
                'p_lengan' => 24, 'l_lengan' => 34, 'l_dada' => 36, 't_susu' => 26, 
                't_pinggang' => 40, 'l_pinggul' => 100, 'p_baju' => 105, 'l_ketiak' => 48, 'p_rok' => 95
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
                'l_dada' => 44,
                'p_baju' => 76,
                'l_bahu' => 17,
                'p_lengan' => 62,
                'l_pinggang' => 94,
                'l_pinggul' => 108,
                'p_celana' => 105,
                'p_rok' => 105
            ]);
        }
        if ($siti) {
            PolaBusana::create([
                'pelanggan_id' => $siti->id,
                'name' => 'Pola Celana - Siti Aminah',
                'type' => 'CELANA',
                'date_created' => '2026-06-12',
                'status' => 'Draf',
                'l_dada' => 34,
                'p_baju' => 135,
                'l_bahu' => 12,
                'p_lengan' => 55,
                'l_pinggang' => 74,
                'l_pinggul' => 98,
                'p_celana' => 95,
                'p_rok' => 95
            ]);
        }
    }
}
