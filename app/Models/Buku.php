<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $keyType = 'string';
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode',
        'judul',
        'kategori',
        'penulis',
        'penerbit',
        'th_terbit',
    ];
}
