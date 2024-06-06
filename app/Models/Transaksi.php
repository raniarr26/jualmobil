<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'total',
        // tambahkan field lain sesuai kebutuhan
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
