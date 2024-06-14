<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    // Mark.php
    protected $fillable = [
        'exam_id', 'student_id', 'subject_id', 'obtained_marks', 'practical_marks', 'total_marks', 'grade', ' exam_type', 'resit', 'repeat',
        'hp',
        'hc',
        'gpa',
        'cgpa'
    ];
    protected $casts = [
        'exam_type' => 'array',
        'resit' => 'array',
        'repeat' => 'array',
        'hp' => 'array',
        'hc' => 'array',
        'gpa' => 'array',
        'cgpa' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function classes()
    {
        return $this->belongsTo(Classs::class,);
    }
    public function section()
    {
        return $this->belongsTo(Section::class,);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    // Mark.php

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
