<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'city',
        'service_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- العلاقات (Relationships) ---

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function portfolios() {
        return $this->hasMany(Portfolio::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'artisan_id');
    }

    public function receivedRequests() {
        return $this->hasMany(Booking::class, 'artisan_id');
    }

    public function sentRequests() {
        return $this->hasMany(Booking::class, 'client_id');
    }

    // --- الدوال المساعدة (Helpers) ---

    public function averageRating() {
        return $this->reviews()->avg('rating') ?: 5.0;
    }
}