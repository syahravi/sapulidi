<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenRevenue extends Model
{
    use HasFactory;

    protected $table = 'citizen_revenues'; // Nama tabel yang sesuai

    protected $fillable = [
        'citizen_name',
        'waste_weight',
        'amount_paid',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date', // Cast tanggal transaksi sebagai objek Date
    ];
}
