<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_type',
        'subject_id',

    ];
    protected $casts = [
        'attendance_type' => 'array',
        'subject_id' =>'array'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }
}
