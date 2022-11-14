<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name','lay','price', 'status','cat','server','remote'];

    protected $appends = ['pool'];   

    public function ser()
    {                 
        return $this->belongsTo(Server::class, 'server', 'id');               
    }

    public function getpoolAttribute()
    {                

        return pool($this->server,$this->remote,$this->id);
    }
    
}
