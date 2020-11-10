<?php

namespace Modules\Members\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Members\Http\Requests\UserRequest;
use Modules\Members\Http\Controllers\CountriesController;
use Modules\SuperAdmin\Entities\UserProfile;
use Sentinel;
use Hash;
use App\User;
use File;


class MembersController extends CountriesController
{
    public function __construct()
    {
        $this->middleware('members', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('members::members.home');
    }

    //after successful Login or registration
    public function userAccount(User $user)
    {
        if(Sentinel::check())
        {
            $user = Sentinel::getUser();

            $id = $user->id;

            $profile = UserProfile::find($id);

            $countries = $this->countries;

            return view('members::members.user_account', compact('user', 'countries', 'profile'));
        }

        return view('members::authentication.login');
    }

    public function update(User $user, UserRequest $request)
    {
        $user = Sentinel::getUser();
        $profile = new UserProfile([
            'bio' => $request->bio,
            'dob' => $request->dob,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postal' => $request->postal,
            'hobbies' => $request->hobbies,
            'interests' => $request->interests,
            'languages' => $request->language,
            'religion' => $request->religion,
            'quotations' => $request->quotations,
            'movies' => $request->movies,
            'music' => $request->music,
            'books' => $request->books,
            'shows' => $request->shows
        ]);

        //update values
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'privacy_status' => $request->privacy,
            $request->except('password','pic','password_confirm')
        ]);

        if ($password = $request->get('password')) {
            $user->password = Hash::make($password);
        }
        // is new image uploaded?
        if ($file = $request->file('pic')) {
            $extension = $file->extension()?: 'png';
            $folderName = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists(public_path() . $folderName . $profile->pic)) {
                File::delete(public_path() . $folderName . $profile->pic);
            }
            //save new file path into db
            $profile->pic =url('/').'/uploads/users/'.$safeName;

        }

        if($user->user_profile()->update($profile)){
            return redirect('/members/my_account')->with('success', 'User Updated Successfully');
        }

        return redirect('/members/my_account')->with('error', 'Something Went Wrong');

    }

    //memebers application for verification
    public function verification()
    {
        $user = Sentinel::getUser();

        $user->verification_status = '0';

        if (!in_array($user, session('applied', []))) {
            session()->push('applied', $user);
            $user->apply_count += 1;
            $user->save();

        }

        return redirect('/members/my_account')->with('success', 'Applied for verification');

    }


}
