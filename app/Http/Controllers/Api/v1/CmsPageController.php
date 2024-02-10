<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    public function cmsPages(Request $request)
    {
        $pageType = $request->type;
        $description = CmsPage::where('type', $pageType)->first();
        if($pageType == 'terms_of_use') {
            $message = 'Terms of Service fetched successfully';
        } else if($pageType == 'privacy_policy') {
            $message = 'Privacy Policy fetched successfully';
        }
        return sendResponse($description, $message);
    }
}
