<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stockproduk;
use Illuminate\Http\Request;

class StockCardController extends Controller
{
    public function index()
    {
        $stokproduk = Stockproduk::with('produk')->get();
        // $produk = Produk::all();

        return view('stockcard', compact('stokproduk'));
    }
}
