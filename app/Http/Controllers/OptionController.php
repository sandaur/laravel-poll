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
    
    public function store(StoreOptionRequest $request) /* AJAX */
    {
        $data = $request->all();

        $hash = md5($data['name'].microtime());
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "img_{$hash}.{$extension}";

        $request->file('image')->storeAs($this->imageDirName, $fileName, 'public');

        Option::create([
            'name'    => $data['name'],
            'description' => $data['description'],
            'image' => $fileName,
            'votation_id'   => $data['poll_id'],
        ]);

        return response()->json(['message' => 'Candidate Created'], 200);
    }

    public function destroy()  // TODO: Delete images related to options
    {
        $rules = [
            'poll_id' => 'required',
            'candidate_id' => 'required'
        ];

        $validator = \Validator::make(request()->all(), $rules);
        if ($validator->fails()){
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $votation = Auth::user()->votations->find(request('poll_id'));
        $option = $votation->options->find(request('candidate_id'));
        $option->delete();

        return response()->json(['message' => 'Candidate Deleted'], 200);
    }
}
