<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_transaksi', 'pembayaran', 'tanggal_pemberangkatan', 'driver_id', 'vehicle_id', 'customer_id', 'kota_asal_id', 'kota_tujuan_id'
    ];

    protected $with = ['driver', 'vehicle', 'customer', 'kotaAsal', 'kotaTujuan'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function kotaAsal()
    {
        return $this->belongsTo(City::class, 'kota_asal_id', 'id');
    }

    public function kotaTujuan()
    {
        return $this->belongsTo(City::class, 'kota_tujuan_id', 'id');
    }
}
