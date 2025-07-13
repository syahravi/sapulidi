<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SortedWasteResource\Pages;
use App\Filament\Resources\SortedWasteResource\RelationManagers;
use App\Models\SortedWaste;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SortedWasteResource extends Resource
{
    protected static ?string $model = SortedWaste::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Data Sampah';
    protected static ?string $navigationLabel = 'Sampah Sortir';
    protected static ?int $navigationSort = 22;

    // Tambahkan properti ini untuk mengubah label model ke Bahasa Indonesia
    protected static ?string $modelLabel = 'Sampah Sortir';
    protected static ?string $pluralModelLabel = 'Sampah Sortir'; // Atau 'Data Sampah Sortir'
    protected static ?string $slug = 'sampah-sortir'; // <-- Ubah rute URL menjadi 'sampah-sortir'

    /**
     * Mendefinisikan skema formulir untuk membuat dan mengedit Sampah Sortir.
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
                Forms\Components\DatePicker::make('sorting_date')
                    ->label('Tanggal Sortir')
                    ->required()
                    ->default(now()),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'dijual' => 'Dijual',
                        'dibuang' => 'Dibuang',
                    ])
                    ->required(),
            ]);
    }

    /**
     * Mendefinisikan skema tabel untuk menampilkan daftar Sampah Sortir.
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
                Tables\Columns\TextColumn::make('sorting_date')
                    ->label('Tanggal Sortir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dijual' => 'success',
                        'dibuang' => 'danger',
                        default => 'gray',
                    })
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dijual' => 'Dijual',
                        'dibuang' => 'Dibuang',
                    ]),
                Tables\Filters\Filter::make('sorting_date')
                    ->form([
                        Forms\Components\DatePicker::make('sorting_date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sorting_date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['sorting_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sorting_date', '>=', $date),
                            )
                            ->when(
                                $data['sorting_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sorting_date', '<=', $date),
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
            'index' => Pages\ListSortedWastes::route('/'),
            // Hapus .title() dari sini
            'create' => Pages\CreateSortedWaste::route('/create'),
            'edit' => Pages\EditSortedWaste::route('/{record}/edit'),
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
