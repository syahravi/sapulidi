<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomingWaste extends Model
{
    use HasFactory;

    protected $table = 'incoming_waste'; // Nama tabel yang sesuai

    protected $fillable = [
        'waste_type_id',
        'weight',
        'entry_date',
        'collector_name',
    ];

    protected $casts = [
        'entry_date' => 'date', // Cast tanggal masuk sebagai objek Date
    ];

    /**
     * Mendefinisikan relasi many-to-one dengan WasteType.
     */
    public function wasteType(): BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }
}
