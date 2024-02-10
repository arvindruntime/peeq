<?php

namespace App\Services;

use App\Models\EmailTemplate;

class EmailTemplateService
{
    public static function createUpdate($emailTemplate, $request)
    {
        if (isset($request->title)) {
            $emailTemplate->title = $request->title;
        }
        if (isset($request->content)) {
            $emailTemplate->content = $request->content;
        }
        $emailTemplate->save();
        return $emailTemplate;
    }
}
