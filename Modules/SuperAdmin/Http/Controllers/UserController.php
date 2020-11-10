<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\Countries;
use Modules\SuperAdmin\Http\Requests\SuperAdminRequest;
use Modules\Members\Http\Controllers\CountriesController;
use Sentinel;
use Activation;
use Hash;
use App\User;
use File;

class UserController extends CountriesController
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function show($id)
    {
        $user = User::with('user_profile')->find($id);
        $countries = $this->countries;
        return view('superadmin::users.show', compact('user', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(User $user)
    {
        // Get this user groups
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();
        // Get a list of all the available groups
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);

        $countries = $this->countries;

        return view('superadmin::users.edit', compact('user', 'countries', 'roles', 'userRoles', 'status'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update_password(Request $request)
    {
        $id = $request->id;

        $user = Sentinel::findUserById($id);

        $user->password = Hash::make($request->get('password'));

        $user->save();
    }

    //updating user by superadmin
    public function update(User $user, SuperAdminRequest $request)
    {
        $user->update($request->except('password','password_confirm','groups','activate'));

        if ( !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        //save record
        $user->save();

        // Get the current user groups
        $userRoles = $user->roles()->pluck('id')->all();

        // Get the selected groups

        $selectedRoles = $request->get('groups');

        // Groups comparison between the groups the user currently
        // have and the groups the user wish to have.
        $rolesToAdd = array_diff($selectedRoles, $userRoles);
        $rolesToRemove = array_diff($userRoles, $selectedRoles);

        // Assign the user to groups

        foreach ($rolesToAdd as $roleId) {
            $role = Sentinel::findRoleById($roleId);
            $role->users()->attach($user);
        }

        // Remove the user from groups
        foreach ($rolesToRemove as $roleId) {
            $role = Sentinel::findRoleById($roleId);
            $role->users()->detach($user);
        }

        if($user->save())
        {
            return redirect('/superadmin/edituser/'.$user->id)->with('success', 'User Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->delete())
        {
            return redirect('/superadmin/userslist')->with('success', 'User Blocked Successfully');
        }
    }

    //getting blocked users
    public function blockedUsers()
    {
        $users = User::onlyTrashed()->get();

        return view('superadmin::superadmin.blocked', compact('users'));
    }

    //unblock user
    public function userRestore($id)
    {
        $user = User::withTrashed()->find($id);

        if($user->restore())
        {
            return redirect('/superadmin/blocked')->with('success', 'User Restored Successfully');
        }


    }

    //user activate
    public function activateUser($userId,$activationCode = null)
    {
        // Is user logged in?
        if (Sentinel::check()) {
            return Redirect::route('superadmin.dashboard');
        }

        $user = Sentinel::findById($userId);
        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code)) {
            // Activation was successful
            // Redirect to the login page
            return Redirect::to('/members/login')->with('success', 'Successfully Activated');
        } else {
            return Redirect::route('/members/login')->with('error', 'Something went wrong');
        }
    }
}
