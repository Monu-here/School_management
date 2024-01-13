<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPromotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'from_class',
        'from_section',
        'to_class',
        'to_section',
        'from_session',
        'to_session',
        'status',
    ];
    public function classes()
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
