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
        $votations = Auth::user()->votations;

        // Give votation status to display based on time restrictions (if present)
        foreach ($votations as $poll) {
            $stamp = strtotime($poll->start_time);
            $start = $poll->start_time?(strtotime($poll->start_time)>time()?true:false):false;
            $end = $poll->end_time?(strtotime($poll->end_time)<time()?true:false):false;

            if ($start || $end){
                if ($start){
                    $poll->status = "waiting";
                } else{
                    $poll->status = "closed";
                }
            } else{
                $poll->status = "open";
            }
        }

        return view('home', ['votations' => $votations]);
    }

    public function store(StorePollRequest $request)
    {
        //$data = $request->only(['vote-subdom','vote-title','vote-desc','vote-from','vote-to']);
        
        /* if (!$this->createDatabase($data['vote-subdom'])){
            $request->session()->flash('message', 'Ha ocurrido un error inesperado, por favor vuelva a intentar mas tarde.');
            $request->session()->flash('msg-head', 'Opps! ');
            $request->session()->flash('msg-type', 'danger');
            return redirect()->route('home');
        } */
        
        $data = $request->all();
        Votation::create([
            'subdom'    => $data['subdomain'],
            'title'     => $data['title'],
            'description' => $data['description'],
            'admition_type' => $data['admition'],
            'user_enc'  => $data['user_enc'],
            'auth_cu'   => $data['auth_cu'],
            'auth_email'=> $data['auth_email'],
            'auth_rut'  => $data['auth_rut'],
            'start_time'=> $data['start_datetime'],
            'end_time'  => $data['end_datetime'],
            'user_id'   => Auth::user()->id,
        ]);
            
        return response()->json(['message' => 'Votation Created'], 200);

        /* $request->session()->flash('message', 'Se ha creado una nueva votacion de forma satisfactoria.');
        $request->session()->flash('msg-type', 'success');
        return redirect('/home'); */
    }

    public function destroy(Request $request)
    {
        $votation = Votation::find($request->get('poll-id'));

        //Check if user has right to delete votation
        if (!Auth::user()->can('remove', $votation)){
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
