<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = ['nama', 'nik', 'no_hp', 'email', 'alamat', 'program', 'tanggal_lahir'];

    protected $appends = ['avatar'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function getAvatarAttribute()
    {
        return Storage::disk('public')->url("avatar/{$this->nik}.jpg");
    }
}
