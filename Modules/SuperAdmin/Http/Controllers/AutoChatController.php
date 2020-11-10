<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\ChatRoom;
use Modules\SuperAdmin\Entities\AutoChat;
use Illuminate\Support\Facades\Redirect;

class AutoChatController extends Controller
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
        $ads = ChatRoom::with('autochat')->get();
        $data = json_decode($ads);
        return view('superadmin::autochat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $chatroom = ChatRoom::all();
        return view('superadmin::autochat.create', compact('chatroom'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        AutoChat::create([
            'chatroom_id' => $request->chatroom_id,
            'html_code' => $request->code,
            'occurence' => $request->occurence
        ]);

        return Redirect::route('autochat.create')->with('success', 'Ad Post Created Successfully');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('superadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($autochat)
    {
        $autochat = AutoChat::find($autochat);
        $chatroom = ChatRoom::all();
        return view('superadmin::autochat.edit', compact('autochat', 'chatroom'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $autochat)
    {
        $autochat = AutoChat::find($autochat);

        $autochat->chatroom_id = $request->chatroom_id;
        $autochat->html_code = $request->code;
        $autochat->occurence = $request->occurence;

        if($autochat->save())
        {
            return Redirect::route('autochat.edit', $autochat)->with('success', 'Update Successfully');
        }

        return Redirect::route('autochat.edit', $autochat)->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($autochat)
    {
        $autochat = AutoChat::find($autochat);

        if($autochat->delete())
        {
            return redirect('superadmin/autochat')->with('success', 'Deleted Successfully');
        }

        return redirect('superadmin/autochat')->with('error', 'Something went wrong');
    }
}
