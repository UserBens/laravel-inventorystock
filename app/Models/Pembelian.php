<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = ['nomor_pembelian', 'tgl_pembelian', 'produk_id', 'qty', 'total'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
