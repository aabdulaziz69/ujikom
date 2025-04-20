<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id',
        'bayar_total',
        'total_pajak',
        'total_setelah_pajak',
        'uang_bayar',
        'kembalian',
        'tanggal_transaksi',
    ];


    protected $dates = ['tanggal_transaksi'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke detail transaksi (many)
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
