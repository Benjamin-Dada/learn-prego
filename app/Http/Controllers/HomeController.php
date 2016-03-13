<?php

namespace Prego\Http\Controllers;

use Illuminate\Http\Request;

use Prego\Http\Requests;

class HomeController extends Controller
{
    public function index(){
    	return view('index');
    }
}
