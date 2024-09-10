<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'nik', 'nama', 'jenis_kelamin', 'umur', 'alamat', 'photo_ktp', 'no_telephone', 'kota_asal', 'kota_tujuan', 'harga_tiket', 'harga_bagasi', 'keterangan_bagasi'];
    protected $table = 'customers';

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
