<?php

namespace Modules\SuperAdmin\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Sentinel;
use Activation;
use Mail;

class AuthenticationController extends Controller
{
    //Login Super Admin
    public function showLoginForm()
    {
        return view('superadmin::authentication.login');
    }

    //login post
    public function login(Request $request)
    {
        if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', 0))){
            return Redirect(route('superadmin.dashboard'));
        }

        return redirect()->back()
            ->with("error", "Either You are not Authenticated or Wrong Crendentials");
    }

    //registeration for super admin
    public function showRegistrationForm()
    {
        return view('superadmin::authentication.register');
    }

    //postRegister for super admin
    public function register(Request $request)
    {
        $user = Sentinel::registerAndActivate($request->except('password_confirm'));

        $role = Sentinel::findRoleBySlug('superadmin');

        $role->users()->attach($user);

        $data = [
            'user_name' => $user->first_name . ' ' . $user->last_name,
            'activationUrl' => route('superadmin.activate', [$user->id, Activation::create($user)->code])
        ];
        // Send the activation code through email
        Mail::to($user->email)
            ->send(new UserCreation($data));

        return redirect('superadmin/dashboard');
    }

    //logout superadmin
    public function logout()
    {
        Sentinel::logout();

        return redirect('superadmin/login');
    }
}
