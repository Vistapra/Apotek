<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Produk_transaksi()
    {
        return $this->belongsTo(Produk_transaksi::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
