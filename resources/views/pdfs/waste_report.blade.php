<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekap Laporan Sampah</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 12px;
      color: #333;
      margin: 30px;
      background-color: #f9f9f9;
    }

    h1, h2 {
      text-align: center;
      margin-top: 0;
      color: #2c3e50;
    }

    .date-range {
      text-align: center;
      margin: 10px 0 30px;
      font-weight: bold;
      font-size: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
      background-color: white;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px 12px;
      text-align: left;
    }

    th {
      background-color: #3498db;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .no-data {
      text-align: center;
      font-style: italic;
      color: #999;
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
        <th>Nama Pengepul</th>
        <th>Jenis Sampah</th>
        <th>Total Kantong</th>
      </tr>
    </thead>
    <tbody>
      @forelse($incomingWasteSummary as $summary)
        <tr>
          <td>{{ $summary->collector_name }}</td>
          <td>Sampah Campuran / Segala Jenis Sampah</td>
          <td>{{ number_format($summary->total_bag_count, 0) }} kantong</td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="no-data">Tidak ada data sampah masuk.</td>
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
          <td colspan="3" class="no-data">Tidak ada data sampah sortir.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
