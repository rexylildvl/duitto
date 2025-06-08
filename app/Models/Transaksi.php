<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'tipe',
        'jumlah',
        'user_id',
        'deadline',
        'status',
        'nama',
        'frekuensi',
        'target'
    ];
}

