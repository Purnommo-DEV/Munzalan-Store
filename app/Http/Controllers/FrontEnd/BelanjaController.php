<?php namespace App\Http\Controllers\FrontEnd;

use App\Models\Produk;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\Penilaian;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BelanjaController extends Controller {

    public function halaman_belanja(Request $permintaan) {

        $gambar_produk=GambarProduk::get();
        $cekStok=ProdukAtribut::get();
        $kategori=Kategori::get();
        $data_slider = Slider::where('tipe', 2)->first();

            if($permintaan->name !=0){
                $cari = $permintaan->name;
                $data_produk = Produk::get();
                foreach($data_produk as $key => $d_produk){
                    $nomor[$key++] = $d_produk->name;
                }
                $jml = count($nomor);
                for($i=0; $i<$jml; $i++){
                    if($cari == $nomor[$i]){
                        ddd("Index-ke-".$i."_Nama-Produk->".$nomor[$i]);
                        $data_produk = Produk::where('name', 'like', "%$cari%")->get();
                        return view('Frontend.Belanja.belanja')->with(compact(
                                'data_produk', 'cekStok', 'gambar_produk', 'kategori', 'data_slider'
                        ));
                    }
                }
                $message = 'Maaf, Produk dengan nama '.$permintaan->name.' Tidak ditemukan';
                session::flash('error_message', $message);
            }else{ 
                $data_produk = Produk::get();
            }
        return view('Frontend.Belanja.belanja')->with(compact(
                'data_produk', 'cekStok', 'gambar_produk', 'kategori', 'data_slider'
            ));
    }

        public function filter_produk(Request $request) {
            if($request->ajax()) {
                $data=$request->all();
                // echo "<pre>"; print_r($data); die;
            }

            if(isset($data['urutan']) && !empty($data['urutan'])) {
                if($data['urutan']=="produk_terbaru") {
                    $data_produk=Produk::orderBy('created_at', 'desc')->get();

                }

                else if($data['urutan']=="produk_a_z") {
                    $data_produk=Produk::orderBy('name', 'asc')->get();

                }

                else if($data['urutan']=="produk_harga_rendah") {
                    $data_produk=Produk::orderBy('harga', 'asc')->get();

                }

                else if($data['urutan']=="produk_harga_tinggi") {
                    $data_produk=Produk::orderBy('harga', 'desc')->get();
                }
            }
            else {
                $data_produk=Produk::get();
            }

            // $data_produk = Produk::orderBy('id', 'DESC')->get();
            $gambar_produk=GambarProduk::get();
            $cekStok=ProdukAtribut::get();
            $kategori=Kategori::get();
            return view('Frontend.Belanja.list_produk')->with(compact('data_produk', 'cekStok', 'gambar_produk', 'kategori'));
        }

        public function filter_kategori(Request $request) {

            $gambar_produk=GambarProduk::get();
            $cekStok=ProdukAtribut::get();
            $kategori=Kategori::get();

            if(isset($request->kategori)){
                $kategori = $request->kategori;
                // dd($kategori);
                $data_produk = Produk::whereIn('kategori_id', explode(',', $kategori))->paginate(6);
                // dd($data_produk);
                // response()->json($data_produk);
                return view('Frontend.Belanja.list_produk')->with(compact('data_produk', 'cekStok', 'gambar_produk', 'kategori'));
            }
            elseif(isset($request->kategori ) == '') {
                $data_produk = Produk::get();
                return view('Frontend.Belanja.list_produk')->with(compact('data_produk', 'cekStok', 'gambar_produk', 'kategori'));
            }
           
        }

        // public function filter_ukuran(Request $request) {

        //     $gambar_produk=GambarProduk::get();
        //     $cekStok=ProdukAtribut::get();
        //     $kategori=Kategori::get();
            
        //     if(isset($request->kategori)){
        //         $kategori = $request->kategori;
        //         // dd($kategori);
        //         $data_produk = Produk::whereIn('kategori_id', explode(',', $kategori))->paginate(6);
        //         // dd($data_produk);
        //         // response()->json($data_produk);
        //         return view('Frontend.Belanja.list_produk')->with(compact('data_produk', 'cekStok', 'gambar_produk', 'kategori'));
        //     }
        //     elseif(isset($request->kategori ) == '') {
        //         $data_produk = Produk::get();
        //         return view('Frontend.Belanja.list_produk')->with(compact('data_produk', 'cekStok', 'gambar_produk', 'kategori'));
        //     }
           
        // }
        public static function tampilDiskon($produk_id) {
            $produkDetail=Produk::select('harga', 'diskon', 'kategori_id') ->where('id', $produk_id)->first()->toArray();
            echo "<pre>";
            print_r($produkDetail);
            die;
        }
    }
