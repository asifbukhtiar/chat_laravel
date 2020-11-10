<?php

namespace Modules\SuperAdmin\Entities;

use Illuminate\Database\Eloquent\Model;

class AutoChat extends Model
{
    protected $fillable = [
        'chatroom_id',
        'html_code',
        'occurence'
    ];

    protected $table = 'autochat';

    public function chatroom()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
