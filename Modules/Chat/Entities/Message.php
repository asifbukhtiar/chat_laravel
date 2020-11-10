<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\SuperAdmin\Entities\ChatRoom;
use Sofa\Eloquence\Eloquence;
use App\User;

class Message extends Model
{

    use Eloquence;

    protected $fillable = ['message', 'chatroom_id'];


    //user relation to message
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //chat room relation
    public function chatrooms()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
