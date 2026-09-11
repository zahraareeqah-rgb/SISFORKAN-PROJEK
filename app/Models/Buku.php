<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class buku extends Model
{
    //
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
        'nama_buku',
        'pengarang',
        'foto_buku',
        'ISBN',
        'id_kategori',
        'stok',
    ];

    public function kategori()
    {
    return $this->belongsTo(Kategori::class, 'id_kategori');
    }

     public function peminjaman()
    {
    return $this->hasMany(Kategori::class, 'id_kategori');
    }
}
