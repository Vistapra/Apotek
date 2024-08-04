<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'produk_transaksi';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function detail_transaksi()
    {
        return $this->hasMany(Detail_transaksi::class);
    }
}
