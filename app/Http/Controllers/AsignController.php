<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Client;
use App\Models\Person;

class AsignController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $this->validate($request, [
            'email'=>'email|unique:users,email',
        ]);
        $person = new Person();
        $person->email=$request->get('email');
        $person->save();
        $id = Person::select('id')
        ->where('email','=',$request->get('email'))
        ->first();
        $client = new Client();
        $client->user_id=$request->get('user_id');
        $client->person_id=$id->id;
        $client->state=1;
        $client->save();
        
        return redirect()->route('cliente.index');
    }

    public function show($id)
    {
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==4)
        {
            $usuarios = User::select('users.id','name','last_name')
            ->join('people','users.person_id','=','people.id')
            ->join('model_has_roles','model_id','=','users.id')
            ->where('role_id','=',2)
            ->where('users.state','=',1)
            ->get();
        }
        if($rol->role_id==5)
        {
            $usuarios = User::select('users.id','name','last_name')
            ->join('people','users.person_id','=','people.id')
            ->join('model_has_roles','model_id','=','users.id')
            ->where('role_id','=',3)
            ->where('users.state','=',1)
            ->get();
        }
        $correo = $id;
        return view('asignar.crear',compact('usuarios','correo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
