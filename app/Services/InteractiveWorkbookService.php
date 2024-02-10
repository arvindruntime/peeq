<?php

namespace App\Services;

use App\Models\InteractiveWorkbook;

class InteractiveWorkbookService
{
    public static function createUpdate($interactiveWorkbook, $request)
    {
        if (isset($request->course_id)) {
            $interactiveWorkbook->course_id = (int)$request->course_id;
        }
        if (isset($request->course_module_id)) {
            $interactiveWorkbook->course_module_id = (int)$request->course_module_id;
        }
        if (isset($request->page_no)) {
            $interactiveWorkbook->page_no = $request->page_no;
        }
        if (isset($request->pdf_content)) {
            $interactiveWorkbook->pdf_content = $request->pdf_content;
        }
        if (isset($request->interactive_content)) {
            $interactiveWorkbook->interactive_content = $request->interactive_content;
        }
        /* Upload audio recording */
        if (isset($request->audio_file)) {
            $audioFileName = md5(time()) . '.' . $request->audio_file->extension();
            $request->audio_file->storeAs('public/interactiveWorkbook/audioFile', $audioFileName);
            $input['audioFile'] = $audioFileName;
            $interactiveWorkbook->audio_file = asset('/storage/interactiveWorkbook/audioFile/' . $input['audioFile']);
        }
        if (isset($request->start_page)) {
            $interactiveWorkbook->start_page = (int)$request->start_page;
        }
        if (isset($request->end_page)) {
            $interactiveWorkbook->end_page = (int)$request->end_page;
        }
        if (isset($request->status)) {
            $interactiveWorkbook->status = $request->status;
        }
        $interactiveWorkbook->save();
        return $interactiveWorkbook;
    }
}
