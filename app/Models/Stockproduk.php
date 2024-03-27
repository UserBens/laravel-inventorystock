<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stockproduk extends Model
{
    use HasFactory;

    protected $table = 'stockproduk';


    protected $fillable = ['produk_id', 'tanggal', 'in', 'out', 'saldo'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
