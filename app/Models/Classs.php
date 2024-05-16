<?php

namespace App\Models;

use App\Http\Controllers\Admin\ViewHomeworkSubmit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    use HasFactory;
    public function viewHomeworkFromTeacher()
    {
        return $this->hasMany(ViewHomeworkFromTeacher::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function StudentPromotion()
    {
        return $this->belongsTo(StudentPromotion::class);
    }
    public  function mark()
    {
        return $this->belongsTo(Mark::class);
    }
}
