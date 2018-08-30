<?php

namespace App\Http\Controllers;

use Auth;
use App\Votation;
use App\Utils\TenantUtils;
use App\Http\Requests\StorePollRequest;
use Illuminate\Http\Request;

/**TODO:
 *      Acegurar que cada votacion este vinculada a una base de datos existente.
 */

class VotationController extends Controller
{
    public function index()
    {
        return view('votations');
    }

    public function show() /* AJAX */
    {
        $votations = Auth::user()->votations()->with('setting')->with('options')->get();

        return response()->json(['votations' => $votations], 200);
    }

    public function store(StorePollRequest $request) /* AJAX */
    {   
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

        $newDatabase = TenantUtils::createDatabase($data['subdomain']);

        if (!$votation || !$setting || !$newDatabase){
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
            return response()->json('Not Authorized', 400);
        }
        
        $votation->delete();
        
        return response()->json(['message' => 'votation '.request('id').' deleted'], 200);
    }

    public function subdomAvailable($subdom) /* AJAX */
    {
        $available = \App\Votation::isNameAvailable($subdom);
        return response()->json(compact("available"), 200);
    }
}
