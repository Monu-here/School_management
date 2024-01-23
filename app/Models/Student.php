<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'section_id',
        'parent_email'
        // other fields...
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
        return $this->belongsTo(Section::class, 'section_id','id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'student_id', 'id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
