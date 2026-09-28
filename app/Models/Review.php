<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
 protected $fillable = ['client_id', 'artisan_id', 'rating', 'comment'];

public function client() { return $this->belongsTo(User::class, 'client_id'); }
}
