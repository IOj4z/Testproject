<?php

namespace App\Http\Controllers\API\V1\SUPER_USER;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $file = $request->file('image');
        $name = \Illuminate\Support\Str::random(10);
        $localUrl = Storage::putFileAs('image',$file,$name.'.'.$file->extension());
        return [
            'url'=>env('APP_URL').'/'.$localUrl
        ];
    }
}
