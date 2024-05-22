<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewHomeworkFromTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'teacher_id',
        'class_id',
        'section_id',
        'teacher_id'
    ];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    
    public function classs()
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }
    public function student()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id')->where('section_id', $this->section_id);
    }
}
