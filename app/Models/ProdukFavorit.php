<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukFavorit extends Model
{
    use HasFactory;

    protected $table = "produk_favorit";
    protected $guard = [];

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
