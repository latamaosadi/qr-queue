<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CustomerService extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'nip', 'email', 'username', 'password', 'status'];

    protected $hidden = ['password'];

    public function customers()
    {
        return $this->hasMany('App\Customers');
    }
}
