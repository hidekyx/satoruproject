<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'id_user',
        'pengiriman',
        'alamat',
        'pembayaran',
        'total',
        'status',
        'tanggal_invoice',
        'tanggal_pembayaran',
        'ulasan',
        'rating',
    ];

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
