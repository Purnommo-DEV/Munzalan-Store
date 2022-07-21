<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function admin_halaman_kategori(){
        $data_kategori = Kategori::get();
        return view('Admin.Kategori.kategori', compact('data_kategori'));
    }

    public function admin_tambah_kategori(Request $request){

        $tambah_kategori = new Kategori();
        $tambah_kategori->name = $request->name;
        $tambah_kategori->slug = Str::slug($tambah_kategori->name);
        
        $kategori_id = Str::random(4);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename  = 'Kategori_'.$kategori_id .'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_kategori/' . $filename);
			Image::make($gambar->getRealPath())->resize(200, 200)->save($path);
			$tambah_kategori->gambar = $filename;
        }
        $tambah_kategori->save();
        Alert::success('Sukses','Berhasil Menambah Kategori');
        return redirect()->back()->with('success');
    }

    public function admin_ubah_kategori(Request $request, $id){
        
        $ubah_kategori = Kategori::find($id);
        $ubah_kategori->name = $request->name;
        if ($request->hasFile('gambar')) {
            $path_gambar = 'gambar/gambar_produk' . $ubah_kategori->gambar;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar');
            $filename  = 'Kategori_'.$ubah_kategori->gambar.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_kategori/' . $filename);
			Image::make($gambar->getRealPath())->resize(200, 200)->save($path);
			$ubah_kategori->gambar = $filename;
        }
        $ubah_kategori->save();
        Alert::success('Sukses','Berhasil Mengubah Kategori');
        return redirect()->back()->with('success');
    }

    public function admin_hapus_kategori($id){
        Kategori::find($id)->delete();

        Alert::success('Sukses','Berhasil Menghapus Kategori');
        return redirect()->back()->with('success');
    }
}
