<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'id_member',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
    public function pinjamanBuku()
{
    return $this->hasMany(PinjamanBuku::class, 'id_peminjaman');
}
}
