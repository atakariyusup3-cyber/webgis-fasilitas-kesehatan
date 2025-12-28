<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apotik extends Model
{
    use HasFactory;

    protected $table = 'apotik';

    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude'
    ];
}
