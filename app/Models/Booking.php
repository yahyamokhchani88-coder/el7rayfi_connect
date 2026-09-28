<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'artisan_id', 'message', 'status'];

public function client() { return $this->belongsTo(User::class, 'client_id'); }
public function artisan() { return $this->belongsTo(User::class, 'artisan_id'); }
}
