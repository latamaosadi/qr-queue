<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $with = ['profile'];
    public function profile()
    {
        return $this->hasOne('App\Profile', 'id', 'profile_id');
    }
}
