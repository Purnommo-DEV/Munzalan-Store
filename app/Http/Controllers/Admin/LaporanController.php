<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesananProduk;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function admin_laporan_penjualan(){
       $data_pesanan = Pesanan::where('status_pesanan','=','Pesanan Di Terima')->get();
       $data_pesanan_produk = PesananProduk::get();
        return view('Admin.Laporan.laporan_penjualan', compact('data_pesanan', 'data_pesanan_produk'));
    }

    public function admin_cetak_laporan_penjualan($tglawal, $tglakhir){
        $data_pesanan = Pesanan::where('status_pesanan','=','Pesanan Di Terima')->whereBetween('created_at',[$tglawal, $tglakhir])->get();
        $data_pesanan_produk = PesananProduk::get();
        return view('Admin.Laporan.cetak_laporan', compact('data_pesanan', 'data_pesanan_produk'));
    }
}
