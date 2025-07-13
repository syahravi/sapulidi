<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 20mm;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .total-summary {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Rekap Laporan Pendapatan</h1>
    <div class="date-range">
        Periode: {{ $startDate }} s/d {{ $endDate }}
    </div>

    <h2>Pendapatan dari Warga</h2>
    <div class="total-summary">
        Total: Rp {{ number_format($totalCitizenRevenue, 2, ',', '.') }}
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama Warga</th>
                <th>Total Berat Sampah (kg)</th>
                <th>Total Jumlah Dibayar (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citizenRevenueSummary as $summary)
                <tr>
                    <td>{{ $summary->citizen_name }}</td>
                    <td>{{ number_format($summary->total_waste_weight, 2) }}</td>
                    <td>{{ number_format($summary->total_amount_paid, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data pendapatan dari warga.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Pendapatan dari Sampah Dijual</h2>
    <div class="total-summary">
        Total: Rp {{ number_format($totalSortedWasteRevenue, 2, ',', '.') }}
    </div>
    <table>
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Total Berat Dijual (kg)</th>
                <th>Total Jumlah Diterima (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sortedWasteRevenueSummary as $summary)
                <tr>
                    <td>{{ $summary->wasteType->name }}</td>
                    <td>{{ number_format($summary->total_sold_weight, 2) }}</td>
                    <td>{{ number_format($summary->total_amount_received, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data pendapatan dari sampah dijual.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
