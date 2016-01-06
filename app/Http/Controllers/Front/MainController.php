<?php

namespace Fb\Http\Controllers\Front;

use Illuminate\Http\Request;

use Fb\Http\Controllers\Controller;
use Redirect;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.main.index');
    }

}
