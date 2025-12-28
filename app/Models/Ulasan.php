<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Nama tabel (default = 'ulasans', tapi kita pakai 'ulasan')
    protected $table = 'ulasan';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'fasilitas_id',
        'jenis_fasilitas',
        'nama_pengguna',
        'komentar'
    ];
}
