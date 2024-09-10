<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VehicleFile extends Model
{
    use HasFactory;
    
    protected $table = 'vehicle_files';

    protected $fillable = ['vehicle_id', 'file_name', 'file_path', 'mime_type', 'size'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function getUrl()
    {
        return url($this->file_path);
    }
}
