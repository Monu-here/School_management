<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function StudentPromotion()
    {
        return $this->belongsTo(StudentPromotion::class);
    }
}
