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

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeLastQueue($query)
    {
        return $query->today()->orderBy('created_at', 'desc');
    }

    public function scopeInline($query)
    {
        return $query->today()->where('queue_status', QueueStatus::INLINE);
    }

    public function scopeProcessing($query)
    {
        return $query->today()->where('queue_status', QueueStatus::CALLED)->orWhere('queue_status', QueueStatus::HANDLED);
    }

    public function scopeDone($query)
    {
        return $query->today()->where('queue_status', QueueStatus::DONE);
    }

    public function scopeAbsent($query)
    {
        return $query->today()->where('queue_status', QueueStatus::ABSENT);
    }

}
