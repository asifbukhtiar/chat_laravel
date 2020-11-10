<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class PrivateChat extends Model
{
    protected $fillable = [];

    protected $guarded = [];

    protected $table = 'privatechat';

    protected $appends = ['sender', 'receiver'];


    public function getCreateAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getSenderAttribute()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getReceiverAttribute()
    {
        return User::where('id', $this->friend_id)->first();
    }

}
