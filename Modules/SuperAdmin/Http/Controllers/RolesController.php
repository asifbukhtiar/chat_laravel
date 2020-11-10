<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use Sentinel;


class RolesController extends Controller
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
        $roles = Sentinel::getRoleRepository();
        return view('superadmin::roles.index', compact('roles'));
    }

    public function data()
    {
        $roles = Sentinel::getRoleRepository()->all();
        return DataTables::of($roles)
            ->addColumn('actions',function($roles) {
                $actions = '<a href='. route('roles.edit', $roles->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit role"></i></a>
                            <a href='. route('roles.confirm-delete', $roles->id) .' data-id="'.$roles->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete role"></i></a>';

                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('superadmin::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name'))
        ])
        ){
            return redirect('/superadmin/rolesCreate')->with('success', 'Successfully created Role');
        }

            return redirect()->back()
                ->with('error', 'Failed to create Role');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('superadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($role_id)
    {
        $roles = Sentinel::findRoleById($role_id);
        return view('superadmin::roles.edit', compact('roles'));

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($role_id, Request $request)
    {
        $roles = Sentinel::findRoleById($role_id);

        $roles->name = $request->get('name');

        if($roles->save())
        {
            return redirect('/superadmin/rolesView')->with('success', "Role Updated Successfully");
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($role_id)
    {
        $role = Sentinel::findRoleById($role_id);

        if($role->delete())
        {
            return redirect('/superadmin/rolesView')->with('success', 'Role Deleted Successfully');
        }

    }
}
