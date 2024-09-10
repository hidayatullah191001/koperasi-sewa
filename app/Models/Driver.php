<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = "drivers";
    
    protected $fillable = [
        'no_id_card',
        'nik',
        'nama',
        'alamat',
        'tanggal_lahir',
        'umur',
        'agama',
        'status_kawin',
        'jenis_sim',
        'no_telepon', 
        'photo_profile'
    ];
}
