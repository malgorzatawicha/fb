<?php

namespace Fb\Http\Controllers\Admin;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Redirect;
use Fb\Models\Gallery\GalleryProjectImage;
use Image;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function image($imageId, $width, $height)
    {

    }

    public function thumb($imageId, $size)
    {
        $image = GalleryProjectImage::findOrFail($imageId);
        $file = $image->thumbFile;
        $location = $file->path . '/' . $file->filename;
        return Image::make($location)->resize($size, $size)->response($file->extension);
    }
}