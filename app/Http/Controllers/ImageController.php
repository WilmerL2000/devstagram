<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * We're taking the image from the request, creating a unique name for it, creating an image
     * object, resizing it, creating a path to it, and saving it to the path
     * 
     * @param Request request The request object.
     * 
     * @return The image name.
     */
    public function store(Request $request) {
        $image = $request->file('file');

        /* Creating a unique name for the image. */
        $image_name = Str::uuid() . "." . $image->extension();

        /* Creating an image object. */
        $image_server = Image::make($image);

        /* Resizing the image to 1000x1000. */
        $image_server->fit(1000, 1000);

        /* Creating a path to the image. */
        $image_path = public_path('uploads') . '/' . $image_name;
        /* Saving the image to the path. */
        $image_server->save($image_path);

        return response()->json(['image' => $image_name]);
    }
}
