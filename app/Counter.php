<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['name', 'ip', 'status'];

    public function customerService()
    {
        return $this->belongsTo('App\CustomerService');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
