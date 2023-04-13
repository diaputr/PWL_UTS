<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_buku',
        'id_anggota',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kode_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
}
