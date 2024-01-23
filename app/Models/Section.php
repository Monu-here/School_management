<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function promotion()
    {
        return $this->belongsTo(StudentPromotion::class);
    }
}
