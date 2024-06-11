<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubjectToTeacher extends Model
{
    use HasFactory;
    public function teacher()
    {
        return  $this->belongsTo(Teacher::class , 'id');
    }
    public function subject()
    {
        return   $this->belongsTo(subject::class);
    }
    public function faculity()
    {
        return   $this->belongsTo(Faculity::class);
    }
    public function class()
    {
        return   $this->belongsTo(Classs::class);
    }
}
