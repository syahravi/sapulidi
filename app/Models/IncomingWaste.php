<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingWaste extends Model
{
    use HasFactory;

    protected $table = 'incoming_waste';

    protected $fillable = [
        'bag_count',
        'entry_date',
        'collector_name',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

}
