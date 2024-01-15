<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'subject_id', 'exam_id', 'mark' ,'grade_id'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function subject()
    {
        return $this->belongsTo(subject::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function classes()
    {
        return $this->belongsTo(Classs::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
