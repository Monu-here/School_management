<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculity extends Model
{
    use HasFactory;
    public function teacher(){
        return $this->belongsTo(Teacher::class,);
    }
}
