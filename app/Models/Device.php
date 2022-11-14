<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['user','password','ports_id','ip','local'];

    public function port()
    {
        return $this->hasMany(Port::class,'devices_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'id','device');
    }
}
