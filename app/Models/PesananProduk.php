<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananProduk extends Model
{
    use HasFactory;

    protected $table = "pesanan_produk";
    protected $guarded = [];

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    
    public function gambarProduk(){
        return $this->belongsTo(GambarProduk::class, 'produk_id', 'produk_id');
    }

    public function pesanan(){
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}
