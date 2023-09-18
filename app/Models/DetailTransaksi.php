<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = "detail_transaksi";
    protected $primaryKey = 'id_detail_transaksi';
    public $timestamps = false;
    
    protected $fillable = [
        'id_transaksi',
        'id_item',
        'merk',
        'seri',
        'foto_hasil',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
}
