<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table ="vehicles";

    protected $fillable = [
        'merk', 
        'warna',
        'kapasitas',
        'nomor_polisi',
        'photo_mobil',
        'full_ac',
        'musik'
    ];

    public function files()
    {
        return $this->hasMany(VehicleFile::class);
    }

}
