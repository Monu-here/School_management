<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'class_id',
        'section'
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
}
