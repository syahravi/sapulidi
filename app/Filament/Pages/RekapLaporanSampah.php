<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\IncomingWaste;
use App\Models\SortedWaste;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Actions\Action; // <-- Import Action

class RekapLaporanSampah extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Rekap Sampah';
    protected static ?int $navigationSort = 40;
    protected static string $view = 'filament.pages.rekap-laporan-sampah';

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
                ->icon('heroicon-o-document-arrow-down') // Ikon untuk download PDF
                ->url(fn (): string => route('reports.waste_pdf', [
                    'startDate' => $this->startDate,
                    'endDate' => $this->endDate,
                ]), shouldOpenInNewTab: true), // Buka di tab baru
        ];
    }

    public function getIncomingWasteSummary()
    {
        return IncomingWaste::whereBetween('entry_date', [$this->startDate, $this->endDate])
            ->selectRaw('waste_type_id, SUM(weight) as total_weight')
            ->groupBy('waste_type_id')
            ->with('wasteType')
            ->get();
    }

    public function getSortedWasteSummary()
    {
        return SortedWaste::whereBetween('sorting_date', [$this->startDate, $this->endDate])
            ->selectRaw('waste_type_id, status, SUM(weight) as total_weight')
            ->groupBy('waste_type_id', 'status')
            ->with('wasteType')
            ->get();
    }
}
