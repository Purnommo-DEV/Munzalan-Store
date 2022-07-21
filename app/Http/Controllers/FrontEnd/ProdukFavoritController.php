<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Slider;
use App\Models\Kategori;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use App\Models\ProdukFavorit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ProdukFavoritController extends Controller
{
    public function produk_favorit(){
        $kategori = Kategori::paginate(6);
        $gambar_produk = GambarProduk::get();
        $data_favorit = ProdukFavorit::where('user_id', Auth::user()->id)->get();
        $data_atribut = ProdukAtribut::get();
        $data_slider = Slider::where('tipe', 2)->first();
        return view('Frontend.ProdukFavorit.produk_favorit', compact('data_favorit', 'kategori', 'gambar_produk', 'data_atribut', 'data_slider'));
    }

    public function delete_produk_favorit(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // Cek apakah sesuai dengan data yang di Pilih
            // echo "<pre>"; print_r($data); die;
            ProdukFavorit::where('id', $data['cartid'])->delete();
            $kategori = Kategori::paginate(6);
            $gambar_produk = GambarProduk::get();
            $data_favorit = ProdukFavorit::where('user_id', Auth::user()->id)->get();
            $data_atribut = ProdukAtribut::get();
            return response()->json([
                'view'=>(String)View::make('Frontend.ProdukFavorit.list_produk_favorit')
                ->with(compact('data_favorit', 'kategori', 'gambar_produk', 'data_atribut'))
            ]);
        }
    }
    
    public function urutkan_produk_favorit(Request $request) {
        if($request->ajax()) {
            $data=$request->all();
            // echo "<pre>"; print_r($data); die;
        }

        if(isset($data['urutkan']) && !empty($data['urutkan'])) {
            if($data['urutkan']=="produk_terbaru") {
                $data_favorit=ProdukFavorit::with('produk')->orderBy('created_at', 'desc')->get();

            }

            else if($data['urutkan']=="produk_a_z") {
                $data_favorit=ProdukFavorit::with('produk')->orderBy('name', 'asc')->get();

            }

            else if($data['urutkan']=="produk_harga_rendah") {
                $data_favorit=ProdukFavorit::with('produk')->orderBy('harga', 'asc')->get();

            }

            else if($data['urutkan']=="produk_harga_tinggi") {
                $data_favorit=ProdukFavorit::with('produk')->orderBy('harga', 'desc')->get();
            }
        }
        else {
            $data_favorit=ProdukFavorit::with('produk')->get();
        }

        // $data_favorit = Produk::orderBy('id', 'DESC')->get();
        $gambar_produk=GambarProduk::get();
        $cekStok=ProdukAtribut::get();
        $kategori=Kategori::get();
        return view('Frontend.ProdukFavorit.list_produk_favorit')->with(compact('data_favorit', 'cekStok', 'gambar_produk', 'kategori'));
    }
}
