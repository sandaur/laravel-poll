<?php

namespace App\Http\Controllers;

use App\Votation;
use Illuminate\Http\Request;

class UrnaController extends Controller
{
    public function index($subdom)
    {
        $votation = Votation::where('subdom', $subdom)->first();
        $options = $votation->options;

        return view('urna', ['options' => $options, 'poll' => $votation]);
    }
}
