<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Student;
use App\Models\Group;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = Client::all();
        $grupo = Group::all();
        return view('alumno.crear', compact('grupo','cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id'=>'required',
            'group_id'=>'required'
        ]);

        Student::create($request->all());
        return redirect()->route('grupo.show',1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $cliente = Student::select('students.id','name','last_name','ci','phone','birthday','email','clients.state')
            ->join('clients','clients.id','=','client_id')
            ->join('people','people.id','=','person_id')
            ->where('clients.state','!=',0)
            ->where('group_id','=',$id)
            ->paginate(8);
        }else{
            $cliente = Student::select('students.id','name','last_name','ci','phone','birthday','email','clients.state')
            ->join('clients','clients.id','=','client_id')
            ->join('people','people.id','=','person_id')
            ->where('clients.state','!=',0)
            ->where('group_id','=',$id)
            ->paginate(8);
        }
        
        return view('alumno.show', compact('cliente'));
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
