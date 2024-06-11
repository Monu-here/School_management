<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;
    protected $casts = [
        'sub_code' => 'array',
        'credit' => 'array',
        'level' => 'array',
        'pre_requsisites' => 'array',
    ];
    public function faculity()
    {
        return $this->belongsTo(Faculity::class);
    }
    public function classes()
    {
        return $this->belongsTo(Classs::class);
    }
}
