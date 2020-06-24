<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama', 'nik', 'no_hp', 'email', 'alamat', 'program', 'tanggal_lahir'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
