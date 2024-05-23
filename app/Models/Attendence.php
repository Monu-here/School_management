<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_type',

    ];
    protected $casts = [
        'attendance_type' => 'array',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
