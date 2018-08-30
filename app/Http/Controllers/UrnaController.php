<?php

namespace App\Http\Controllers;

use App\Votation;
use Illuminate\Http\Request;

class UrnaController extends Controller
{
    public function index($subdom)
    {
        $candidates = Votation::where('subdom', $subdom)->first();

        return view('urna', ['candidates' => $candidates->options]);
    }
}
