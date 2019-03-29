<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){

        return view('admin.pages.list');
    }

    public function add(){

        return view('admin.pages.form');
    }
}
