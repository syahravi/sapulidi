<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WasteTypeResource\Pages;
use App\Filament\Resources\WasteTypeResource\RelationManagers;
use App\Models\WasteType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WasteTypeResource extends Resource
{
    protected static ?string $model = WasteType::class;
    protected static ?string $slug = 'jenis-sampah';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Data Sampah';
    protected static ?string $navigationLabel = 'Jenis Sampah';
    protected static ?int $navigationSort = 20;

    // Tambahkan properti ini untuk mengubah label model
    protected static ?string $modelLabel = 'Jenis Sampah';
    protected static ?string $pluralModelLabel = 'Jenis-jenis Sampah';

    /**
     * Mendefinisikan skema formulir untuk membuat dan mengedit Jenis Sampah.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Jenis Sampah')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Deskripsi')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image') // <-- TAMBAHKAN INI UNTUK UPLOAD GAMBAR
                    ->label('Foto Jenis Sampah')
                    ->image() // Hanya izinkan file gambar
                    ->directory('waste-types') // Simpan gambar di storage/app/public/waste-types
                    ->nullable(),
                Forms\Components\TextInput::make('unit_of_weight')
                    ->label('Satuan Berat')
                    ->required()
                    ->default('kg')
                    ->maxLength(50),
            ]);
    }

    /**
     * Mendefinisikan skema tabel untuk menampilkan daftar Jenis Sampah.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image') // <-- TAMBAHKAN INI UNTUK MENAMPILKAN GAMBAR
                    ->label('Foto')
                    ->circular() // Tampilkan gambar dalam bentuk lingkaran
                    ->size(50), // Ukuran gambar
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Jenis Sampah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_of_weight')
                    ->label('Satuan Berat'),
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
                //
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
            'index' => Pages\ListWasteTypes::route('/'),
            'create' => Pages\CreateWasteType::route('/create'),
            'edit' => Pages\EditWasteType::route('/{record}/edit'),
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
