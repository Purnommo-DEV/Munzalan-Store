<?php

namespace App\Http\Controllers\Admin;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class TentangKamiController extends Controller
{
    public function front_tentang_kami(){
        $tentang_kami = TentangKami::first();

        return view('Frontend.TentangKami.tentang_kami', compact('tentang_kami'));
    }

    public function admin_tentang_kami(){
        $tentang_kami = TentangKami::first() ?? new TentangKami();

        return view('Admin.Tentang.tentang_kami', compact('tentang_kami'));
    }

    public function admin_tambah_tentang_kami(Request $request){
        $tambah_tentang_kami = new TentangKami();
        $tambah_tentang_kami->teks = $request->teks;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename  = $gambar->getClientOriginalName();
			$path = public_path('gambar/gambar_tentang_kami/' . $filename);
			Image::make($gambar->getRealPath())->resize(933, 390)->save($path);
			$tambah_tentang_kami->gambar = $filename;
        }
        $tambah_tentang_kami->save();
        Alert::success('Sukses','Berhasil Menambah Tentang Kami');
        return redirect()->back()->with('success');
    }

    public function admin_ubah_tentang_kami(Request $request, $id){
        
        $ubah_tentang_kami = TentangKami::find($id);
        $ubah_tentang_kami->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $path_gambar = 'gambar/gambar_tentang_kami' . $ubah_tentang_kami->gambar;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            $gambar = $request->file('gambar');
            $filename  = 'Kategori_'.$ubah_tentang_kami->gambar.'.'. $gambar->getClientOriginalExtension();
			$path = public_path('gambar/gambar_tentang_kami/' . $filename);
			Image::make($gambar->getRealPath())->resize(200, 200)->save($path);
			$ubah_tentang_kami->gambar = $filename;
        }
        $ubah_tentang_kami->save();
        Alert::success('Sukses','Berhasil Mengubah Tentang Kami');
        return redirect()->back()->with('success');
    }

}

