<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdminResource;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->is_admin) && Auth::user()->is_admin==1)
        { 
            $page_title = 'Admins';
            $admins = Admin::all();
            $message = 'Admin listed successfully.';
            return view('admin.index', compact('page_title','admins'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ],
        [
            'name.required' => 'Please enter the admin name',
            'email.required' => 'Please enter the admin email',
        ]);
        if($data){
            $admin = Admin::create($request->all());
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Admin created successfully!'
        ], 200);
        } else {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findorfail($id);
        return response($admins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ],
        [
            'name.required' => 'Please enter the admin name',
            'email.required' => 'Please enter the admin email',
        ]);
        $admin = Admin::find($id);
        if(!empty($admin)) 
        {
            $admin = AdminService::createUpdate($admin, $request);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Admin Updated successfully!'
        ], 200);
        }
        else
        {
            return response()->json(['error'=>'Please enter form detail.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if(!empty($admin))
        {
            $admin->delete();
            $admin = new AdminResource($admin);
            return response()->json(['status' => 'success', 
            'data' =>[], 
            'message' => 'Admin Deleted successfully!'
        ], 200);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
