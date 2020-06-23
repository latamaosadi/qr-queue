<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama', 'nik', 'no_hp', 'email', 'alamat'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
