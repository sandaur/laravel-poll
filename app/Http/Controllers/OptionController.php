<?php

namespace App\Http\Controllers;

use Auth;
use App\Option;
use App\Votation;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware("owns.poll", ["only" => ["store", "create", "destroy"]]);
    }

    public function store(Request $request, $pollid)
    {
        $data = $request->all();

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

        return view('candidates', ['options' => $votation->options, 'pollid' => $pollid]);
    }

    public function destroy(Request $request, $pollid)
    {
        $votation = Auth::user()->votations->find($pollid);
        $option = $votation->options->find($request->get('opt-id'));
        $option->delete();

        $request->session()->flash('message', 'La opcion ha sido borrada satisfactoriamente');
        $request->session()->flash('msg-type', 'success');

        return redirect()->route('create-option', ['pollid' => $pollid]);
    }
}
