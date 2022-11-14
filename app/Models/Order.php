<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user','mid','status','service','device','active','payments_id','time'];

    protected $appends = ['statusOn','statusOff','netto'];   

    public function getstatusOffAttribute()
    {                
        if($this->active == null && $this->status != 2)
        {
            return 1;
        }
        else
        {
            return 0;
        }    
    }
    
    public function getnettoAttribute()
    {                
        $tot = $this->services->price*$this->time/30;
        $ppn = ENV('PPN')/100*$tot;
        return $tot+$ppn;
    }

    public function getstatusOnAttribute()
    {                
        if($this->active != null && $this->status == 2)
        {
            return 1;
        }
        else
        {
            return 0;
        }    
    }

    public function services()
    {        
        return $this->hasOne(Service::class, 'id', 'service');                         
    }

    public function devices()
    {        
        return $this->hasOne(Device::class, 'id', 'device');                         
    }

    public function users()
    {        
        return $this->hasOne(User::class, 'id', 'user');                         
    }
}
