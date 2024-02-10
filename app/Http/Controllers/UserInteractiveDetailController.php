<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInteractiveDetail;

class UserInteractiveDetailController extends Controller
{
    public function store(Request $request)
    {
        UserInteractiveDetail::where('user_id', $request->user_id)->where('module_id', $request->module_id)->delete();
        $check_val = UserInteractiveDetail::where('user_id', $request->user_id)->where('module_id', $request->module_id)->where('page_no', $request->page)->first();
        if(!$check_val) {
            $UserInteractiveDetail = new UserInteractiveDetail();
            $UserInteractiveDetail->user_id = $request->user_id;
            $UserInteractiveDetail->module_id = $request->module_id;
            $UserInteractiveDetail->page_no = $request->page;
            $UserInteractiveDetail->save();
        }
    }

    public function get_page(Request $request)
    {
        $check_val = UserInteractiveDetail::where('user_id', $request->user_id)->where('module_id', $request->module_id)->first();
        if($check_val) {
            return $check_val->page_no;
        } else {
            return 0;
        }
    }
}
