<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function admin_halaman_dashboard(){
        $total_produk = Produk::count();
        $total_pelanggan = User::where('peran','=','USER')->count();
        $total_pendapatan_seluruhnye = Pesanan::where('status_pesanan','=','Pesanan Di Terima')
            ->orWhere('status_pesanan','=','Pembayaran Berhasil')->sum('total_bayar');
        $total_transaksi = Pesanan::where('status_pesanan','=','Pesanan Di Terima')
            ->orWhere('status_pesanan','=','Pembayaran Berhasil')->count();
        $pesanan_bulan_ini = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $pesanan_1_bulan_lalu = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $pesanan_2_bulan_lalu = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $pesanan_3_bulan_lalu = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(3))
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $pesanan_4_bulan_lalu = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(4))
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $pesanan_5_bulan_lalu = Pesanan::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(5))
            ->where('status_pesanan','=','Pesanan Di Terima')->sum('total_bayar');
        $hitungPesanan = array($pesanan_bulan_ini, $pesanan_1_bulan_lalu, $pesanan_2_bulan_lalu, $pesanan_3_bulan_lalu, $pesanan_4_bulan_lalu, $pesanan_5_bulan_lalu);
        return view('Admin.Dashboard.dashboard', compact('total_pelanggan','total_produk','total_pendapatan_seluruhnye', 'total_transaksi', 'hitungPesanan'));
    }
}
