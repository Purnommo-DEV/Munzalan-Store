<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferPembayaran extends Model
{
    use HasFactory;

    protected $table = "transfer_pembayaran";
    protected $guarded = [];
}
