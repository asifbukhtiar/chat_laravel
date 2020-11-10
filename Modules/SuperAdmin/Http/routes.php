<?php

Route::group(['middleware' => 'web', 'prefix' => 'superadmin', 'namespace' => 'Modules\SuperAdmin\Http\Controllers'], function()
{
    Route::get('/', 'SuperAdminController@index');
    Route::get('/userslist', 'SuperAdminController@userList');
    Route::get('/data', 'SuperAdminController@data')->name('users.data');
    Route::get('/register', 'Authentication\AuthenticationController@showRegistrationForm');
    Route::post('/register', 'Authentication\AuthenticationController@register')->name('superadmin.register');

    Route::get('/login', 'Authentication\AuthenticationController@showLoginForm');
    Route::post('/login', 'Authentication\AuthenticationController@login')->name('superadmin.login');
    Route::get('/dashboard', 'SuperAdminController@index')->name('superadmin.dashboard');
    Route::get('/logout', 'Authentication\AuthenticationController@logout');

    //route for creating users
    Route::get('/create', 'SuperAdminController@create')->name('users.create');

    Route::post('/create', 'SuperAdminController@store')->name('create.users');

    Route::get('/show', 'SuperAdminController@data')->name('users.show');

    //show user profile
    Route::get('/viewProfile/{id}', 'UserController@show')->name('users.profile');

    Route::get('/edituser/{user}', 'UserController@edit')->name('users.edit');

    Route::put('/user/{user}', 'UserController@update')->name('update.superadmins');

    Route::get('/destroy/{user_id}', 'UserController@destroy')->name('users.confirm-delete');

    //Roles section
    Route::get('/rolesData', 'RolesController@data')->name('roles.data');

    //View Roles
    Route::get('/rolesView', 'RolesController@index')->name('roles.view');

    //Roles create
    Route::get('/rolesCreate', 'RolesController@create')->name('roles.create');

    //Roles storing
    Route::post('/rolesStore', 'RolesController@store')->name('roles.store');

    //Roles Edit
    Route::get('/rolesEdit/{role_id}', 'RolesController@edit')->name('roles.edit');

    //Roles Update
    Route::put('/roles/{role_id}', 'RolesController@update')->name('roles.update');

    //Roles Delete
    Route::get('/roles/{role_id}', 'RolesController@destroy')->name('roles.confirm-delete');

    //routes for superadmin to create private policies text
    Route::get('/policy', 'PoliciesController@create')->name('policy.create');
    Route::post('/policy', 'PoliciesController@store')->name('policy.store');
    //view policy
    Route::get('/viewPolicy', 'PoliciesController@index')->name('policy.view');
    Route::get('/policyData', 'PoliciesController@data')->name('policy.data');

    //edit and delete routes for policy
    Route::get('/editPolicy/{p_id}', 'PoliciesController@edit')->name('policy.edit');
    Route::put('/policies/{p_id}', 'PoliciesController@update')->name('policy.update');
    Route::get('/deletePolicy/{p_id}', 'PoliciesController@destroy')->name('policy.confirm-delete');

    //updating user password by superadmin
    Route::post('/viewProfile/{user_id}', 'UserController@update_password');

    //user profile verification
    Route::post('/viewProfile/{user_id}', 'SuperAdminController@acceptProfile');

    //softdeletes meaning blocking a user
    Route::get('/blocked', 'UserController@blockedUsers')->name('blocked.users');

    //unblock users
    Route::get('/restore/{user_id}', 'UserController@userRestore')->name('users.restore');

    //checking username
    Route::post('/checkUsername', 'SuperAdminController@checkUsername');

    //user activation
    Route::get('/activate/{userId}/{activationCode}', 'UserController@activateUser')->name('superadmin.activate');

    //chat rooms routes
    Route::resource('chatrooms', 'ChatRoomController');
    Route::get('/delete/{id}', 'ChatRoomController@destroy')->name('chatroom.confirm-delete');

    //auto chat post controller resource
    Route::resource('autochat', 'AutoChatController');
    Route::get('/delete/{id}', 'AutoChatController@destroy')->name('autochat.confirm-delete');

    //routesfor email templates
    Route::resource('emailTemps', 'EmailTemplatesController');
    Route::get('/delete_temps/{id}', 'EmailTemplatesController@destroy')->name('emailTemps.confirm-delete');

    //routes for ads management
    Route::resource('ads', 'AdsController');
});
