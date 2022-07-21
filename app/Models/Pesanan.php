<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = "pesanan";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }   

    public function alamat(){
        return $this->belongsTo(AlamatPengiriman::class, 'alamat_id', 'id');
    }

}
