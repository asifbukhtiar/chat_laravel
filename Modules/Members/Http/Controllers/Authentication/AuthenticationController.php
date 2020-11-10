<?php
namespace Modules\Members\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\Policies;
use Modules\SuperAdmin\Mail\UserCreation;
use Sentinel;
use Activation;
use Mail;
use Redirect;

class AuthenticationController extends Controller{
    //Login Members
    public function showLoginForm()
    {
        return view('members::authentication.login');
    }

    //registeration for members
    public function showRegistrationForm()
    {
        $policy = Policies::all();
        return view('members::authentication.register', compact('policy'));
    }

    //login post
    public function postLogin(Request $request)
    {
        if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', 0))){
                return Redirect(route('members.my_account'));
        }
        $request->session()->flash('error', 'Wrong Credentials or Unauthorized Person');

        return redirect()->back()->withInput();
    }



    //postRegister for members
    public function register(Request $request)
    {
        $user = Sentinel::registerAndActivate($request->except('password_confirm'));

        $role = Sentinel::findRoleBySlug('members');

        $role->users()->attach($user);

        // Data to be used on the email view
        $data = [
            'user_name' => $user->first_name . ' ' . $user->last_name,
            'activationUrl' => route('members.activate', [$user->id, Activation::create($user)->code])
        ];
        // Send the activation code through email
        Mail::to($user->email)
            ->send(new UserCreation($data));

        return Redirect(route('members.my_account'));
    }


    //activation
    public function activate($userId, $activationCode = null)
    {
        // Is user logged in?
        if (Sentinel::check()) {
            return Redirect::to('members/login');
        }

        $user = Sentinel::findById($userId);
        $activation = Activation::create($user);

        if (Activation::complete($user, $activation->code)) {
            // Activation was successful
            // Redirect to the login page
            return Redirect::to('members/login')->with('success', trans('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = trans('auth/message.activate.error');
            return Redirect::to('members/login')->with('error', $error);
        }
    }

    //logout members
    public function logout()
    {
        Sentinel::logout();

        return redirect('members/login');
    }
}