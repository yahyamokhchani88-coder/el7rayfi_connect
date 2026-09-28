<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    // هاد السطر هو اللي كيخليك تعمر المدن بلا مشاكل
    protected $fillable = ['name'];

    /**
     * علاقة المدينة مع المستخدمين (الحريفية)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'city', 'name');
    }
}