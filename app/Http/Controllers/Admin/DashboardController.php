<?php

namespace Fb\Http\Controllers\Admin;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Redirect;
use Fb\Models\File;
use Image;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function image($imageId, $width = null, $height = null, $crop = false)
    {
        $file = File::findOrFail($imageId);
        $location = $file->path . '/' . $file->filename;


        $image = Image::cache(function($image) use($location, $width, $height, $crop) {
            $image = $image->make($location);
            if (!empty($width) && !empty($height)) {
                if ($crop) {
                    $image->fit($width, $height);
                } else {
                    $image->resize($width, $height);
                }
            }
        }, 5, true);
        return $image->response($file->extension);
    }
}