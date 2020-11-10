<?php

namespace Modules\Members\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Members\Http\Requests\ForgotRequest;
use Modules\Members\Http\Requests\PasswordResetRequest;
use Modules\Members\Mail\ForgotPassword;
use App\user;
use stdClass;
use Sentinel;
use Mail;
use Reminder;
use Activation;
use Redirect;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('members::authentication.forgot-password');
    }

    //getting email to send code
    public function postForgotPassword(ForgotRequest $request)
    {
        $data = new stdClass();

        try {
            // Get the user password recovery code
            $user = Sentinel::findByCredentials(['email' => $request->get('email')]);

            if (!$user) {
                return back()->with('error', 'Email Not Found');
            }
            $activation = Activation::completed($user);
            if(!$activation){
                return back()->with('error', 'Account Not Activated');
            }
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view

            $data->user_name = $user->first_name .' ' .$user->last_name;
            $data->forgotPasswordUrl = route('members.reset-password', [$user->id, $reminder->code]);

            // Send the activation code through email

            Mail::to($user->email)
                ->send(new ForgotPassword($data));

        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return back()->with('success', 'Success');
    }

    //reset confirmation
    public function resetPassword($userId, $resetCode = null)
    {
        // Find the user using the password reset code
        if(!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('members.forgot-password')->with('error', 'User Not Found');
        }
        if($reminder = Reminder::exists($user)) {
            if($resetCode == $reminder->code) {
                return view('members::authentication.reset-password', compact(['userId', 'resetCode']));
            } else{
                return 'code does not match';
            }
        } else {
            return 'does not exists';
        }

    }

    //post reset password
    public function postResetPassword(PasswordResetRequest $request, $userId, $passwordResetCode = null)
    {
        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::to('members/login')->with('error', 'Error');
        }

        // Password successfully reseted
        return Redirect::to('members/login')->with('success', 'Successfully Changed your password');
    }
}
