<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage; // <-- Import Storage facade

class WasteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image', // <-- Tambahkan 'image' di sini
        'unit_of_weight',
    ];

    /**
     * Mendefinisikan relasi one-to-many dengan IncomingWaste.
     */
    public function incomingWaste(): HasMany
    {
        return $this->hasMany(IncomingWaste::class);
    }

    /**
     * Mendefinisikan relasi one-to-many dengan SortedWaste.
     */
    public function sortedWaste(): HasMany
    {
        return $this->hasMany(SortedWaste::class);
    }

    /**
     * Mendefinisikan relasi one-to-many dengan SortedWasteRevenue.
     */
    public function sortedWasteRevenues(): HasMany
    {
        return $this->hasMany(SortedWasteRevenue::class);
    }

    /**
     * Accessor untuk mendapatkan URL gambar jenis sampah.
     * Dipanggil saat Anda mengakses $wasteType->image_url.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            // Pastikan Anda sudah menjalankan 'php artisan storage:link'
            return Storage::url($this->image);
        }

        return null; // Atau kembalikan URL placeholder default jika tidak ada gambar
    }
}
