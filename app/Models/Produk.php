<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'produk';
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
