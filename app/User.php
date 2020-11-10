<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Chat\Entities\Message;
use Modules\Chat\Entities\PrivateChat;
use Modules\SuperAdmin\Entities\UserProfile;
use Cache;
use Sentinel;
use Carbon\Carbon;

class User extends EloquentUser
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'users';
    protected $fillable = [];
    protected $guarded = ['id'];
    protected $appends = ['userOnline'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getuserOnlineAttribute()
    {
        return $this->isOnline();
    }

//    protected $appends = ['full_name'];
//    public function getFullNameAttribute()
//    {
//        return str_limit($this->first_name . ' ' . $this->last_name, 30);
//    }

    public function getAge(User $user)
    {
        $profile = $this->user_profile()->where('id', $user->id);

    }

    public function country() {
        return $this->belongsTo( Country::class );
    }

    //message relation
    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    //user profile relation
    public function user_profile()
    {
        return $this->hasOne(UserProfile::class);
    }


    //friends management
    public function myFriends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->myFriends()->wherePivot('accepted', true)->get()->
            merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->myFriends()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    public function isFriendWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    //unfriend of delete a friend
    public function unfriend(User $user)
    {
        return $this->friendsOf()->detach($user->id);
    }

    //check inactivity
    public function isOnline()
    {
        return Cache::has('is-user-online-'. $this->id);
    }


}
