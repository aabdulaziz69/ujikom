<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    // Di model Transaksi.php
    protected $fillable = [
        'nama_pembeli',
        'jumlah_barang',
        'id',
        'bayar_total',
        'tanggal_transaksi',
    ];



    protected $dates = ['tanggal_transaksi'];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke model Diskon
    // public function diskon()
    // {
    //     return $this->belongsTo(Diskon::class, 'id_diskon', 'id_diskon');
    // }
}
