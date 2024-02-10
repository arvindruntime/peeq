<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VersionControl;

class VersionControlController extends Controller
{
    public function versionDetails()
    {
        $versionControl = VersionControl::first();
        $message = 'Version control data fetched successfully.';
        if($versionControl)
        {
            return sendResponse($versionControl, $message);
        }
        else
        {
            return sendError('Error Occurred');
        }
    }
}
