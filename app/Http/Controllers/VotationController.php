<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Votation;
use Illuminate\Http\Request;

/**TODO:
 *      Acegurar que cada votacion este vinculada a una base de datos existente.
 */

class VotationController extends Controller
{
    protected $dbPrefix = "poll_";

    public function store(Request $request)
    {
        $data = $request->only(['vote-subdom','vote-title','vote-desc','vote-from','vote-to']);

        if (!$this->createDatabase($data['vote-subdom'])){
            $request->session()->flash('message', 'Ha ocurrido un error inesperado, por favor vuelva a intentar mas tarde.');
            $request->session()->flash('msg-head', 'Opps! ');
            $request->session()->flash('msg-type', 'danger');
            return redirect()->route('home');
        }

        Votation::create([
            'subdom'    => $data['vote-subdom'],
            'title'     => $data['vote-title'],
            'description' => $data['vote-desc'],
            'start_time' => $data['vote-from'],
            'end_time'  => $data['vote-to'],
            'user_id'   => Auth::user()->id,
        ]);

        $request->session()->flash('message', 'Se ha creado una nueva votacion de forma satisfactoria.');
        $request->session()->flash('msg-type', 'success');
        return redirect('/home');
    }

    public function destroy(Request $request)
    {
        $votation = Votation::find($request->get('poll-id'));

        if ($votation === null){
            return redirect()->route('home');
        } else if ($votation->user->id != Auth::user()->id){
            return redirect()->route('home');
        }

        if (!$this->destroyDatabase($votation->subdom)){
            $request->session()->flash('message', 'Ha ocurrido un error inesperado, por favor vuelva a intentar mas tarde.');
            $request->session()->flash('msg-head', 'Opps! ');
            $request->session()->flash('msg-type', 'danger');
            return redirect()->route('home');
        }

        $votation->delete();

        $request->session()->flash('message', 'Se ha eliminado la votacion de forma satisfactoria.');
        $request->session()->flash('msg-type', 'success');
        return redirect()->route('home');
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
