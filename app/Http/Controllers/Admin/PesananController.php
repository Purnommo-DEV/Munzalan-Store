<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananLogs;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\TransferPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function admin_halaman_pesanan(){
        $pesananPelanggan = Pesanan::get();
        return view('Admin.Pesanan.pesanan', compact('pesananPelanggan'));
    }

    public function admin_halaman_detail_pesanan($id){
        $pesananPelanggan = Pesanan::where('id', $id)->first();
        $produkDiPesan = PesananProduk::where('pesanan_id', $id)->get();
        $dataProduk = Produk::get();
        $transferPembayaran = TransferPembayaran::where('pesanan_id', $id)->first() ?? new TransferPembayaran();
        $pesanan_logs = PesananLogs::where('pesanan_id', $id)->orderBy('id', 'DESC')->get();
        return view('Admin.Pesanan.detail_pesanan', compact('pesananPelanggan', 'produkDiPesan', 'dataProduk', 'transferPembayaran', 'pesanan_logs'));
    }
    
    public function admin_status_pesanan_logs(Request $request){
        $pesanan_logs = new PesananLogs();
        $pesanan_logs->pesanan_id = $request->pesanan_id;
        $pesanan_logs->pesanan_status = $request->pesanan_status;
        $pesanan_logs->save();

        Pesanan::where('id', $pesanan_logs->pesanan_id)->update([
            'resi'=>$request->resi,
            'status_pesanan'=>$request->pesanan_status
        ]);
        Alert::success('Sukses','Berhasil Memperbarui Status Pesanan');
        return redirect()->back()->with('success');
    }

    public function admin_verifikasi_pembayaran(Request $request){
        $data = $request->all();
        TransferPembayaran::where('pesanan_id', $data['pesanan_id'])->update([
            'status_verifikasi'=> "Sudah Di Verifikasi"
        ]);
        Pesanan::where('id', $data['pesanan_id'])->update([
            'status_pesanan'=> "Pending"
        ]);
        Alert::success('Sukses','Berhasil Verifikasi Pembayaran');
        return redirect()->back()->with('success');
    }
}
