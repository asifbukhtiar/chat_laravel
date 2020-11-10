<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Modules\SuperAdmin\Entities\Countries;
use Modules\Members\Http\Controllers\CountriesController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Mail\UserCreation;
use Yajra\DataTables\DataTables;
use Sentinel;
use App\User;
use Activation;
use Mail;
use URL;

class SuperAdminController extends CountriesController
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Sentinel::check()){
            return view('superadmin::superadmin.dashboard');
        }

        return view('superadmin::authentication.login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function data()
    {
        $users = User::get(['id', 'first_name', 'last_name', 'email']);

        return DataTables::of($users)
            ->addColumn('status',function($user){
                return 'Pending';

            })
            ->addColumn('actions',function($user) {
                $actions = '<a href='. route('users.profile', $user->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('users.edit', $user->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
                    $actions .= '<a href='. route('users.confirm-delete', $user->id) .' data-id="'.$user->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    //show users in list
    public function userList()
    {
        return view('superadmin::users.index');
    }

    public function create()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();
        $countries = $this->countries;
        return view('superadmin::users.create', compact( 'groups', 'countries'));

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'group', 'activate', 'g-recaptcha-response'), $activate);


            //add user to 'User' group
            $role = Sentinel::findRoleById($request->get('group'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if ($request->get('activate')) {
                // Data to be used on the email view
                $data = [
                    'user_name' => $user->first_name . ' ' . $user->last_name,
                    'activationUrl' => route('superadmin.activate', [$user->id, Activation::create($user)->code])
                ];
                // Send the activation code through email
                Mail::to($user->email)
                    ->send(new UserCreation($data));
            }

            return redirect('/superadmin/create')->with('success', 'User Created Successfully');

    }

    //user profile acceptance
    public function acceptProfile(Request $request)
    {
        $id = $request->id;

        $user = Sentinel::findUserById($id);

        $user->verification_status = "1";

        $user->save();
    }

    //check username
    public function checkUsername(Request $request)
    {
        $username = $request->username;

        $check = User::where('username', $username)->first();

        return $check;
    }

}
