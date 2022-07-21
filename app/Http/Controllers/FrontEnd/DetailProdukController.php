<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DetailProdukController extends Controller
{
    // public $slug;
    
    // public function mount($slug){
    //     $this->slug = $slug;
    // }

    public function halaman_detail_produk($slug){
        $detail_produk = Produk::where('slug', $slug)->first();
        $gambar_produk = GambarProduk::where('produk_id', $detail_produk->id)->first();
        $populer_produk = Produk::inRandomOrder()->limit(4)->get();
        $terkait_produk = Produk::where('kategori_id', $detail_produk->kategori_id)->inRandomOrder()->limit(5)->get();
        $produk_atribut = ProdukAtribut::where('produk_id', $detail_produk->id)->get();
        $hitungPenilaian = Penilaian::where('produk_id', $detail_produk->id)->count();
        $tampilPenilaian = Penilaian::where('produk_id', $detail_produk->id)->get();
        return view('Frontend.DetailProduk.detail_produk', compact('detail_produk','populer_produk', 
        'terkait_produk', 'produk_atribut', 'gambar_produk', 'hitungPenilaian', 'tampilPenilaian'));
    }

    // public function tampilProdukHarga(Request $request){
    //     if($request->ajax()){
    //         $data = $request->all();
    //         $tampilProdukHarga = ProdukAtribut::where([
    //             'produk_id'=>$data['produk_id'], 
    //             'ukuran'=>$data['ukuran'],
    //         ])->first();
    //         echo $tampilProdukHarga->harga;
    //     }
    // }

    public function tampilProdukStok(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $tampilProdukStok = ProdukAtribut::where([
                'produk_id'=>$data['produk_id'], 
                'ukuran'=>$data['ukuran'],
            ])->first();
            echo $tampilProdukStok->stok;
        }
    }

    public function tampilBerat(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $tampilBerat = ProdukAtribut::where([
                'produk_id'=>$data['produk_id'], 
                'ukuran'=>$data['ukuran'],
            ])->first();
            echo $tampilBerat->berat;
        }
    }

    public function tambah_ke_keranjang(Request $request){
        // $tambah = Keranjang::create($request->all());
        // return view('Frontend.Keranjang.keranjang');
        if($request->isMethod('post')){
            $data = $request->all();
            
            $tampilStokProduk = ProdukAtribut::where([
                'produk_id'=>$data['produk_id'], 
                'ukuran'=>$data['ukuran']
                ])->first()->toArray();
            if($tampilStokProduk['stok'] < $data['kuantitas']){
                $pesan = "Stok Melebihi Batas";
                session::flash('error_message', $pesan);
                return redirect()->back();
            }
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            $hitungProduk = Keranjang::where([
                'user_id'=>Auth::user()->id,
                'produk_id'=>$data['produk_id'],
                'ukuran'=>$data['ukuran']])->count();
            if($hitungProduk>0){
                $message = "Produk Telah ada di Keranjang";
                session::flash('error_message', $message);
                return redirect()->back();
            }
            $keranjang = new Keranjang;
            $keranjang->user_id = $data['user_id'];
            $keranjang->session_id = $session_id;
            $keranjang->produk_id = $data['produk_id'];
            $keranjang->ukuran = $data['ukuran'];
            $keranjang->berat = $data['berat'];
            if(Produk::tampilDiskon($data['produk_id'])){
                $tampilDiskon = Produk::tampilDiskon($data['produk_id']);
            }else{
                $tampilDiskon = $data['harga'];
            }
            $keranjang->harga = $tampilDiskon;
            $keranjang->kuantitas = $data['kuantitas'];
            $keranjang->save();

            $message = "Produk Berhasil di Tambahkan ke Keranjang";
            session::flash('success_message', $message);
            return redirect()->back();
        }
    }
}
