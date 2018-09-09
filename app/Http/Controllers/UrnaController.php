<?php

namespace App\Http\Controllers;

use App\Votation;
use Illuminate\Http\Request;

class UrnaController extends Controller
{
    public function index($pollName)
    {
        $candidates = Votation::where('subdom', $pollName)->first();

        return view('urna', ['candidates' => $candidates->options]);
    }
}
