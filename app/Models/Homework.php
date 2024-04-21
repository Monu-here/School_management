<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'techer_id'
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
