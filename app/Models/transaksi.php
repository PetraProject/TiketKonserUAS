<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tiket',
        'jumlah_tiket',
        'total_bayar_tiket',
        'tanggal_bayar_tiket'
    ];
}
