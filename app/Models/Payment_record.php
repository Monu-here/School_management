<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_record extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'amt_paid',
        'ref_no',
        'year',
        'balance',
        'payment_id',
        'paid',
        'amount',
        'status'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classs::class);
    }
    public function payment()
    {
        return  $this->belongsTo(Payment::class);
    }
    protected $casts = [
        'amt_paid' => 'array',
    ];
}
