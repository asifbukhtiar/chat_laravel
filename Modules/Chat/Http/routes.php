<?php
use Illuminate\Support\Facades\Redis;
use Modules\Chat\Events\ChatEvent;

Route::group(['middleware' => 'web', 'prefix' => 'chat', 'namespace' => 'Modules\Chat\Http\Controllers'], function()
{
    Route::get('/', 'ChatController@index');
    Route::get('/loadusers', 'ChatController@getUsers');
    Route::get('/rooms', 'ChatController@rooms');
    Route::get('/messages', 'ChatController@fetchMessages');
    Route::post('/messages', 'ChatController@send');
    Route::post('/roomMessages', 'ChatController@roomMessages');

    //private chat
    Route::get('/private/{id}', 'ChatController@privateChat')->name('private.chat');
    Route::get('/getUsername/{id}', 'ChatController@getUserDetails');
    Route::get('/privateMessages/{id}', 'ChatController@getprivateMessages');
    Route::post('/privateMessages', 'ChatController@privateMessages');
    Route::get('/owner' , 'ChatController@ownerUser');
    Route::get('/updateStatus/{id}', 'ChatController@updateStatus');
    //user profile view
    Route::get('/profile/{username}', 'FriendsController@profile')->name('chat.user.profile');


    //friends Requests
    Route::get('/friends', 'FriendsController@index')->name('user.friends');
    Route::post('/addFriends', 'FriendsController@addFriend');
    Route::get('/chat/acceptRequest/{id}', 'FriendsController@acceptFriendRequest')->name('chat.request');
    Route::post('/destroy', 'FriendsController@destroy');

    //notifications
    Route::get('/notifications/{id}/{type}', 'NotificationsController@send');
    Route::get('/counts', 'NotificationsController@getNotifications');

});
