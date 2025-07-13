<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SortedWasteRevenueResource\Pages;
use App\Filament\Resources\SortedWasteRevenueResource\RelationManagers;
use App\Models\SortedWasteRevenue;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SortedWasteRevenueResource extends Resource
{
    protected static ?string $model = SortedWasteRevenue::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    protected static ?string $navigationGroup = 'Data Pendapatan';
    protected static ?string $navigationLabel = 'Pendapatan Sampah Dijual';
    protected static ?int $navigationSort = 31;

    // Tambahkan properti ini untuk mengubah label model ke Bahasa Indonesia
    protected static ?string $modelLabel = 'Pendapatan Sampah Dijual';
    protected static ?string $pluralModelLabel = 'Pendapatan Sampah Dijual'; // Atau 'Pendapatan-pendapatan Sampah Dijual'
    protected static ?string $slug = 'pendapatan-sampah-dijual'; // <-- Ubah rute URL

    /**
     * Mendefinisikan skema formulir untuk membuat dan mengedit Pendapatan Sampah Dijual.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('waste_type_id')
                    ->label('Jenis Sampah')
                    ->options(WasteType::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('sold_weight')
                    ->label('Berat Sampah Dijual (kg)')
                    ->required()
                    ->numeric()
                    ->suffix('kg'),
                Forms\Components\TextInput::make('amount_received')
                    ->label('Jumlah Uang Diterima (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->step(0.01),
                Forms\Components\DatePicker::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->required()
                    ->default(now()),
            ]);
    }

    /**
     * Mendefinisikan skema tabel untuk menampilkan daftar Pendapatan Sampah Dijual.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('wasteType.name')
                    ->label('Jenis Sampah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sold_weight')
                    ->label('Berat Dijual')
                    ->suffix(' kg')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_received')
                    ->label('Jumlah Diterima')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_date')
                    ->label('Tanggal Penjualan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('waste_type_id')
                    ->label('Jenis Sampah')
                    ->options(WasteType::all()->pluck('name', 'id')),
                Tables\Filters\Filter::make('sale_date')
                    ->form([
                        Forms\Components\DatePicker::make('sale_date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sale_date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['sale_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sale_date', '>=', $date),
                            )
                            ->when(
                                $data['sale_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sale_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Mendefinisikan halaman-halaman yang terkait dengan resource ini.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSortedWasteRevenues::route('/'),
            'create' => Pages\CreateSortedWasteRevenue::route('/create'),
            'edit' => Pages\EditSortedWasteRevenue::route('/{record}/edit'),
        ];
    }

    /**
     * Mendefinisikan relasi yang terkait dengan resource ini.
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Mendefinisikan kueri dasar untuk resource ini.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }
}
