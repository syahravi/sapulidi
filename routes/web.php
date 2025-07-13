<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController; // Import ReportController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menghasilkan PDF laporan sampah
Route::get('/reports/waste-pdf/{startDate}/{endDate}', [ReportController::class, 'generateWasteReportPdf'])
    ->name('reports.waste_pdf');

// Rute untuk menghasilkan PDF laporan pendapatan
Route::get('/reports/revenue-pdf/{startDate}/{endDate}', [ReportController::class, 'generateRevenueReportPdf'])
    ->name('reports.revenue_pdf');

// ... rute-rute lain Anda (misalnya rute Filament)
