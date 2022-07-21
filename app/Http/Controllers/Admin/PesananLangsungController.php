<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\ProdukAtribut;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GambarProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PesananLangsungController extends Controller
{
    public function admin_pesan_langsung(){
        $data_produk = Produk::get();
        $data_produk_atribut = ProdukAtribut::get();
        $data_keranjang = Keranjang::where('user_id',Auth::user()->id)->get();
        $data_pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status_pesanan','=','Menunggu Pembayaran')->get();
        $data_produk_pesanan = PesananProduk::where('user_id', Auth::user()->id)->get();
        $data_gambar_produk = GambarProduk::get();
        $data_histori_pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status_pesanan','=','Pembayaran Berhasil')->get();
        return view('Admin.PesananLangsung.pesanan_langsung', compact(
            'data_produk', 'data_produk_atribut', 'data_keranjang', 
            'data_pesanan', 'data_produk_pesanan', 'data_gambar_produk', 'data_histori_pesanan'));
    }

    public function admin_masuk_keranjang(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            $keranjang = new Keranjang;
            $keranjang->user_id = Auth::user()->id;
            $keranjang->session_id = $session_id;
            $keranjang->produk_id = $data['produk_id'];
            $keranjang->ukuran = $data['ukuran'];
            $keranjang->berat = 0;
            if(Produk::tampilDiskon($data['produk_id'])){
                $tampilDiskon = Produk::tampilDiskon($data['produk_id']);
            }else{
                $tampilDiskon = $data['harga'];
            }
            $keranjang->harga = $tampilDiskon;
            $keranjang->kuantitas = $data['kuantitas'];
            $keranjang->save();

            Alert::success('Sukses','Produk Berhasil Dimasukkan Ke Keranjang');
            return redirect()->back()->with('success');

        }
    }
    public function admin_buat_pesanan(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            
            $pesanan = new Pesanan();
            $pesanan->user_id           = Auth::user()->id;
            $pesanan->alamat_id         = 1;
            $pesanan->total_berat       = 0;
            $pesanan->total_bayar       = $data['total_bayar'];
            $pesanan->metode_pembayaran = "Cash";
            $pesanan->ongkos_kirim      = 0;
            $pesanan->pengiriman        = 0;
            $pesanan->resi              = 0;
            $pesanan->status_pesanan    = "Menunggu Pembayaran";
            $pesanan->save();

            $pesanan_id = DB::getPdo()->lastInsertId();

            $isiKeranjang = Keranjang::where('user_id', Auth::user()->id)->get()->toArray();
            foreach ($isiKeranjang as $key=>$item){

                $detailProdukKeranjang = new PesananProduk;
                $detailProdukKeranjang->pesanan_id = $pesanan_id;
                $detailProdukKeranjang->user_id = Auth::user()->id;
                
                $tampilDetailProduk = Produk::select('name')->where('id',$item['produk_id'])->first()->toArray();
                $detailProdukKeranjang->produk_id = $item['produk_id'];
                $detailProdukKeranjang->nama_produk = $tampilDetailProduk['name'];
                $detailProdukKeranjang->ukuran_produk = $item['ukuran'];

                if(Produk::tampilDiskon($item['produk_id'])){
                    $tampilDiskon = Produk::tampilDiskon($item['produk_id']);
                }else{
                    $tampilDiskon = $item['harga'];
                }

                $detailProdukKeranjang->harga_produk = $tampilDiskon;
                $detailProdukKeranjang->kuantitas = $item['kuantitas'];
                $detailProdukKeranjang->save();

                $produkAtribut = ProdukAtribut::where('produk_id', $item['produk_id'])->where('ukuran', $item['ukuran'])->first();
                $produkAtribut['stok'] = $produkAtribut['stok'] - $item['kuantitas'];
                $produkAtribut->update();
            }

            $dataKeranjang = Keranjang::where('user_id', Auth::user()->id)->get();
            Keranjang::destroy($dataKeranjang);
        }
            Alert::success('Sukses','Berhasil Melakukan Pemesanan Produk');
            return redirect()->back();
    }

    public function admin_konfirmasi_pembayaran(Request $request){
        if($request->isMethod('post')){
            foreach($request->id as $key=>$id){
                Pesanan::where('id', $request->id[$key])->update([
                    'status_pesanan'=>'Pesanan Di Terima'
                ]);
            }
        Alert::success('Sukses','Terima Kasih, <br> Pembayaran Berhasil');
        return redirect()->back()->with('success');
        }
    }

    public function getAtribut($id)
    {
        $produkAtribut = ProdukAtribut::where('id', $id)->pluck('ukuran','stok');
        return response()->json($produkAtribut);

        // $produkAtribut = ProdukAtribut::where('id', $id)->pluck('stok');
        // return response()->json([
        //     'data' => $produkAtribut,
        // ]);
    }
}
