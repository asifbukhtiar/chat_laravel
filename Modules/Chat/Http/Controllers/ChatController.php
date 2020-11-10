<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Chat\Entities\UserNotifications;
use Modules\SuperAdmin\Entities\ChatRoom;
use Modules\SuperAdmin\Entities\UserProfile;
use Modules\SuperAdmin\Entities\Ads;
use Illuminate\Support\Facades\Redis;
use Sentinel;
use App\User;
use Modules\Chat\Entities\Message;
use Modules\Chat\Entities\PrivateChat;
use Illuminate\Support\Facades\DB;
use Modules\Members\Http\Middleware\MembersMiddleware;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('chat');

    }

    public function index()
    {
            $ads = Ads::where('status', '=', 1)->get();
            return view('chat::chat', compact('ads'));
    }

    public function ownerUser()
    {
        $user = Sentinel::getUser();
        $id = $user->id;
        $ownerUser =  $user
            ->leftJoin('users_profile', 'users_profile.user_id', 'users.id')
            ->select('users.id', 'users.username', 'users_profile.pic')
            ->where('users.id', '=', $id)->get()->toArray();

        return $ownerUser;
    }

    public function getUsers()
    {
        $user = Sentinel::getUser();
        $id = $user->id;
        //$user_pic = UserProfile::find($id);
        $online_users =  $user
        ->leftJoin('users_profile', 'users_profile.user_id', 'users.id')
            ->select('users.id', 'users.username', 'users_profile.pic')
        ->where('users.id', '!=', $id)->get()->toArray();

        return $online_users;
    }


    public function rooms()
    {
        return ChatRoom::all();

    }

    public function send(Request $request)
    {
        $user = Sentinel::getUser();

        $message = $user->messages()->create([
            'message' => $request->body,
            'chatroom_id' => $request->chatroom

        ]);

        Redis::publish('message', json_encode($message));
        return response()->json($message, 200);
    }


    public function fetchMessages()
    {
        //return Message::with('user.user_profile')->get();
        $messages = DB::table('users')
            ->join('messages', 'messages.user_id', '=', 'users.id')
            ->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id')
            ->select('users.id' ,'users.username', 'users_profile.pic', 'messages.*')
            ->get();
        //dd($messages);
        return $messages;
    }

    //specific chat room messages
    public function roomMessages(Request $request)
    {
        $chatid = $request->id;
        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.user_id')
            ->join('users_profile', 'users_profile.user_id', '=', 'messages.user_id')
            ->join('chatroom', 'chatroom.id', '=', 'messages.chatroom_id')
            ->select('users.id','users.username', 'users_profile.pic', 'messages.*')
            ->where('messages.chatroom_id', $chatid)
            ->get();

        return $messages;
    }

    public function privateChat($id)
    {
        $user = Sentinel::getUser();
        $users = UserNotifications::where('from', $user->id)
            ->where('to', $id)->get();
        $username = User::where('id', $id)->get();
        if($users->isEmpty())
        {
            UserNotifications::create([
                'to' => $id,
                'from' => $user->id,
                'type' => 'privatechat',
                'read_status' => 0
            ]);

            return $username;
        }else{
            return $username;
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function privateMessages(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = $user->id;
        $id = $request->id;
        $friend = User::find($id);
        $friend_id = $friend->id;

        $message = PrivateChat::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            'message' => $request->body,
            'status' => '1'
        ]);

        Redis::publish('privatechat', json_encode($message));
        return response()->json($message, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function getprivateMessages($id)
    {
        $user = Sentinel::getUser();
        $user_id = $user->id;
        $chats = PrivateChat::whereIn('user_id', [$user_id, $id])
            ->whereIn('friend_id', [$user_id, $id])
            ->orderBy('created_at', 'asc')->get();

        return $chats;
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function getUserDetails($id)
    {
        $username = User::where('id', $id)->get();

        return $username;
    }

    //accept login
    public function updateStatus($id)
    {
        $user = Sentinel::getUser();

        UserNotifications::where('from', $id)
                ->where('to', $user->id)
                ->where('type', 'privatechat')
                ->update(['read_status' => '1']);

    }
}
