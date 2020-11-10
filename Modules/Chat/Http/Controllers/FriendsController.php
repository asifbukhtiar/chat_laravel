<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\UserProfile;
use Sentinel;
use App\User;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('chat');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $friends = $user->friends();
        $requests = $user->friendRequests();
        $id = $user->id;
        $user_pic = UserProfile::find($id);

        return view('chat::friends.index', compact('user_pic', 'user', 'friends', 'requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function profile($username)
    {
        $find = User::where('username', $username)->first();
        $id = $find->id;
        $profile = User::with('user_profile')->find($id);

        return view('chat::users.profile', compact('profile'));
    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function addFriend(Request $request)
    {
        $user = Sentinel::getUser();
        $id = $request->id;
        $friend = User::find($id);
        if(!$friend){
            return "User Not Found";
        }

        if(Sentinel::check()) {
            if ($user->hasFriendRequestPending($friend) ||  $friend->hasFriendRequestPending($user))
            {
                return "Friend Request Pending";
            }
        }

        if($user->isFriendWith($friend))
        {
            return "Already Friends";
        }
        $add = $user->addFriend($friend);
        dd($add);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function acceptFriendRequest($id)
    {

        $friend = User::where('id', $id)->first();

        if(!Sentinel::getUser()->hasFriendRequestReceived($friend))
        {
            return redirect()->route('user.friends');
        }

        Sentinel::getUser()->acceptFriendRequest($friend);

        return redirect()->route('user.friends');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->first();

        if(!Sentinel::getUser()->isFriendWith($user))
        {
            return redirect()->back();
        }

        Sentinel::getUser()->unfriend($user);

        return "No More Friends";
    }
}
