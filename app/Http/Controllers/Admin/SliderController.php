<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function admin_slide(){
        $data_slide = Slider::get();
        return view('Admin.Slide.pengaturan_slide', compact('data_slide'));
    }

    public function admin_tambah_slide(Request $request){
        $tambah_slide = new Slider();
        $tambah_slide->teks = $request->teks;
        $tambah_slide->tipe = $request->tipe;


        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            if($request->tipe=="1") {
                $filename  = 'Gambar_Slider1_' .rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_slider/' . $filename);
                Image::make($gambar->getRealPath())->resize(1920, 560)->save($path);
            }
            elseif($request->tipe=="2"){
                $filename  = 'Gambar_Slider2_'.rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_slider/' . $filename);
                Image::make($gambar->getRealPath())->resize(1920, 170)->save($path);
            }
            $tambah_slide->gambar = $filename;
        }
        $tambah_slide->save();
        Alert::success('Sukses','Berhasil Menambahkan Slider');
        return redirect()->back()->with('success');
    }

    public function admin_ubah_slide(Request $request, $id){
        $ubah_slider = Slider::find($id);
        $ubah_slider->teks = $request->teks;
        $ubah_slider->tipe = $request->tipe;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            if($request->tipe=="1") {
                $filename  = 'Gambar_Slider1_' .rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_slider/' . $filename);
                Image::make($gambar->getRealPath())->resize(1920, 560)->save($path);
            }
            elseif($request->tipe=="2"){
                $filename  = 'Gambar_Slider2_'.rand(1000, 100000).'.'. $gambar->getClientOriginalExtension();
                $path = public_path('gambar/gambar_slider/' . $filename);
                Image::make($gambar->getRealPath())->resize(1920, 170)->save($path);
            }
            $ubah_slider->gambar = $filename;
        }
        $ubah_slider->save();
        Alert::success('Sukses','Berhasil Mengubah Slider');
        return redirect()->back()->with('success');
    }

    public function admin_hapus_slide($id){
        Slider::where('id', $id)->delete();
        
        Alert::success('Sukses','Berhasil Menghapus Slider');
        return redirect()->back()->with('success');
    }
}
