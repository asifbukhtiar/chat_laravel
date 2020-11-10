<?php

namespace Modules\SuperAdmin\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Chat\Entities\Message;


class ChatRoom extends Model
{
    protected $fillable = [];

    protected $guarded = [];

    protected $table = 'chatroom';


    public function autochat()
    {
        return $this->hasMany(AutoChat::class, 'chatroom_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
