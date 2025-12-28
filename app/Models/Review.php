<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'reviews';

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'puskesmas_id',
        'nama_pengunjung',
        'rating',
        'komentar'
    ];

    /**
     * Relasi ke tabel puskesmas
     * 1 review milik 1 puskesmas
     */
    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class);
    }
}
