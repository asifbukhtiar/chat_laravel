<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    protected $fillable = [
        'from', 'to', 'type'
    ];

    protected $appends = ['NotifyCounts'];

    protected $table = 'notifications';

    public function getNotifyCountsAttribute()
    {
        return UserNotifications::where('to', $this->to)
            ->where('read_status', NULL)
            ->count();
    }
}
