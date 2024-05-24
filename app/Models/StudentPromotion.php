<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPromotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'from_class',
        'from_section',
        'to_class',
        'to_section',
        'from_session',
        'to_session',
        'status',
        'from_faculity',
        'to_faculity'
    ];
    public function fromClass()
    {
        return $this->belongsTo(Classs::class, 'from_class');
    }
    public function fromFaculity()
    {
        return $this->belongsTo(Faculity::class, 'from_faculity','id');
    }
    public function toFaculity()
    {
        return $this->belongsTo(Faculity::class, 'to_faculity','id');
    }

    public function toClass()
    {
        return $this->belongsTo(Classs::class, 'to_class');
    }
    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section', 'id');
    }
    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section', 'id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function faculity()
    {
        return $this->belongsTo(Faculity::class,);
    }
}
