<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitizenRevenueResource\Pages;
use App\Filament\Resources\CitizenRevenueResource\RelationManagers;
use App\Models\CitizenRevenue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitizenRevenueResource extends Resource
{
    protected static ?string $model = CitizenRevenue::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Data Pendapatan';
    protected static ?string $navigationLabel = 'Pendapatan Warga';
    protected static ?int $navigationSort = 30;

    // Tambahkan properti ini untuk mengubah label model ke Bahasa Indonesia
    protected static ?string $modelLabel = 'Pendapatan Warga';
    protected static ?string $pluralModelLabel = 'Pendapatan Warga'; // Atau 'Pendapatan-pendapatan Warga'
    protected static ?string $slug = 'pendapatan-warga'; // <-- Ubah rute URL menjadi 'pendapatan-warga'

    /**
     * Mendefinisikan skema formulir untuk membuat dan mengedit Pendapatan Warga.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('citizen_name')
                    ->label('Nama Warga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('waste_weight')
                    ->label('Berat Sampah Diserahkan (kg)')
                    ->required()
                    ->numeric()
                    ->suffix('kg'),
                Forms\Components\TextInput::make('amount_paid')
                    ->label('Jumlah Uang Dibayar (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->step(0.01),
                Forms\Components\DatePicker::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->required()
                    ->default(now()),
            ]);
    }

    /**
     * Mendefinisikan skema tabel untuk menampilkan daftar Pendapatan Warga.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('citizen_name')
                    ->label('Nama Warga')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waste_weight')
                    ->label('Berat Sampah')
                    ->suffix(' kg')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->label('Jumlah Dibayar')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Tanggal Transaksi')
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
                Tables\Filters\Filter::make('transaction_date')
                    ->form([
                        Forms\Components\DatePicker::make('transaction_date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('transaction_date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['transaction_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '>=', $date),
                            )
                            ->when(
                                $data['transaction_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '<=', $date),
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
            'index' => Pages\ListCitizenRevenues::route('/'),
            'create' => Pages\CreateCitizenRevenue::route('/create'),
            'edit' => Pages\EditCitizenRevenue::route('/{record}/edit'),
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
