<?php

namespace App\Http\Controllers;

use Auth;
use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request, $pollid)
    {
        $data = $request->all();

        if (Auth::user()->votations->where('id','=',$pollid) === null){
            return redirect()->route('home');
        }

        Option::create([
            'name'    => $data['opt-name'],
            'description' => $data['opt-desc'],
            'image' => $data['opt-img'],
            'votation_id'   => $pollid,
        ]);

        return redirect()->route('create-option', ['pollid' => $pollid]);
    }

    public function create($pollid)
    {
        $votation = Auth::user()->votations->find($pollid);

        if (Auth::user()->votations->where('id','=',$pollid)->first() === null){
            return redirect()->route('home');
        }

        $votation->options;
        if ($votation === null){
            return redirect()->route('home');
        }

        return view('candidates', ['options' => $votation->options, 'pollid' => $pollid]);
    }
}
