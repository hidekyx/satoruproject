<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = "keranjang";
    protected $primaryKey = 'id_keranjang';
    
    protected $fillable = [
        'id_user',
        'id_item',
        'merk',
        'seri',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
}
