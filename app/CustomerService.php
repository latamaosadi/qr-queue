<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomerService extends Authenticatable
{
    protected $fillable = ['name', 'nip', 'email', 'username', 'password', 'status'];

    protected $hidden = ['password'];

    public function customers()
    {
        return $this->hasMany('App\Customers');
    }
}
