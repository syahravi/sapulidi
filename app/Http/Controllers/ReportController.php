<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomingWaste;
use App\Models\SortedWaste;
use App\Models\CitizenRevenue;
use App\Models\SortedWasteRevenue;
use Barryvdh\DomPDF\Facade\Pdf; // Import facade PDF
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menghasilkan PDF untuk Rekap Laporan Sampah.
     *
     * @param string $startDateString
     * @param string $endDateString
     * @return \Illuminate\Http\Response
     */
    public function generateWasteReportPdf(string $startDateString, string $endDateString)
    {
        // Konversi string tanggal ke objek Carbon
        $startDate = Carbon::parse($startDateString)->startOfDay();
        $endDate = Carbon::parse($endDateString)->endOfDay();

        // Ambil data sampah masuk berdasarkan nama pengepul dan jumlah kantong
        $incomingWasteSummary = IncomingWaste::whereBetween('entry_date', [$startDate, $endDate])
            ->selectRaw('collector_name, SUM(bag_count) as total_bag_count') // Mengubah select dan sum
            ->groupBy('collector_name') // Mengelompokkan berdasarkan nama pengepul
            ->get();

        // Ambil data sampah sortir
        // Asumsi model SortedWaste masih menggunakan waste_type_id dan weight.
        // Jika Anda juga mengubah model SortedWaste, Anda perlu menyesuaikan ini juga.
        $sortedWasteSummary = SortedWaste::whereBetween('sorting_date', [$startDate, $endDate])
            ->selectRaw('waste_type_id, status, SUM(weight) as total_weight')
            ->groupBy('waste_type_id', 'status')
            ->with('wasteType')
            ->get();

        // Data yang akan dilewatkan ke view PDF
        $data = [
            'startDate' => $startDate->format('d-m-Y'),
            'endDate' => $endDate->format('d-m-Y'),
            'incomingWasteSummary' => $incomingWasteSummary,
            'sortedWasteSummary' => $sortedWasteSummary,
        ];

        // Muat view Blade untuk PDF dan generate PDF
        $pdf = Pdf::loadView('pdfs.waste_report', $data);

        // Unduh PDF
        return $pdf->download('rekap_sampah_' . $startDate->format('Ymd') . '_' . $endDate->format('Ymd') . '.pdf');
    }

    /**
     * Menghasilkan PDF untuk Rekap Pendapatan.
     *
     * @param string $startDateString
     * @param string $endDateString
     * @return \Illuminate\Http\Response
     */
    public function generateRevenueReportPdf(string $startDateString, string $endDateString)
    {
        // Konversi string tanggal ke objek Carbon
        $startDate = Carbon::parse($startDateString)->startOfDay();
        $endDate = Carbon::parse($endDateString)->endOfDay();

        // Hitung total pendapatan dari warga
        $totalCitizenRevenue = CitizenRevenue::whereBetween('transaction_date', [$startDate, $endDate])->sum('amount_paid');

        // Ambil ringkasan pendapatan dari warga
        $citizenRevenueSummary = CitizenRevenue::whereBetween('transaction_date', [$startDate, $endDate])
            ->selectRaw('citizen_name, SUM(waste_weight) as total_waste_weight, SUM(amount_paid) as total_amount_paid')
            ->groupBy('citizen_name')
            ->get();

        // Hitung total pendapatan dari sampah dijual
        $totalSortedWasteRevenue = SortedWasteRevenue::whereBetween('sale_date', [$startDate, $endDate])->sum('amount_received');

        // Ambil ringkasan pendapatan dari sampah dijual
        $sortedWasteRevenueSummary = SortedWasteRevenue::whereBetween('sale_date', [$startDate, $endDate])
            ->selectRaw('waste_type_id, SUM(sold_weight) as total_sold_weight, SUM(amount_received) as total_amount_received')
            ->groupBy('waste_type_id')
            ->with('wasteType')
            ->get();

        // Data yang akan dilewatkan ke view PDF
        $data = [
            'startDate' => $startDate->format('d-m-Y'),
            'endDate' => $endDate->format('d-m-Y'),
            'totalCitizenRevenue' => $totalCitizenRevenue,
            'citizenRevenueSummary' => $citizenRevenueSummary,
            'totalSortedWasteRevenue' => $totalSortedWasteRevenue,
            'sortedWasteRevenueSummary' => $sortedWasteRevenueSummary,
        ];

        // Muat view Blade untuk PDF dan generate PDF
        $pdf = Pdf::loadView('pdfs.revenue_report', $data);

        // Unduh PDF
        return $pdf->download('rekap_pendapatan_' . $startDate->format('Ymd') . '_' . $endDate->format('Ymd') . '.pdf');
    }
}
