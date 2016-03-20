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

    public function image($imageId, $width, $height)
    {
        $file = File::findOrFail($imageId);
        $location = $file->path . '/' . $file->filename;
        return Image::make($location)->resize($width, $height)->response($file->extension);
    }
}