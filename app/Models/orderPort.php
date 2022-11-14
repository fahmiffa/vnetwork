<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderPort extends Model
{
    use HasFactory;

    
    protected $fillable = ['ports_id','nom','invMid','status'];

    protected $appends = ['price'];  
    
    public function port()
    {
        return $this->belongsTo(Port::class,'ports_id','id');
    }


    public function getpriceAttribute()
    {                
        $tot = 5000;
        $ppn = ENV('PPN')/100*$tot;
        return $tot+$ppn;
    }

}
