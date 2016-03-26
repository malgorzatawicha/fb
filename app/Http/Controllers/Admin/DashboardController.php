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
        $image = Image::make($location);
        if (!empty($width) && !empty($height)) {
            if ($crop) {
                $image = $image->fit($width, $height);
            } else {
                $image = $image->resize($width, $height);
            }
        }
        return $image->response($file->extension);
    }
}