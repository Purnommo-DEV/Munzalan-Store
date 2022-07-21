<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Produk extends Model
{
    use HasFactory;

    protected $table = "produk";
    protected $guarded = [];

    
    public static function tampilDiskon($produk_id){
        $produkDetail = Produk::select('harga', 'diskon', 'kategori_id')
        ->where('id', $produk_id)->first()->toArray();
        if($produkDetail['diskon']>0){
            $diskon_harga = $produkDetail['harga'] - ($produkDetail['harga']*$produkDetail['diskon']/100);
        }else{
            $diskon_harga = 0;
        }
        return $diskon_harga;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function atribut()
    {
        return $this->hasMany(ProdukAtribut::class);
    }
}
