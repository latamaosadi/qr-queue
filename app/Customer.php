<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $with = ['profile'];

    protected $appends = ['readable_queue'];

    /**
     * Relationship Section
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'id', 'profile_id');
    }

    public function counter()
    {
        return $this->belongsTo('App\Counter');
    }

    /**
     * Accessor
     */
    public function getReadableQueueAttribute()
    {
        return "#" . str_pad($this->queue, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Mutators
     */
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
        return $query->today()->whereIn('queue_status', [QueueStatus::CALLED, QueueStatus::HANDLED]);
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
