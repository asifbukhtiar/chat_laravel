<?php

namespace Modules\SuperAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\SuperAdmin\Entities\EmailTemplates;
use PharIo\Manifest\Email;

class EmailTemplatesController extends Controller
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
        $data = EmailTemplates::all();
        return view('superadmin::emailTemplates.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('superadmin::emailTemplates.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $temps = new EmailTemplates([
            'title' => $request->title,
            'body' =>  strip_tags($request->body)
        ]);
        //$temps = $request->all();
        if ($file = $request->file('pic')) {
            $extension = $file->extension() ? : 'png';
            $folderName = '/uploads/logos/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $temps->logo = url('/') . '/uploads/logos/' . $safeName;
        }

        if($temps->save())
        {
            return redirect('superadmin/emailTemps/create')->with('success', 'Successfully Created');
        }

    }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $temps = EmailTemplates::find($id);
        return view('superadmin::emailTemplates.edit', compact('temps'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $emailTemp)
    {
        $temps = EmailTemplates::find($emailTemp);

        //$temps = $request->all();
        if ($file = $request->file('pic')) {
            $extension = $file->extension() ? : 'png';
            $folderName = '/uploads/logos/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $temps->logo = url('/') . '/uploads/logos/' . $safeName;
        }
            $check = $temps->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
        if($check)
        {
            return view('superadmin::emailTemplates.edit', compact('temps'))->with('success', 'Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $temps = EmailTemplates::find($id);

        if($temps->delete()){
            return redirect('superadmin/emailTemps')->with('success', 'Deleted Successfully');
        }

        return redirect('superadmin/emailTemps')->with('error', 'Error Deleting');
    }
}
