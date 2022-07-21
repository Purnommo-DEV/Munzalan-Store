<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AlamatPengiriman extends Model
{
    use HasFactory;

    protected $table = 'alamat_pengiriman';
    protected $guarded = [];

    public static function alamatPengguna(){
        $alamatPengguna = AlamatPengiriman::where('user_id', Auth::user()->id)->get();
        return $alamatPengguna;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }
    
    public function kota(){
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
