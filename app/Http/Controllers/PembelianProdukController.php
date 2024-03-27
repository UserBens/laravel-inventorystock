<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Stockproduk;
use Illuminate\Http\Request;

class PembelianProdukController extends Controller
{
    public function viewpembelian()
    {
        $produk = Produk::all();
        $pembelian = Pembelian::with('produk')->get();

        return view('pembelian', compact('pembelian', 'produk'));
    }

    public function storepembelian(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nomor_pembelian' => 'required',
            'tgl_pembelian' => 'required',
            'produk_id' => 'required|exists:produk,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Ambil stok produk dari data produk yang dipilih
        $stock = Stockproduk::where('produk_id', $request->produk_id)->first();

        // Periksa apakah stok produk mencukupi untuk jumlah yang diminta
        if ($stock && $request->qty > $stock->saldo) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Ambil jumlah total penjualan dari produk yang dipilih
        $total_penjualan = Penjualan::where('produk_id', $request->produk_id)->sum('qty');

        // Jumlah total pembelian saat ini
        $total_pembelian = $request->qty;

        // Cek apakah jumlah total pembelian lebih besar dari total penjualan
        if ($total_pembelian > $total_penjualan) {
            return redirect()->back()->with('error', 'Jumlah pembelian tidak boleh melebihi jumlah penjualan.');
        }

        // Ambil harga produk dari data produk yang dipilih
        $produk = Produk::findOrFail($request->produk_id);
        $hargaProduk = $produk->harga_jual;

        // Hitung total berdasarkan harga produk dan qty
        $total = $hargaProduk * $request->qty;

        // Tambahkan total ke dalam data yang akan disimpan
        $validatedData['total'] = $total;

        // Simpan data pembelian
        Pembelian::create($validatedData);

        // Update kartu stok
        $stock->in += $request->qty; // Menambah jumlah pembelian ke saldo
        $stock->saldo += $request->qty; // Menambah jumlah pembelian ke saldo
        $stock->tanggal = $request->tgl_pembelian; // Set tanggal dari pembelian

        // Hitung total saldo berdasarkan semua pembelian
        $total_pembelian = Pembelian::where('produk_id', $request->produk_id)->sum('total');

        // Hitung total saldo berdasarkan semua penjualan
        $total_penjualan = Penjualan::where('produk_id', $request->produk_id)->sum('total');

        // Hitung total saldo dari pembelian dan penjualan
        $total_saldo = $total_pembelian - $total_penjualan;

        // Simpan total saldo ke dalam kolom saldo
        $stock->saldo = $total_saldo;

        $stock->save();

        return redirect()->back()->with('success', 'Pembelian berhasil disimpan.');
    }

    public function pembeliandestroy(string $id)
    {
        Pembelian::where('id', $id)->delete();
        return redirect('/pembelian/create')->with('success', 'Pembelian berhasil dihapus!');
    }
}
