<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4A3A2A;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }
        .summary {
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            width: 50%;
        }
        .summary-item strong {
            display: inline-block;
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            color: #333;
        }
        td {
            padding: 8px 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-selesai { background-color: #d1fae5; color: #065f46; }
        .status-diproses { background-color: #e0e7ff; color: #3730a3; }
        .status-menunggu { background-color: #ffedd5; color: #9a3412; }
        .status-default { background-color: #f3f4f6; color: #374151; }
        
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .footer p {
            margin: 0 0 50px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>TAILOR PRO</h1>
        <p>Laporan Transaksi Pesanan</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <p><strong>Periode Laporan</strong> : {{ $filter == '7' ? '7 Hari Terakhir' : ($filter == '365' ? '1 Tahun Terakhir' : '30 Hari Terakhir') }}</p>
            <p><strong>Tanggal Dicetak</strong> : {{ \Carbon\Carbon::now()->format('d F Y H:i') }}</p>
        </div>
        <div class="summary-item" style="text-align: right;">
            <p><strong>Total Transaksi</strong> : {{ $transaksi->count() }}</p>
            <p><strong>Total Pendapatan</strong> : Rp {{ number_format($totalPendapatanFilter, 0, ',', '.') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%">ID Transaksi</th>
                <th width="20%">Pelanggan</th>
                <th width="20%">Layanan (Tipe)</th>
                <th width="15%">Tanggal</th>
                <th width="15%" class="text-right">Harga</th>
                <th width="10%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $t)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>#TX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $t->pelanggan->name ?? 'Unknown' }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y') }}</td>
                <td class="text-right">Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $t->price), 0, ',', '.') }}</td>
                <td class="text-center">
                    @php
                        $statusClass = 'status-default';
                        if(in_array(strtoupper($t->status), ['SELESAI', 'DIAMBIL'])) {
                            $statusClass = 'status-selesai';
                        } elseif(strtoupper($t->status) == 'DIPROSES') {
                            $statusClass = 'status-diproses';
                        } elseif(strtoupper($t->status) == 'MENUNGGU') {
                            $statusClass = 'status-menunggu';
                        }
                    @endphp
                    <span class="status {{ $statusClass }}">{{ strtoupper($t->status) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">Tidak ada transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Admin Tailor Pro</strong></p>
    </div>

</body>
</html>
