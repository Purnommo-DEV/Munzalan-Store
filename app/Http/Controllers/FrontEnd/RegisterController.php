<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Kota;
use App\Models\User;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\AlamatPengiriman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\InputRegisterRequest;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function halaman_register(){
        $provinsi = Provinsi::pluck('name', 'id');
        $kota = Kota::get();
        return view('Frontend.LoginDanRegister.register', compact('provinsi', 'kota'));
    }

    public function tambah_user(InputRegisterRequest $request){
        $tambah_user = new User;
        $tambah_user->name = $request->name;
        $tambah_user->email = $request->email;
        $tambah_user->password = Hash::make($request->password);
        $tambah_user->peran = "USER";
        $tambah_user->terakhir_dilihat = Carbon::now();
        $tambah_user->save();

        $user_id = DB::getPdo()->lastInsertId();
        
        $alamat_user = new AlamatPengiriman();
        $alamat_user->user_id = $user_id;
        $alamat_user->alamat = $request->alamat;
        $alamat_user->alamat = $request->alamat;
        $alamat_user->negara = $request->negara;
        $alamat_user->provinsi_id = $request->provinsi_id;
        $alamat_user->kota_id = $request->kota_id;
        $alamat_user->nomor_hp = $request->nomor_hp;
        $alamat_user->alamat_utama = 1;
        $alamat_user->save();

        Alert::success('Berhasil Mendaftar, <br> <small>Terima Kasih Telah Mendaftar</small>','success');
        return redirect()->route('HalamanLogin');
    }
}
