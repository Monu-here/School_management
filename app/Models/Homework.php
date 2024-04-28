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
        'techer_id',
        'user_id'
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function user(){
        return $this->belongsTo(User::class);  
    }
}
