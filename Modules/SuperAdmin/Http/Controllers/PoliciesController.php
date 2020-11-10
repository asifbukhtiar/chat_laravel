<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use Modules\SuperAdmin\Entities\Policies;

class PoliciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function data()
    {
        $policies = Policies::get(['id', 'description']);
        return DataTables::of($policies)
            ->addColumn('actions',function($policies) {
                $actions = '<a href='. route('policy.edit', $policies->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit policy"></i></a>
                            <a href='. route('policy.confirm-delete', $policies->id) .' data-id="'.$policies->id.'" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete policy"></i></a>';

                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function index()
    {
        return view('superadmin::policy.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('superadmin::policy.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $check = Policies::create([
            'description' => strip_tags($request->description)
        ]);
        if($check)
        {
            return redirect('/superadmin/policy')->with('success', 'Policy Created Successfully');
        }
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
    public function edit($p_id)
    {
        $policies = Policies::where('id', "=", $p_id)->get()->first();
        return view('superadmin::policy.edit', compact('policies'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($p_id, Request $request)
    {
        $policy = Policies::find($p_id);

        $policy->description = $request->description;

        if($policy->save())
        {
            return redirect('/superadmin/viewPolicy')->with('success', 'Policy Update Successfully');
        }

        return redirect('/superadmin/viewPolicy')->with('error', 'Something Went Wrong');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($p_id)
    {
        $policy = Policies::find($p_id);

        if($policy->delete())
        {
            return redirect('/superadmin/viewPolicy')->with('success', 'Policy Deleted Successfully');
        }
    }
}
