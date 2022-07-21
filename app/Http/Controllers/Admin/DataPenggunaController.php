<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlamatPengiriman;

class DataPenggunaController extends Controller
{
    public function admin_halaman_pengguna(){
        $alamat_pengguna = AlamatPengiriman::where('alamat_utama', 1)->get();
        return view('Admin.Pengguna.pengguna', compact('alamat_pengguna'));
    }

    public function admin_halaman_detail_pengguna($id){
        $detail_pengguna = AlamatPengiriman::where('user_id',$id)->where('alamat_utama', 1)->first();
        return view('Admin.Pengguna.detail_pengguna', compact('detail_pengguna'));
    }
}
