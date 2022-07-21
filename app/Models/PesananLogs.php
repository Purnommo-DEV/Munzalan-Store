<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananLogs extends Model
{
    use HasFactory;

    protected $table = "pesanan_logs";
    protected $guarded = [];
}
