<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redis;
use Modules\Chat\Entities\UserNotifications;
use Sentinel;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function send($id, $type)
    {
        $from = Sentinel::getUser();
        UserNotifications::create([
            'from' => $from->id,
            'to'   => $id,
            'type' => $type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getNotifications()
    {
        $to_user = Sentinel::getUser();
        $id = $to_user->id;

        $data = UserNotifications::where('to', $id)
            ->where('read_status', NULL)
        ->get();
            //dd($data);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('chat::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('chat::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
