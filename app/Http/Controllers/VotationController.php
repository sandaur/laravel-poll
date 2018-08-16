<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Votation;
use App\Http\Requests\StorePollRequest;
use Illuminate\Http\Request;

/**TODO:
 *      Acegurar que cada votacion este vinculada a una base de datos existente.
 */

class VotationController extends Controller
{
    protected $dbPrefix = "poll_";

    public function index()
    {
        return view('votations');
    }

    public function show() /* AJAX */
    {
        $votations = Auth::user()->votations()->with('setting')->get();

        return response()->json(['votations' => $votations], 200);
    }

    public function store(StorePollRequest $request) /* AJAX */
    {
        //$data = $request->only(['vote-subdom','vote-title','vote-desc','vote-from','vote-to']);
        
        /* if (!$this->createDatabase($data['vote-subdom'])){
            $request->session()->flash('message', 'Ha ocurrido un error inesperado, por favor vuelva a intentar mas tarde.');
            $request->session()->flash('msg-head', 'Opps! ');
            $request->session()->flash('msg-type', 'danger');
            return redirect()->route('home');
        } */
        
        $data = $request->all();
        
        \DB::beginTransaction();
        $votation = Votation::create([
            'subdom'    => $data['subdomain'],
            'title'     => $data['title'],
            'description' => $data['description'],
            'user_id'   => Auth::user()->id,
        ]);

        $setting = \App\Setting::create([
            'admition_type' => $data['admition'],
            'user_enc'  => $data['user_enc'],
            'auth_cu'   => $data['auth_cu'],
            'auth_email'=> $data['auth_email'],
            'auth_rut'  => $data['auth_rut'],
            'auto_start'=> $data['start_active'],
            'auto_end'  => $data['end_active'],
            'start_time'=> $data['start_datetime'],
            'end_time'  => $data['end_datetime'],
            'votation_id' => $votation->id
        ]);

        if (!$votation || !$setting){
            \DB::rollBack();
            return response()->json(['message' => 'Error'], 500);
        }
        \DB::commit();
            
        return response()->json(['message' => 'Votation Created'], 200);
    }

    public function destroy(Request $request) /* AJAX */
    {
        $votation = Votation::find(request('id'));
        
        // Compruba si usuario tiene permiso para eliminar esta votacion
        if (!Auth::user()->can('remove', $votation)){
            return redirect()->route('home');
        }
        
        /* if (!$this->destroyDatabase($votation->subdom)){
            $request->session()->flash('message', 'Ha ocurrido un error inesperado, por favor vuelva a intentar mas tarde.');
            $request->session()->flash('msg-head', 'Opps! ');
            $request->session()->flash('msg-type', 'danger');
            return redirect()->route('home');
        } */
        
        $votation->delete();
        
        return response()->json(['message' => 'votation '.request('id').' deleted'], 200);
    }

    public function subdomAvailable($subdom) /* AJAX */
    {
        $available = \App\Votation::isNameAvailable($subdom);
        return response()->json(compact("available"), 200);
    }

    private function createDatabase($dbName)
    {
        $dbFullName = $this->dbPrefix.$dbName;

        try{
            if ($this->existDatabase($dbFullName)){
                return false;
            } else{
                DB::statement("CREATE DATABASE {$dbFullName}");
            }
        } catch (\Illuminate\Database\QueryException $e){
                return false;
        }

        if ($this->existDatabase($dbFullName)){
            return true;
        } else{
            return false;
        }
    }

    private function destroyDatabase($dbName)
    {
        $dbFullName = $this->dbPrefix.$dbName;

        try{
            if ($this->existDatabase($dbFullName)){
                DB::statement("DROP DATABASE {$dbFullName}");
            } else{
                return false;
            }
        } catch (\Illuminate\Database\QueryException $e){
                return false;
        }

        if ($this->existDatabase($dbFullName)){
            return false;
        } else{
            return true;
        }
    }

    private function existDatabase($dbName)
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$dbName]);

        return !empty($db);
    }
}
