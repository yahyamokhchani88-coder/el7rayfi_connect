<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bid extends Model
{
    use HasFactory;

    // هاد السطر هو لي كايحل الموشكيل - كانسمحو لهاد الخانات يتعمرو
    protected $fillable = [
        'job_request_id', 
        'artisan_id', 
        'price', 
        'message', 
        'status'
    ];

    /**
     * علاقة المزايدة مع الطلب
     */
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }

    /**
     * علاقة المزايدة مع الحريفي
     */
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }
}