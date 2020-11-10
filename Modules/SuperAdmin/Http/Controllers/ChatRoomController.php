<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\ChatRoom;
use Illuminate\Support\Facades\Redirect;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = ChatRoom::all();
        return view('superadmin::chatrooms.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('superadmin::chatrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $room = new ChatRoom;
        $room->name = $request->name;
        $room->num_users = $request->num_users;
        $room->welcome_message = strip_tags($request->welcome_message);
        $room->guest = $request->guest;
        $room->visibility = $request->visibility;

        if($room->save())
        {
            return Redirect::route('chatrooms.create')->with('success', 'Chat Room Created Successfully');
        }

        return Redirect::route('chatrooms.create')->with('error', 'Something went wrong');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($chatroom)
    {
        $chatroom = ChatRoom::find($chatroom);
        return view('superadmin::chatrooms.show', compact('chatroom'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(ChatRoom $chatroom)
    {
        $chatroom = ChatRoom::find($chatroom)->first();
        return view('superadmin::chatrooms.edit', compact('chatroom'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $chatroom)
    {
        $room = ChatRoom::find($chatroom);
        $room->name = $request->name;
        $room->num_users = $request->num_users;
        $room->welcome_message = strip_tags($request->welcome_message);
        $room->guest = $request->guest;
        $room->visibility = $request->visibility;

        if($room->save())
        {
            return redirect('/superadmin/chatrooms')->with('success', 'Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $chatroom = ChatRoom::find($id);

        if($chatroom->delete())
        {
            return redirect('/superadmin/chatrooms')->with('success', 'Deleted Successfully');
        }
    }
}
