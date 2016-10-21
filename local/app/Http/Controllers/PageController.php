<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    //
    public function about($value='')
    {
    	# code...
    	$name = "shaban";
    	return view("pages.about",compact('name'));
    }
}
