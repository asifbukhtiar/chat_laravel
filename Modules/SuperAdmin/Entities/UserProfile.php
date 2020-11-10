<?php

namespace Modules\SuperAdmin\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
class UserProfile extends Model
{
    protected $fillable = [];

    protected $guarded = [];

    protected $table = 'users_profile';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
