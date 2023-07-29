<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\User;

class CoachController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-coach|crear-coach|editar-coach|borrar-coach',['only'=>['index']]);
        $this->middleware('permission:ver-coach|crear-coach',['only'=>['create','store']]);
        $this->middleware('permission:ver-coach|editar-coach',['only'=>['edit','update']]);
        $this->middleware('permission:ver-coach|borrar-coach',['only'=>['destroy']]);
    }

    public function index()
    {
        $coachs = Coach::select('id','name','last_name','ci','cellphone','user_id')
        ->where('state','=','1')
        ->paginate(8);
        return view('coachs.index', compact('coachs'));
    }

    public function create()
    {
        $usuarios = User::pluck('name','id')->all();
        return view('coachs.crear', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'last_name'=>'required',
            'ci'=>'required|unique:coaches|min:7|max:8',
            'cellphone'=>'required|min:8|max:8',
            'user_id'=>'required'
        ]);

        Coach::create($request->all());
        return redirect()->route('coachs.index');
    }

    public function edit(Coach $coach)
    {
        $usuarios = User::all();
        $rol = User::select('name','id')->where('id','=',$coach->user_id)->first();
        return view('coachs.editar', compact('coach','usuarios','rol'));
    }

    public function update(Request $request, Coach $coach)
    {
        $this->validate($request, [
            'name'=>'required',
            'last_name'=>'required',
            'cellphone'=>'required',
            'user_id'=>'required'
        ]);

        $coach->update($request->all());
        return redirect()->route('coachs.index');
    }

    public function destroy(Coach $coach)
    {
        $coach->state = 0;
        $coach->update();
        
        return redirect()->route('coachs.index');
    }
}
