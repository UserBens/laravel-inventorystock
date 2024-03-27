<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';


    protected $fillable = ['nomor_penjualan', 'tgl_penjualan', 'produk_id', 'qty', 'total'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
