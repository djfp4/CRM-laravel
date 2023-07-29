<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\User;
use App\Models\Client;
Use Auth;

class CreditController extends Controller
{
    public function index()
    {
        //$texto = trim($request->get('texto'));
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $credito = Credit::join('clients','clients.id','=','credits.client_id')
            ->join('users','users.id','=','credits.user_id')
            ->join('people as clients_people','clients_people.id','clients.person_id')
            ->join('people as users_people','users_people.id','clients.person_id')
            ->select('credits.id','amount','bank','fees','interest','client_type','clients_people.name','clients_people.last_name','users_people.name as unom','users_people.last_name as uape')
            ->where('credits.state','=',1)
            ->paginate(8);
        }else{
            $credito = Credit::join('clients','clients.id','=','credits.client_id')
            ->join('users','users.id','=','credits.user_id')
            ->join('people as clients_people','clients_people.id','clients.person_id')
            ->join('people as users_people','users_people.id','clients.person_id')
            ->select('credits.id','amount','bank','fees','interest','client_type','clients_people.name','clients_people.last_name','users_people.name as unom','users_people.last_name as uape')
            ->where('credits.state','=',1)
            ->where('credits.user_id','=',$userId)
            ->paginate(8);
        }
        return view('credito.index', compact('credito'));
    }

    public function create()
    {
        $cliente = Client::select('clients.id','name','last_name')
        ->join('people','people.id','clients.person_id')
        ->where('clients.state','!=',0)
        ->get();

        return view('credito.crear', compact('cliente'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required',
            'interest'=>'required',
            'bank'=>'required',
            'client_id'=>'required',
            'client_type'=>'required'
        ]);
        $userId = Auth::id();
        $credito = new Credit;
        $credito->amount=$request->amount;
        $credito->interest=$request->interest;
        $credito->bank=$request->bank;
        $credito->client_id=$request->client_id;
        $credito->client_type=$request->client_type;
        $credito->user_id=$userId;
        $credito->create();
        return redirect()->route('credito.index');
    }

    public function show($id)
    {
        $credito = Credit::select('credits.id','name','last_name')
        ->join('clients','clients.id','=','client_id')
        ->join('people','people.id','=','clients.person_id')
        ->where('clients.id','=',$id)
        ->first();
        return view('credito.show', compact('credito'));
    }

    public function edit($id)
    {
        $cliente = Client::select('clients.id','name','last_name')
        ->join('people','people.id','clients.person_id')
        ->where('clients.state','!=',0)
        ->get();

        $credito = Credit::findOrFail($id);

        return view('credito.editar', compact('cliente','credito'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount'=>'required',
            'interest'=>'required',
            'bank'=>'required',
            'client_id'=>'required',
            'client_type'=>'required'
        ]);
        $userId = Auth::id();
        $credito = Credit::findOrFail($id);
        $credito->amount=$request->amount;
        $credito->interest=$request->interest;
        $credito->bank=$request->bank;
        $credito->client_id=$request->client_id;
        $credito->client_type=$request->client_type;
        $credito->user_id=$userId;
        $credito->update();
        return redirect()->route('credito.index');
    }

    public function destroy($id)
    {
        $credito = Credit::findOrFail($id);
        $credito->state=0;
        $credito->update();
        return redirect()->route('credito.index');
    }
}
