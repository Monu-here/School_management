<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        // other fields...
    ];
    public function Classs()
    {
        $this->belongsTo(Classs::class,);
    }
    public function payment_records()
    {
        $this->belongsTo(Payment_record::class,);
    }
}
