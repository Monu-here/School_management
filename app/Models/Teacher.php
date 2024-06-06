<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'cv',
        'name',
        'gender',
        'dob',
        'email',
        'number',
        'address',
        'jd',
        'exp',
        'qual',
        'class_id',
        'section_id',
        'workinghrs',
        'sub',
        'faculity_id'
    ];
    protected $casts = [
        'info' => 'array',
    ];
    public function teacherdailylog()
    {
        return $this->hasMany(TeacherDailyLog::class);
    }


    public function class()
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }

    // public function class()
    // {
    //     return $this->belongsTo(Classs::class, );
    // }
   
    
    

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    // public function classes()
    // {
    //     return $this->belongsTo(Classs::class);
    // }
    public function clasasasass()
    {
        return $this->hasmany(Classs::class);
    }

    // Define the relationship with the Student model through the Class model
    // public function students()
    // {
    //     return $this->hasManyThrough(Student::class, Classs::class, 'id', 'class_id', 'class_id', 'id');
    // }
    public function student()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id')->where('section_id', $this->section_id)->where('faculity_id', $this->faculity_id);
    }

    public function faculity()
    {
        return $this->belongsTo(Faculity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function homeworks()
    {
        return $this->hasMany(ViewHomeworkFromTeacher::class);
    }
}
