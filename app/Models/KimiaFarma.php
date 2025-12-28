<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KimiaFarma extends Model
{
    use HasFactory;

    protected $table = 'kimia_farma';

    protected $fillable = [
        'nama',
        'alamat',
        'latitude',
        'longitude'
    ];
}
