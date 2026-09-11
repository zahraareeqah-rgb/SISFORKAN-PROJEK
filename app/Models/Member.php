<?php

namespace App\Models;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'nama_member',
        'foto_member',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'tgl_lahir',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_member');
    }
}
