<?php

namespace App\Filament\Widgets;

use App\Models\IncomingWaste; // Mengimpor model IncomingWaste
use Filament\Widgets\ChartWidget; // Mengimpor kelas dasar untuk widget grafik
use Flowframe\Trend\Trend;       // Mengimpor Trend (pastikan sudah diinstal: composer require flowframe/laravel-trend)
use Flowframe\Trend\TrendValue; // Mengimpor TrendValue

class IncomingWasteChart extends ChartWidget
{
    // Judul yang akan ditampilkan di widget grafik
    protected static ?string $heading = 'Tren Sampah Masuk per Bulan';

    // Urutan widget di dashboard.
    // Jika AppStatsOverview memiliki sort 0, maka ini akan muncul setelahnya.
    protected static ?int $sort = 1;

    /**
     * Mendapatkan tipe grafik yang akan digunakan (misal: 'line', 'bar', 'pie', dll.).
     *
     * @return string
     */
    protected function getType(): string
    {
        return 'line'; // Mengatur tipe grafik sebagai grafik garis
    }

    /**
     * Mendapatkan data yang akan digunakan untuk mengisi grafik.
     * Data ini akan diolah menjadi format yang bisa dimengerti oleh Chart.js.
     *
     * @return array
     */
    protected function getData(): array
    {
        // Mengambil data sampah masuk dari model IncomingWaste.
        // Kita akan menganalisis tren selama 12 bulan terakhir.
        $data = Trend::model(IncomingWaste::class)
            ->between(
                // Menentukan rentang waktu: mulai dari awal bulan 11 bulan yang lalu
                // hingga akhir bulan saat ini, untuk mencakup total 12 bulan.
                start: now()->subMonths(11)->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perMonth() // Mengagregasi data per bulan
            ->sum('bag_count'); // MENGUBAH 'weight' menjadi 'bag_count'

        // Mengembalikan struktur data yang diperlukan oleh Chart.js
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kantong Sampah Masuk', // MENGUBAH label grafik
                    // Mengambil nilai agregat dari hasil tren
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'borderColor' => '#4CAF50', // Warna garis grafik (hijau)
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)', // Warna area di bawah garis (hijau transparan)
                    'fill' => true, // Mengisi area di bawah garis
                ],
            ],
            // Label untuk sumbu X (horizontal), yang akan menampilkan nama bulan
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }
}
