<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $with = ['profile'];

    public function profile()
    {
        return $this->hasOne('App\Profile', 'id', 'profile_id');
    }

    public function scopeLastQueue($query)
    {
        return $query->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc');
    }
}
