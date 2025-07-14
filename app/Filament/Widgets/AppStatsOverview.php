<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget; // Mengimpor kelas dasar untuk widget statistik
use Filament\Widgets\StatsOverviewWidget\Stat; // Mengimpor kelas Stat untuk membuat kartu statistik
use App\Models\User;           // Mengimpor model User
use App\Models\IncomingWaste;  // Mengimpor model IncomingWaste
use App\Models\CitizenRevenue; // Mengimpor model CitizenRevenue
use App\Models\SortedWasteRevenue; // Mengimpor model SortedWasteRevenue

class AppStatsOverview extends BaseWidget
{
    // Properti ini mengatur urutan widget di dashboard.
    // Nilai yang lebih kecil akan muncul lebih dulu.
    protected static ?int $sort = 0;

    /**
     * Mendapatkan daftar statistik (kartu) yang akan ditampilkan di overview.
     * Setiap elemen dalam array ini adalah sebuah objek Stat.
     *
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        // Menghitung total jumlah pengguna dari model User
        $totalUsers = User::count();

        // Menghitung total berat sampah masuk dari model IncomingWaste
        // Menggunakan sum() untuk menjumlahkan kolom 'weight'
        $totalIncomingWasteBags = IncomingWaste::sum('bag_count');

        // Menghitung total pendapatan yang dibayarkan kepada warga dari model CitizenRevenue
        // Menggunakan sum() untuk menjumlahkan kolom 'amount_paid'
        $totalCitizenRevenue = CitizenRevenue::sum('amount_paid');

        // Menghitung total pendapatan yang diterima dari penjualan sampah dari model SortedWasteRevenue
        // Menggunakan sum() untuk menjumlahkan kolom 'amount_received'
        $totalSortedWasteRevenue = SortedWasteRevenue::sum('amount_received');

        // Mengembalikan array dari objek Stat, yang masing-masing merepresentasikan satu kartu statistik.
        return [
            // Kartu statistik untuk Total Pengguna
            Stat::make('Total Pengguna', $totalUsers) // Label kartu dan nilai
                ->description('Jumlah pengguna terdaftar') // Deskripsi di bawah label
                ->descriptionIcon('heroicon-o-users') // Ikon untuk deskripsi
                ->color('info'), // Warna kartu (sesuai tema Filament)

            // Kartu statistik untuk Total Sampah Masuk
            Stat::make('Total Sampah Masuk', number_format($totalIncomingWasteBags, 0) . ' kantong') // Menggunakan 'bag_count' dan format kantong
                ->description('Total kantong sampah yang masuk') // Deskripsi diubah
                ->descriptionIcon('heroicon-o-arrow-down-on-square')
                ->color('success'),

            // Kartu statistik untuk Pendapatan dari Warga
            Stat::make('Pendapatan dari Warga', 'Rp ' . number_format($totalCitizenRevenue, 2, ',', '.'))
                ->description('Total uang yang dibayarkan ke warga')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('warning'),

            // Kartu statistik untuk Pendapatan dari Sampah Dijual
            Stat::make('Pendapatan dari Sampah Dijual', 'Rp ' . number_format($totalSortedWasteRevenue, 2, ',', '.'))
                ->description('Total uang yang diterima dari penjualan sampah')
                ->descriptionIcon('heroicon-o-currency-euro')
                ->color('primary'),
        ];
    }
}
