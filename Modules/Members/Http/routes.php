<?php

Route::group(['middleware' => 'web', 'prefix' => 'members', 'namespace' => 'Modules\Members\Http\Controllers'], function()
{
    Route::get('/', 'MembersController@index');
    Route::get('/login', 'Authentication\AuthenticationController@showLoginForm');
    Route::post('/login', 'Authentication\AuthenticationController@postLogin')->name('members.login');

    //facebook authentication
    Route::get('/facebook', 'FacebookAuthController@redirectToProvider');
    Route::get('/facebook/callback', 'FacebookAuthController@handleProviderCallback');
    //route for members registration
    Route::get('/register', 'Authentication\AuthenticationController@showRegistrationForm')->name('members.register');
    Route::post('/register', 'Authentication\AuthenticationController@register')->name('members.register');

    Route::get('/my_account', 'MembersController@userAccount')->name('members.my_account');

    //members logout
    Route::get('/logout', 'Authentication\AuthenticationController@logout');

    //members forgot password
    Route::get('/forgot-password', 'Authentication\ForgotPasswordController@forgotPassword')->name('members.forgot-password');

    Route::post('/forgot-password', 'Authentication\ForgotPasswordController@postForgotPassword')->name('members.forgot-password-confirm');

    //get reset code
    Route::get('/reset/{userId}/{resetCode}', 'Authentication\ForgotPasswordController@resetPassword')->name('members.reset-password');
    Route::post('/reset/{userId}/{resetCode}', 'Authentication\ForgotPasswordController@postResetPassword')->name('members.password-confirm');

    //activate user account
    Route::get('/activate/{userId}/{activationCode}', 'Authentication\AuthenticationController@activate')->name('members.activate');

    //updating user profile
    Route::put('/my_account', 'MembersController@update')->name('user.update');

    //members application for verfication
    Route::get('/verification', 'MembersController@verification')->name('users.verification');

    //admins dashboards
    Route::get('/admin', 'AdminsController@index');

    //users for admins to edit
    Route::get('/userlist', 'AdminsController@usersList')->name('admin.users.list');
    Route::resource('admins', 'AdminsController');
});
