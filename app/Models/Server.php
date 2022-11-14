<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $fillable = ['name','user','pass','port','host','status','ip'];


    public function services()
    {        
        return $this->hasMany(Service::class, 'server', 'id');                         
    }
}
