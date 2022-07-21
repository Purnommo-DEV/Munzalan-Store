<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Models\ProdukAtribut;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\InputProdukRequest;

class ProdukController extends Controller
{
    public function admin_halaman_produk(){
        $dataProduk = Produk::get();
        return view('Admin.Produk.produk', compact('dataProduk'));
    }

    public function admin_halaman_tambah_produk(){
        $kategori  = Kategori::get();
        return view('Admin.Produk.tambah_produk', compact('kategori'));
    }

    public function admin_tambah_produk(InputProdukRequest $request){

        // $tes = $request->all();
        // dd($tes);

        $dataProduk = new Produk();
        $dataProduk->name = $request->name;
        $dataProduk->slug = Str::slug($dataProduk->name);
        $dataProduk->deskripsi_singkat = $request->deskripsi_singkat;
        $dataProduk->deskripsi_lengkap = $request->deskripsi_lengkap;
        $dataProduk->harga = $request->harga;
        $dataProduk->diskon = $request->diskon;
        $dataProduk->harga_beli = $request->harga_beli;
        $dataProduk->kategori_id = $request->kategori_id;
        $dataProduk->save();
        $produk_id = DB::getPdo()->lastInsertId();
        
        $gambarProduk = new GambarProduk();
        $gambarProduk->produk_id = $produk_id;

        if ($request->hasFile('gambar1')) {
            $gambar = $request->file('gambar1');
            $filename  = 'Gambar1_ID_'.$produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar1 = $filename;
        }
        if ($request->hasFile('gambar2')) {
            $gambar = $request->file('gambar2');
            $filename  = 'Gambar2_ID_'.$produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar2 = $filename;
        }
        if ($request->hasFile('gambar3')) {
            $gambar = $request->file('gambar3');
            $filename  = 'Gambar3_ID_'.$produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar3 = $filename;
        }
        if ($request->hasFile('gambar4')) {
            $gambar = $request->file('gambar4');
            $filename  = 'Gambar4_ID_'.$produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar4 = $filename;
        }
        if ($request->hasFile('gambar5')) {
            $gambar = $request->file('gambar5');
            $filename  = 'Gambar5_ID_'.$produk_id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar5 = $filename;
        }
        $gambarProduk->save();

        Alert::success('Sukses','Berhasil Menambah Produk');
        return redirect()->route('AdminProduk')->with('success');
    }

    public function admin_halaman_ubah_produk($id){
        $dataProduk = Produk::where('id', $id)->first();
        $gambarProduk = GambarProduk::where('produk_id', $id)->first();
        $kategori = Kategori::get();
        return view('Admin.Produk.ubah_produk', compact('dataProduk', 'gambarProduk', 'kategori'));
    }

    public function admin_ubah_produk(Request $request, $id){
        
        $dataProduk = Produk::where('id', $id)->first();
        $dataProduk->name = $request->name;
        $dataProduk->slug = Str::slug($dataProduk->name);
        $dataProduk->deskripsi_singkat = $request->deskripsi_singkat;
        $dataProduk->deskripsi_lengkap = $request->deskripsi_lengkap;
        $dataProduk->harga = $request->harga;
        $dataProduk->diskon = $request->diskon;
        $dataProduk->harga_beli = $request->harga_beli;
        $dataProduk->kategori_id = $request->kategori_id;
        $dataProduk->save();

        $gambarProduk = GambarProduk::where('produk_id', $id)->first();

        if ($request->hasFile('gambar1')) {
            $path_gambar = 'gambar/gambar_produk' . $gambarProduk->gambar1;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar1');
            $filename  = 'Gambar1_ID_'.$id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar1 = $filename;
        }
        if ($request->hasFile('gambar2')) {
            $path_gambar = 'gambar/gambar_produk' . $gambarProduk->gambar2;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar2');
            $filename  = 'Gambar2_ID_'.$id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar2 = $filename;
        }
        if ($request->hasFile('gambar3')) {
            $path_gambar = 'gambar/gambar_produk' . $gambarProduk->gambar3;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar3');
            $filename  = 'Gambar3_ID_'.$id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar3 = $filename;
        }
        if ($request->hasFile('gambar4')) {
            $path_gambar = 'gambar/gambar_produk' . $gambarProduk->gambar4;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar4');
            $filename  = 'Gambar1_ID_'.$id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar4 = $filename;
        }
        if ($request->hasFile('gambar5')) {
            $path_gambar = 'gambar/gambar_produk' . $gambarProduk->gambar5;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar5');
            $filename  = 'Gambar1_ID_'.$id.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_produk/' . $filename);
			Image::make($gambar->getRealPath())->resize(700, 800)->save($path);
			$gambarProduk->gambar5 = $filename;
        }
        $gambarProduk->save();

        Alert::success('Sukses','Berhasil Mengubah Data Produk');
        return redirect()->route('AdminProduk')->with('success');
    }

    public function admin_detail_produk($id){
        $dataProduk = Produk::where('id', $id)->first();
        $gambarProduk = GambarProduk::where('produk_id', $id)->first();
        $ukuranStokProduk = ProdukAtribut::where('produk_id', $id)->get();
        return view('Admin.Produk.detail_produk', compact('dataProduk', 'gambarProduk', 'ukuranStokProduk'));
    }

    public function admin_tambah_ukuran_produk(Request $request){
        ProdukAtribut::create($request->all());
        Alert::success('Sukses','Berhasil Menambah Ukuran dan Stok Produk');
        return redirect()->back()->with('success');
    }

    public function admin_ubah_ukuran_produk(Request $request, $id){
        $produkAtribut = ProdukAtribut::find($id);
        $produkAtribut->ukuran = $request->ukuran;
        $produkAtribut->berat = $request->berat;
        $produkAtribut->stok = $request->stok;
        $produkAtribut->save();

        Alert::success('Sukses','Berhasil Mengubah Ukuran atau Stok Produk');
        return redirect()->back()->with('success');
    }

    public function admin_hapus_ukuran_produk($id){
        ProdukAtribut::find($id)->delete();

        Alert::success('Sukses','Berhasil Menghapus Ukuran atau Stok Produk');
        return redirect()->back()->with('success');
    }
    
    public function admin_hapus_produk($id){
        Produk::find($id)->delete();

        Alert::success('Sukses','Berhasil Menghapus Produk');
        return redirect()->back()->with('success');
    }
}
