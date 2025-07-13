<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomingWasteResource\Pages;
use App\Filament\Resources\IncomingWasteResource\RelationManagers;
use App\Models\IncomingWaste;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomingWasteResource extends Resource
{
    protected static ?string $model = IncomingWaste::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';
    protected static ?string $navigationGroup = 'Data Sampah';
    protected static ?string $navigationLabel = 'Sampah Masuk';
    protected static ?int $navigationSort = 21;

    // Tambahkan properti ini untuk mengubah label model ke Bahasa Indonesia
    protected static ?string $modelLabel = 'Sampah Masuk';
    protected static ?string $pluralModelLabel = 'Sampah Masuk'; // Atau 'Data Sampah Masuk'
    protected static ?string $slug = 'sampah-masuk'; // <-- Ubah rute URL menjadi 'sampah-masuk'

    /**
     * Mendefinisikan skema formulir untuk membuat dan mengedit Sampah Masuk.
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
                Forms\Components\TextInput::make('weight')
                    ->label('Berat (kg)')
                    ->required()
                    ->numeric()
                    ->suffix('kg'),
                Forms\Components\DatePicker::make('entry_date')
                    ->label('Tanggal Masuk')
                    ->required()
                    ->default(now()),
                Forms\Components\TextInput::make('collector_name')
                    ->label('Nama Pengepul')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    /**
     * Mendefinisikan skema tabel untuk menampilkan daftar Sampah Masuk.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('wasteType.name')
                    ->label('Jenis Sampah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Berat')
                    ->suffix(' kg')
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Tanggal Masuk')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('collector_name')
                    ->label('Nama Pengepul')
                    ->searchable()
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
                Tables\Filters\Filter::make('entry_date')
                    ->form([
                        Forms\Components\DatePicker::make('entry_date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('entry_date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['entry_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('entry_date', '>=', $date),
                            )
                            ->when(
                                $data['entry_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('entry_date', '<=', $date),
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
            'index' => Pages\ListIncomingWastes::route('/'),
            'create' => Pages\CreateIncomingWaste::route('/create'),
            'edit' => Pages\EditIncomingWaste::route('/{record}/edit'),
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
