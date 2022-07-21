<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Keranjang;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class KeranjangController extends Controller
{
    public function halaman_keranjang(){
        $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
        $hitungDataKeranjang = Keranjang::penggunaKeranjangItem()->count();
        // $gambar_produk = Keranjang::gambarProduk();
        $gambar_produk = GambarProduk::get();
        // $keranjangBerat = Keranjang::all();
        
        // $totalBerat = 0;
        // foreach ($keranjangBerat as $key => $keranjangBerats){
        //     $totalBerat += $keranjangBerats->berat * $keranjangBerats->kuantitas;
        // }
        // dd($totalBerat);
        // echo "<pre>"; print_r($penggunaKeranjangItem);
        return view('Frontend.Keranjang.keranjang', compact('penggunaKeranjangItem', 'gambar_produk', 'hitungDataKeranjang'));
    }


    public function update_kuantitas_barang_keranjang(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Tampil Detail Keranjang
            $detailKeranjang = Keranjang::find($data['cartid']);
            
            // Tampil Ketersediaan Stok Produk
            $stokTersedia = ProdukAtribut::select('stok')->where([
                'produk_id'=>$detailKeranjang['produk_id'], 
                'ukuran'=>$detailKeranjang['ukuran']])->first()->toArray();

            // echo "Diminta",$data['kts']; 
            // echo "<br>";
            // echo "Tersedia".$stokTersedia['stok']; die;

            // Cek Stok tersedia atau tidak
            if($data['kts'] > $stokTersedia['stok']){
                $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
                $gambar_produk = GambarProduk::get();
                return response()->json([
                    'status'=>false,
                    'view'=>(String)View::make('Frontend.Keranjang.isiKeranjang')
                    ->with(compact('penggunaKeranjangItem','gambar_produk'))
                ]);
            }

            // Cek Ukuran tersedia atau tidak
            $ukuranTersedia = ProdukAtribut::where(['produk_id'=>$detailKeranjang['produk_id'],'ukuran'=>$detailKeranjang['ukuran']])->count();
            if($ukuranTersedia==0){
                $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
                $gambar_produk = GambarProduk::get();
                return response()->json([
                    'status'=>false,
                    'message'=>'Ukuran Produk tidak Tersedia',
                    'view'=>(String)View::make('Frontend.Keranjang.isiKeranjang')
                    ->with(compact('penggunaKeranjangItem','gambar_produk'))
                ]);
            }

            Keranjang::where('id', $data['cartid'])->update(['kuantitas'=>$data['kts']]);
            $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
            $gambar_produk = GambarProduk::get();
            $hitungDataKeranjang = Keranjang::penggunaKeranjangItem()->count();
            return response()->json([
                'status'=>true,
                'view'=>(String)View::make('Frontend.Keranjang.isiKeranjang')
                ->with(compact('penggunaKeranjangItem','gambar_produk', 'hitungDataKeranjang'))
            ]);
        }
    }

    public function delete_barang_keranjang(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // Cek apakah sesuai dengan data yang di Pilih
            // echo "<pre>"; print_r($data); die;
            Keranjang::where('id', $data['cartid'])->delete();
            $penggunaKeranjangItem = Keranjang::penggunaKeranjangItem();
            $hitungDataKeranjang = Keranjang::penggunaKeranjangItem()->count();
            $gambar_produk = GambarProduk::get();
            $VariabelTotalBarangKeranjang = totalBarangKeranjang();
            return response()->json([
                'AmbilDataTotalBarangKeranjang'=> $VariabelTotalBarangKeranjang,
                'view'=>(String)View::make('Frontend.Keranjang.isiKeranjang')
                ->with(compact('penggunaKeranjangItem', 'hitungDataKeranjang', 'gambar_produk'))
            ]);
        }
    }
}
