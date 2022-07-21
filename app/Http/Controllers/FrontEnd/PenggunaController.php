<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Kota;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Provinsi;
use App\Models\Penilaian;
use App\Models\PesananLogs;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\AlamatPengiriman;
use App\Models\TransferPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\InputRegisterRequest;

class PenggunaController extends Controller
{
    public function halaman_profile(){
        $provinsi = Provinsi::pluck('name', 'id');
        $kota = Kota::get();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $produk = Produk::get();
        $produkDiPesan = PesananProduk::where('user_id', Auth::user()->id)->get();
        $gambarProduk = GambarProduk::get();
        $buktiTransfer = TransferPembayaran::where('user_id', Auth::user()->id)->get();
        $penilaian = Penilaian::where('user_id', Auth::user()->id)->get();
        $alamat_detail = AlamatPengiriman::where('user_id', Auth::user()->id)->where('alamat_utama', 1)->first();
        return view('Frontend.Profile.profile', compact('provinsi','kota','pesanan', 'produkDiPesan', 'buktiTransfer', 'gambarProduk', 'produk', 'penilaian', 'alamat_detail'));
    }

    public function ubah_data_pelanggan(Request $request, $id){
        // $request->validate([
        //     'email' => 'unique:users',
        // ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        AlamatPengiriman::where('user_id', $id)->update([
            'alamat' => $request->alamat,
            'negara' => "Indonesai",
            'provinsi_id' => $request->provinsi_id,
            'kota_id' => $request->kota_id,
            'nomor_hp' => $request->nomor_hp,
        ]);
        Alert::success('Berhasil Mengubah Data','success');
        return redirect()->route('HalamanProfile');
    }


    public function konfirmasi_terima_pesanan(Request $request){

        $data_id = $request->all();
        Pesanan::where('id', $data_id['id'])->where('user_id', Auth::user()->id)->update([
            'status_pesanan'=>'Pesanan Di Terima'
        ]);

        $statusPesanan = new PesananLogs();
        $statusPesanan->pesanan_id = $data_id['id'];
        $statusPesanan->pesanan_status = "Pesanan Di Terima";
        $statusPesanan->save();
        
        Alert::success('Sukses','Berhasil Konfirmasi Pesanan');
        return redirect()->route('HalamanProfile')->with('success');
    }

    public function pemberian_penilaian(Request $request){
        $penilaian = new Penilaian();
        $penilaian->produk_pesanan_id = $request->produk_pesanan_id;
        $penilaian->produk_id = $request->produk_id;
        $penilaian->user_id = Auth::user()->id;
        $penilaian->bintang = $request->bintang;
        $penilaian->komentar = $request->komentar;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename  = 'Nilai_P'.$request->produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_penilaian/' . $filename);
			Image::make($gambar->getRealPath())->resize(300, 300)->save($path);
			$penilaian->gambar = $filename;
        }
        // echo Session::get('total_keseluruhan');
        PesananProduk::find($request->produk_pesanan_id)->update([
            'status_penilaian'=>1
        ]);

        $penilaian->save();
        Alert::success('Sukses','Berhasil Memberikan Penilaian Pesanan, Terima Kasih');
        return redirect()->back()->with('success');
    }
}
