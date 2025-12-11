<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Ronda Bulan Ini</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #f1f1f1;
            padding: 8px;
            border: 1px solid #777;
            font-size: 12px;
            text-align: center;
        }

        table td {
            padding: 7px;
            border: 1px solid #999;
            font-size: 12px;
        }

        .row-hadir {
            background: #e8fff0;
        }

        .row-alpha {
            background: #ffecec;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>LAPORAN ABSENSI RONDA</h2>
    <p>Periode: <strong>{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</strong></p>
    <p>RT / RW / Kecamatan</p>
</div>
<div class="info">
    <strong>Total Data:</strong> {{ count($absens) }} entri absensi  
</div>
<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Warga</th>
        <th>Tanggal Ronda</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($absens as $i => $a)

        @php
            $isHadir = $a->status == 1;
        @endphp

        <tr class="{{ $isHadir ? 'row-hadir' : 'row-alpha' }}">
            <td style="text-align: center; width: 40px;">{{ $i + 1 }}</td>
            <td>{{ $a->nama_lengkap }}</td>
            <td>{{ date('d-m-Y H:i', strtotime($a->jadwal_masuk)) }}</td>
            <td style="text-align: center;">
                {{ $isHadir ? 'Hadir' : 'Tidak Hadir' }}
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

<div class="footer">
   Dicetak pada: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
</div>

</body>
</html>
