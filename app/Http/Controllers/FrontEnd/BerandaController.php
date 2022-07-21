<?php

namespace App\Http\Controllers\FrontEnd;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use App\Models\ProdukFavorit;
use App\Http\Controllers\Controller;
use App\Models\Iklan;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function halaman_beranda(){

        // $jumat = Carbon::tomorrow()->locale('id')->subDays(5)->dayName;
        // dd($jumat);

        $diskon = "";
        $hariini = Carbon::now()->locale('id')->dayName;
        if($hariini == "Jumat"){
            $diskon = Produk::select('diskon')->update([
            'diskon'=>10
        ]);
            // return $diskon;
        }
        else {
            $diskon = Produk::select('diskon', 10)->update([
                'diskon'=>0
        ]);
        // return $diskon;
        }

        $kategori = Kategori::paginate(6);
        $gambar_produk = GambarProduk::get();
        $data_produk = Produk::get();
        $data_iklan = Iklan::get();
        $data_slider = Slider::where('tipe', 1)->get();
        // $data_produk = Produk::with('atribut')->get()->toArray();
        // echo "<pre>"; print_r($data_produk); die;
        // $data_produk = Produk::with(['atribut'=>function($query){
        //     $query->select('produk_id');
        // }])->get()->toArray();
        // echo "<pre>"; print_r($data_produk); die;
        $data_atribut = ProdukAtribut::get();
        return view('Frontend.Beranda.beranda', compact('data_produk', 'kategori', 'gambar_produk','data_atribut', 'data_iklan', 'data_slider'))->with('diskon', $diskon);
    }

    public function tambah_ke_produk_favorit(Request $request){
        
        $produk_id = $request->produk_id;
        if(ProdukFavorit::where('user_id', Auth::user()->id)->where('produk_id',$produk_id)->exists()){
            return response()->json(['status'=>'Produk Telah ada di Daftar Produk Favorit']);
        }else{
            $tambah_daftarKeinginan = new ProdukFavorit();
            $tambah_daftarKeinginan->user_id = Auth::user()->id;
            $tambah_daftarKeinginan->produk_id = $produk_id;
            $tambah_daftarKeinginan->save();
            return response()->json(['status'=>'Berhasil Menambahkan Produk ke Produk Favorit']);
        }
    }
    
    public function total_produk_favorit(){
        $total_produk_favorit = ProdukFavorit::where('user_id', Auth::user()->id)->count();
        return response()->json(['totalProdukFavorit' => $total_produk_favorit]);
    }
}
