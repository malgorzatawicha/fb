<?php

namespace Fb\Http\Controllers\Admin;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}