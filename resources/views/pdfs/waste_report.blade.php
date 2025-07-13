<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Sampah</title>
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
    </style>
</head>
<body>
    <h1>Rekap Laporan Data Sampah</h1>
    <div class="date-range">
        Periode: {{ $startDate }} s/d {{ $endDate }}
    </div>

    <h2>Sampah Masuk</h2>
    <table>
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Total Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($incomingWasteSummary as $summary)
                <tr>
                    <td>{{ $summary->wasteType->name }}</td>
                    <td>{{ number_format($summary->total_weight, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Tidak ada data sampah masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Sampah Sortir</h2>
    <table>
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Status</th>
                <th>Total Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sortedWasteSummary as $summary)
                <tr>
                    <td>{{ $summary->wasteType->name }}</td>
                    <td>{{ ucfirst($summary->status) }}</td>
                    <td>{{ number_format($summary->total_weight, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data sampah sortir.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
