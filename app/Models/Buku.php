<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $keyType = 'string';
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode',
        'kategori_id',
        'judul',
        'penulis',
        'penerbit',
        'th_terbit',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'kode_buku');
    }
}
