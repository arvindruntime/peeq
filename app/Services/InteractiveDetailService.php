<?php

namespace App\Services;

use App\Models\InteractiveDetail;
use Illuminate\Support\Facades\Auth;

class InteractiveDetailService
{
    public static function createUpdate($interactiveDetail, $request)
    {
        $interactiveDetail = InteractiveDetail::where('interactive_workbook_id', $request->interactive_workbook_id)
                                                ->where('user_id', $request->user_id)
                                                ->first();
        if($interactiveDetail) {
            if (isset($request->content)) {
                $interactiveDetail->content = $request->content;
            }
            $interactiveDetail->save();
        } else {
            $interactiveDetail = new InteractiveDetail();

            if (isset($request->interactive_workbook_id)) {
                $interactiveDetail->interactive_workbook_id = (int)$request->interactive_workbook_id;
            }
            if(isset($request->user_id)) {
                $interactiveDetail->user_id = (int)$request->user_id;
            } else {
                $interactiveDetail->user_id = Auth::user()->id;
            }
            if (isset($request->content)) {
                $interactiveDetail->content = $request->content;
            }
            $interactiveDetail->save();
        }
        return $interactiveDetail;
    }
}
