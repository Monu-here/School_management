<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubjectToTeacher extends Model
{
    use HasFactory;
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function subject()
    {
        return   $this->belongsTo(subject::class);
    }
   
}
