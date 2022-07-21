<?php

use App\Models\Keranjang;
use App\Models\GambarProduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalBarangKeranjang(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalBarangKeranjang = Keranjang::where('user_id', $user_id)->count('kuantitas');
    }else{
        $session_id = Session::get('session_id');
        $totalBarangKeranjang = Keranjang::where('session_id', $session_id)->count('kuantitas');
    }
    return $totalBarangKeranjang;
}