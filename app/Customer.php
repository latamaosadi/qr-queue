<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function profile()
    {
        return $this->hasOne('App\Profile', 'id', 'profile_id');
    }
}
