<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class IndexController extends Controller
{

    public function index()
    {
        return redirect()->route('admin.events.index');
    }
}
