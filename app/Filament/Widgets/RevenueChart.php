<?php

namespace App\Filament\Widgets;

use App\Models\CitizenRevenue;    // Mengimpor model CitizenRevenue
use App\Models\SortedWasteRevenue; // Mengimpor model SortedWasteRevenue
use Filament\Widgets\ChartWidget; // Mengimpor kelas dasar untuk widget grafik
use Flowframe\Trend\Trend;      // Mengimpor Trend (pastikan sudah diinstal: composer require flowframe/laravel-trend)
use Flowframe\Trend\TrendValue; // Mengimpor TrendValue

class RevenueChart extends ChartWidget
{
    // Judul yang akan ditampilkan di widget grafik
    protected static ?string $heading = 'Tren Pendapatan per Bulan';

    // Urutan widget di dashboard (setelah IncomingWasteChart)
    protected static ?int $sort = 2;

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
        // Ambil data pendapatan dari warga selama 12 bulan terakhir
        $citizenRevenueData = Trend::model(CitizenRevenue::class)
            ->between(
                start: now()->subMonths(11)->startOfMonth(), // Mulai dari 11 bulan sebelumnya + bulan ini = 12 bulan
                end: now()->endOfMonth(), // Sampai akhir bulan ini
            )
            ->perMonth() // Agregasi data per bulan
            ->sum('amount_paid'); // Jumlahkan kolom 'amount_paid'

        // Ambil data pendapatan dari sampah dijual selama 12 bulan terakhir
        $sortedWasteRevenueData = Trend::model(SortedWasteRevenue::class)
            ->between(
                start: now()->subMonths(11)->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perMonth()
            ->sum('amount_received'); // Jumlahkan kolom 'amount_received'

        // Gabungkan data untuk label (bulan)
        // Kita bisa mengambil label dari salah satu dataset karena rentang waktunya sama
        $labels = $citizenRevenueData->map(fn (TrendValue $value) => $value->date);

        // Mengembalikan struktur data yang diperlukan oleh Chart.js
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan dari Warga (Rp)', // Label untuk dataset ini
                    'data' => $citizenRevenueData->map(fn (TrendValue $value) => $value->aggregate), // Nilai agregat
                    'borderColor' => '#FFC107', // Warna garis (kuning)
                    'backgroundColor' => 'rgba(255, 193, 7, 0.2)', // Warna area (kuning transparan)
                    'fill' => true, // Mengisi area di bawah garis
                ],
                [
                    'label' => 'Pendapatan dari Sampah Dijual (Rp)', // Label untuk dataset ini
                    'data' => $sortedWasteRevenueData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#2196F3', // Warna garis (biru)
                    'backgroundColor' => 'rgba(33, 150, 243, 0.2)', // Warna area (biru transparan)
                    'fill' => true,
                ],
            ],
            'labels' => $labels, // Label untuk sumbu X (horizontal)
        ];
    }
}
