<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CitizenRevenue;
use App\Models\SortedWasteRevenue;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Actions\Action; // <-- Import Action

class RekapPendapatan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Rekap Pendapatan';
    protected static ?int $navigationSort = 41;
    protected static string $view = 'filament.pages.rekap-pendapatan';

    public ?string $startDate = null;
    public ?string $endDate = null;

    public function mount(): void
    {
        $this->startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('startDate')
                    ->label('Dari Tanggal')
                    ->live()
                    ->default(Carbon::now()->startOfWeek()),
                DatePicker::make('endDate')
                    ->label('Sampai Tanggal')
                    ->live()
                    ->default(Carbon::now()->endOfWeek()),
            ]);
    }

    /**
     * Mendefinisikan aksi-aksi di header halaman.
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('generatePdf')
                ->label('Generate PDF')
                ->color('primary')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn (): string => route('reports.revenue_pdf', [
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate,
                ]), shouldOpenInNewTab: true), // Buka di tab baru
        ];
    }

    public function getTotalCitizenRevenue(): float
    {
        return CitizenRevenue::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->sum('amount_paid');
    }

    public function getCitizenRevenueSummary()
    {
        return CitizenRevenue::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->selectRaw('citizen_name, SUM(waste_weight) as total_waste_weight, SUM(amount_paid) as total_amount_paid')
            ->groupBy('citizen_name')
            ->get();
    }

    public function getTotalSortedWasteRevenue(): float
    {
        return SortedWasteRevenue::whereBetween('sale_date', [$this->startDate, $this->endDate])
            ->sum('amount_received');
    }

    public function getSortedWasteRevenueSummary()
    {
        return SortedWasteRevenue::whereBetween('sale_date', [$this->startDate, $this->endDate])
            ->selectRaw('waste_type_id, SUM(sold_weight) as total_sold_weight, SUM(amount_received) as total_amount_received')
            ->groupBy('waste_type_id')
            ->with('wasteType')
            ->get();
    }
}
