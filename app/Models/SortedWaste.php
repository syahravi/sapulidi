<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SortedWaste extends Model
{
    use HasFactory;

    protected $table = 'sorted_waste'; // Nama tabel yang sesuai

    protected $fillable = [
        'waste_type_id',
        'weight',
        'sorting_date',
        'status',
    ];

    protected $casts = [
        'sorting_date' => 'date', // Cast tanggal sortir sebagai objek Date
        'status' => 'string', // Pastikan status di-cast sebagai string
    ];

    /**
     * Mendefinisikan relasi many-to-one dengan WasteType.
     */
    public function wasteType(): BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }
}
