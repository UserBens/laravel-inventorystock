<?php

namespace App\Models;

use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Stockproduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';


    protected $fillable = ['kode', 'nama', 'harga_jual'];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function stockproduk()
    {
        return $this->hasMany(Stockproduk::class);
    }
}
