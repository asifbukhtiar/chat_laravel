<?php

namespace Modules\Members\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Modules\SuperAdmin\Entities\UserProfile;
use Exception;
use Socialite;
use Redirect;
use Sentinel;

class FacebookAuthController extends Controller
{
    public function redirectToProvider()
    {
       return Socialite::driver('facebook')->redirect();


    }

    public function handleProviderCallback()
    {

        try {
            $user = Socialite::driver('facebook')->user();

        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
        $array = User::withTrashed()->where([
            ['email', '=', $user->email],
            ['deleted_at', '!=', null]
        ])->get();
        return $array->isEmpty()
            ? $this->findOrCreateUser($user, 'facebook')
            : $this->sendFailedResponse("You are banned.");
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect('/members/login')->with(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        //dd($providerUser);
        $name = $providerUser->name;
        $splitName = explode(' ', $name);
        $first_name = '';
        $last_name = $splitName[count($splitName) - 1];
        for ($i = 0; $i <= count($splitName) - 2; $i++) {
            $first_name = $first_name . $splitName[$i] . ' ';
        }
        // check for already has account
        $user = User::where('email', $providerUser->email)->first();

        // if user already found
        if (!$user) {
            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'gender' => '',
                'username' => $providerUser->nickname,
                'email' => $providerUser->email,
                'provider' => $provider,
                'provider_id' => $providerUser->id
            ]);

            $profile = new UserProfile([
                'pic' => $providerUser->avatar,
            ]);

            $user->user_profile()->save($profile);

            $role = Sentinel::findRoleByslug('members');

            if ($role) {
                $role->users()->attach($user);
            }

            if (Activation::completed($user) == false) {

                $activation = Activation::create($user);
                Activation::complete($user, $activation->code);

            }
        }


            if (Sentinel::authenticate($user)) {
                return redirect("/members/my_account")->with('success', 'Please update Password');
            }

        return redirect('/members/login')->withInput()->withErrors('error', 'Something went wrong');


    }
}
