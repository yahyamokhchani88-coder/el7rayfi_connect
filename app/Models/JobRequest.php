<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    protected $fillable = ['client_id', 'service_id', 'city', 'description', 'min_price', 'max_price', 'lat', 'lng', 'status'];

    public function bids() { return $this->hasMany(Bid::class); }
    public function service() { return $this->belongsTo(Service::class); }
    public function client() { return $this->belongsTo(User::class, 'client_id'); }
}
