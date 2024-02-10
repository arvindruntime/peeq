<?php

namespace App\Services;

use App\Models\UserIssue;

class UserIssueService
{
    public static function createUpdate($userIssue, $request)
    {
        if (isset($request->title)) {
            $userIssue->title = $request->title;
        }
        if (isset($request->description)) {
            $userIssue->description = $request->description;
        }
        $userIssue->save();
        return $userIssue;
    }
}
