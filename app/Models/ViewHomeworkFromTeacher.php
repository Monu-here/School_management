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
        'teacher_id'
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
