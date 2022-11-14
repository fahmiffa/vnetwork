<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = ['port','devices_id','dstPort'];


    public function device()
    {
        return $this->belongsTo(Device::class,'devices_id','id');
    }

    public function orderPort()
    {
        return $this->hasOne(orderPort::class,'ports_id','id');
    }
    
}
