<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'dob',
        'roll',
        'class_id',
        'number',
        'address',
        'blood_id',
        'reli',
        'email',
        'email',
        'section_id',
        'session_year',
        'parent_email',
        'f_name',
        'section',
        'f_occ',
        'f_no',
        'm_name',
        'm_occ',
        'idno',  
        'm_no',
        'f_image',
        'm_image',
        'image',
        'user_id'
    ];

    // Student model
    public function classes()
    {
        return $this->belongsTo(Classs::class, 'class_id');
    }
    // public function section() {
    //     return $this->belongsTo()
    // }

    public function paymentRecords()
    {
        return $this->hasMany(Payment_record::class, 'student_id');
    }
    public function blood()
    {
        return $this->belongsTo(Blood::class);
    }
    public function StudentPromotion()
    {
        return $this->belongsTo(StudentPromotion::class);
    }
    // Student.php
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'student_id', 'id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
