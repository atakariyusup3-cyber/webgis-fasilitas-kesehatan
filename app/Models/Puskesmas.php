<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Puskesmas extends Model
{
    use HasFactory;

    protected $table = 'puskesmas';

    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude'
    ];

    /**
     * Relasi:
     * 1 Puskesmas punya banyak Review
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
