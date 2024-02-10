<?php

namespace App\Services;

use App\Models\Media;

class MediaService
{
    public static function createUpdate($media, $request)
    {
        if (isset($request->name)) {
            $media->name = $request->name;
        }
        if (isset($request->types)) {
            $media->types = $request->types;
        }
        if (isset($request->url)) {

            $imageName = md5(time()) . '.' . $request->url->extension();
            $request->url->storeAs('public/media', $imageName);
            $input['image'] = $imageName;
            $media->url = asset('/storage/media/'.$input['image']);
            $media->url = $media->url;
        }

        if (isset($request->archive)) {
            $media->archive = $archive->archive;
        }
        if (isset($request->added_by)) {
            $media->added_by = $request->added_by;
        } 
        $media->save();
        return $media;
    }
}
