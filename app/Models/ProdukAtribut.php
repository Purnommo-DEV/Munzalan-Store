<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAtribut extends Model
{
    use HasFactory;

    protected $table = "produk_atribut";
    protected $guarded = [];
}
