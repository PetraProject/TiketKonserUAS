<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tiket',
        'tanggal_tiket',
        'harga_tiket'
    ];
}
