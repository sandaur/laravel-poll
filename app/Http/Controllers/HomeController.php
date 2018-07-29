<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $votations = Auth::user()->votations;
        return view('home', ['votations' => $votations]);
    }
}
