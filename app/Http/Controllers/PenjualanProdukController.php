<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Stockproduk;
use Illuminate\Http\Request;

class PenjualanProdukController extends Controller
{
    public function viewpenjualan()
    {
        // $produk = Produk::all();
        // return view('penjualan', compact('produk'));
        $produk = Produk::all();
        $penjualan = Penjualan::with('produk')->get();

        return view('penjualan', compact('penjualan', 'produk'));
    }

    public function storepenjualan(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nomor_penjualan' => 'required',
            'tgl_penjualan' => 'required',
            'produk_id' => 'required|exists:produk,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Ambil stok produk dari data produk yang dipilih
        $stock = Stockproduk::where('produk_id', $request->produk_id)->first();

        // Periksa apakah stok produk mencukupi untuk jumlah yang diminta
        if ($stock && $request->qty > $stock->saldo) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Ambil harga produk dari data produk yang dipilih
        $produk = Produk::findOrFail($request->produk_id);
        $hargaProduk = $produk->harga_jual;

        // Hitung total berdasarkan harga produk dan qty
        $total = $hargaProduk * $request->qty;

        // Tambahkan total ke dalam data yang akan disimpan
        $validatedData['total'] = $total;

        // Simpan data penjualan
        Penjualan::create($validatedData);

        // Update kartu stok
        $stock = Stockproduk::where('produk_id', $request->produk_id)->first();
        if (!$stock) {
            $stock = new Stockproduk();
            $stock->produk_id = $request->produk_id;
        }
        $stock->out += $request->qty; // Mengurangkan jumlah penjualan dari saldo
        $stock->saldo -= $request->qty; // Mengurangkan jumlah penjualan dari saldo
        $stock->tanggal = $request->tgl_penjualan; // Set tanggal dari penjualan

        // Hitung total saldo berdasarkan semua pembelian
        $total_pembelian = Pembelian::where('produk_id', $request->produk_id)->sum('total');

        // Hitung total saldo berdasarkan semua penjualan
        $total_penjualan = Penjualan::where('produk_id', $request->produk_id)->sum('total');

        // Hitung total saldo dari pembelian dan penjualan
        $total_saldo = $total_pembelian + $total_penjualan;

        // Simpan total saldo ke dalam kolom saldo
        $stock->saldo = $total_saldo;

        $stock->save();

        return redirect()->back()->with('success', 'Penjualan berhasil disimpan.');
    }

    public function penjualandestroy(string $id)
    {
        Penjualan::where('id', $id)->delete();
        return redirect('/penjualan/create')->with('success', 'Penjualan berhasil dihapus!');
    }
}
