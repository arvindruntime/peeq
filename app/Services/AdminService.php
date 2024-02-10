<?php

namespace App\Services;

use App\Models\Admin;

class AdminService
{
    public static function createUpdate($admin, $request)
    {
        if (isset($request->name)) {
            $admin->name = $request->name;
        }
        if (isset($request->email)) {
            $admin->email = $request->email;
        }
        if (isset($request->created_by)) {
            $admin->created_by = Auth::user()->id;
        }  
        $admin->save();
        return $admin;
    }
}
