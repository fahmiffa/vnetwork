<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forgot extends Model
{
    protected $fillable = ['random','user_id','exp'];
    use HasFactory;
}
