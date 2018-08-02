<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Option;
use App\Votation;
use App\Http\Requests\StoreOptionRequest;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected $imageDirName = 'opt_img';
    
    public function __construct(Request $request)
    {
        $this->middleware("owns.poll", ["only" => ["store", "create", "destroy"]]);
    }
    
    public function create($pollid)
    {
        $votation = Auth::user()->votations->find($pollid);

        return view('candidates', [
            'options' => $votation->options,
            'pollName' => $votation->title,
            'pollid' => $pollid
        ]);
    }
    
    public function store(StoreOptionRequest $request, $pollid)
    {
        $data = $request->all();

        $hash = md5($data['opt-name'].microtime());
        $extension = $request->file('opt-img')->getClientOriginalExtension();
        $fileName = "img_{$hash}.{$extension}";

        $request->file('opt-img')->storeAs($this->imageDirName, $fileName, 'public');

        Option::create([
            'name'    => $data['opt-name'],
            'description' => $data['opt-desc'],
            'image' => $fileName,
            'votation_id'   => $pollid,
        ]);

        $request->session()->flash('message', 'La opcion ha sido creada satisfactoriamente');
        $request->session()->flash('msg-type', 'success');

        return redirect()->route('create-option', ['pollid' => $pollid]);
    }

    public function destroy(Request $request, $pollid)  // TODO: Delete images related to options
    {
        $votation = Auth::user()->votations->find($pollid);
        $option = $votation->options->find($request->get('opt-id'));
        $option->delete();

        $request->session()->flash('message', 'La opcion ha sido borrada satisfactoriamente');
        $request->session()->flash('msg-type', 'success');

        return redirect()->route('create-option', ['pollid' => $pollid]);
    }
}
