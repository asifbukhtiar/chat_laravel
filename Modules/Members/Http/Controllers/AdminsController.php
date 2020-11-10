<?php

namespace Modules\Members\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Modules\Members\Http\Requests\AdminsRequest;
use Sentinel;
use Activation;
use Modules\Members\Http\Controllers\CountriesController;

class AdminsController extends CountriesController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(User $user)
    {
        if(Sentinel::check())
        {
            $user = Sentinel::getUser();

            $countries = $this->countries;

            return view('members::members.user_account', compact('user', 'countries'));
        }

        return view('members::authentication.login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function usersList()
    {
        $users = User::all();
        return view('members::admins.users', compact('users'));
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(User $admin)
    {
        // Get this user groups
        $userRoles = $admin->getRoles()->pluck('name', 'id')->all();
        // Get a list of all the available groups
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($admin);

        $countries = $this->countries;

        return view('members::admins.edit', compact('admin', 'roles', 'userRoles', 'countries', 'status'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(User $admin, AdminsRequest $request)
    {
        //dd($request->all());
        $admin->update($request->except('pic_file','password','password_confirm','groups','activate'));

        if ( !empty($request->password)) {
            $admin->password = Hash::make($request->password);
        }

        // is new image uploaded?
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            //delete old pic if exists
            if (File::exists($destinationPath . $admin->pic)) {
                File::delete($destinationPath . $admin->pic);
            }
            //save new file path into db
            $admin->pic =url('/').'/uploads/users/'.$safeName;
        }

        //save record
        $admin->save();

        // Get the current user groups
        $userRoles = $admin->roles()->pluck('id')->all();

        // Get the selected groups

        $selectedRoles = $request->get('groups');

        // Groups comparison between the groups the user currently
        // have and the groups the user wish to have.
        $rolesToAdd = array_diff($selectedRoles, $userRoles);
        $rolesToRemove = array_diff($userRoles, $selectedRoles);

        // Assign the user to groups

        foreach ($rolesToAdd as $roleId) {
            $role = Sentinel::findRoleById($roleId);
            $role->users()->attach($admin);
        }

        // Remove the user from groups
        foreach ($rolesToRemove as $roleId) {
            $role = Sentinel::findRoleById($roleId);
            $role->users()->detach($admin);
        }

        // Activate / De-activate user

        $status = $activation = Activation::completed($admin);

        if ($request->get('activate') != $status) {
            if ($request->get('activate')) {
                $activation = Activation::exists($admin);
                if ($activation) {
                    Activation::complete($admin, $activation->code);
                }
            } else {
                //remove existing activation record
                Activation::remove($admin);
                //add new record
                Activation::create($admin);
                //send activation mail
//                $data=[
//                    'user_name' =>$admin->first_name .' '. $admin->last_name,
//                    'activationUrl' => URL::route('activate', [$admin->id, Activation::exists($admin)->code])
//                ];
//                // Send the activation code through email
//                Mail::to($user->email)
//                    ->send(new Restore($data));

            }
        }

        return Redirect::route('admin.edit', $admin)->withInput()->with('error', 'Could Not Update User');

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
