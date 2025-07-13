<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SortedWasteRevenue extends Model
{
    use HasFactory;

    protected $table = 'sorted_waste_revenues'; // Nama tabel yang sesuai

    protected $fillable = [
        'waste_type_id',
        'sold_weight',
        'amount_received',
        'sale_date',
    ];

    protected $casts = [
        'sale_date' => 'date', // Cast tanggal penjualan sebagai objek Date
    ];

    /**
     * Mendefinisikan relasi many-to-one dengan WasteType.
     */
    public function wasteType(): BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }
}
