<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $table = "keranjang";
    protected $guarded = [];

    public static function penggunaKeranjangItem(){
        if(Auth::check()){
            $penggunaKeranjangItem = Keranjang::with([
            'produk'=>function($query){
                $query->select('id','name');
            }])->where('user_id', Auth::user()->id)->get();
        }
        return $penggunaKeranjangItem;
    }

    // public static function gambarProduk(){
    //     if(Auth::check()){
    //         $gambar_produk = Keranjang::where('user_id', Auth::user()->id)->with(['gambar_produk'=>function($query){
    //             $query->select('produk_id', 'gambar1');
    //         }])->get();
    //     }
    //     // dd($gambar_produk);
    //     return $gambar_produk;
    // }

    public function gambar_produk(){
        return $this->belongsTo(GambarProduk::class, 'produk_id', 'produk_id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
