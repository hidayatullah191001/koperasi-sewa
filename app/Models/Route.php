<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota_asal', 'kota_tujuan', 'harga_tiket', 'harga_carteran', 'jam_pemberangkatan'
    ];

    protected $with = ['asal', 'tujuan'];

    public function asal()
    {
        return $this->belongsTo(City::class, 'kota_asal', 'id');
    }
    public function tujuan()
    {
        return $this->belongsTo(City::class, 'kota_tujuan', 'id');
    }
}
