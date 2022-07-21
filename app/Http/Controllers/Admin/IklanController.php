<?php

namespace App\Http\Controllers\Admin;

use App\Models\Iklan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class IklanController extends Controller
{
    public function admin_iklan(){
        $data_iklan = Iklan::get();
        return view('Admin.Iklan.iklan', compact('data_iklan'));
    }

    public function admin_tambah_iklan(Request $request){
        $tambah_iklan = new Iklan();
        $tambah_iklan->teks = $request->teks;
        $tambah_iklan->ukuran = $request->ukuran;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            if($request->ukuran=="277x260") {
                $filename  = 'Iklan_277x260_' .rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_iklan/' . $filename);
                Image::make($gambar->getRealPath())->resize(277, 260)->save($path);
            }
            elseif($request->ukuran=="576x260"){
                $filename  = 'Iklan_576x260'.rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_iklan/' . $filename);
                Image::make($gambar->getRealPath())->resize(576, 260)->save($path);
            }
            $tambah_iklan->gambar = $filename;
        }
        $tambah_iklan->save();
        Alert::success('Sukses','Berhasil Menambah Iklan');
        return redirect()->back()->with('success');
    }

    public function admin_ubah_iklan(Request $request, $id){
        
        $ubah_iklan = Iklan::find($id);
        $ubah_iklan->teks = $request->teks;
        $ubah_iklan->ukuran = $request->ukuran;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $path_gambar = 'gambar/gambar_iklan' . $ubah_iklan->gambar;
            if (File::exists($path_gambar)) {
                File::delete($path_gambar);
            }
            if($request->ukuran=="277x260") {
                $filename  = 'Iklan_277x260_' .rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_iklan/' . $filename);
                Image::make($gambar->getRealPath())->resize(277, 260)->save($path);
            }
            elseif($request->ukuran=="576x260"){
                $filename  = 'Iklan_576x260'.rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_iklan/' . $filename);
                Image::make($gambar->getRealPath())->resize(576, 260)->save($path);
            }
            $ubah_iklan->gambar = $filename;
        }
        $ubah_iklan->save();
        Alert::success('Sukses','Berhasil Mengubah Iklan');
        return redirect()->back()->with('success');
    }

    public function admin_hapus_iklan($id){
        Iklan::find($id)->delete();

        Alert::success('Sukses','Berhasil Menghapus Iklan');
        return redirect()->back()->with('success');
    }
}
