<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Spatie\Permission\Models\RoLe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    // function __construct(){
    //     $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario',['only'=>['index']]);
    //     $this->middleware('permission:ver-usuario|crear-usuario',['only'=>['create','store']]);
    //     $this->middleware('permission:ver-usuario|editar-usuario',['only'=>['edit','update']]);
    //     $this->middleware('permission:ver-usuario|borrar-usuario',['only'=>['destroy']]);
    // }
    public function index(Request $request)
    {
        // if($request){
        //     $query = $request->get('q');
        //     $usuarios = User::select('id','name','last_name','ci','phone','email')
        //     ->where('state','=',1)
        //     ->where('name', 'like', '%'.$query.'%')
        //     ->paginate(8); 
        // }else{
            $texto = trim($request->get('texto'));
            $usuarios = User::select('users.id','name','last_name','ci','phone','users.email')
            ->join('people','people.id','=','users.person_id')
            ->where('users.state','=',1)
            ->where(function ($query) use ($texto) {
                $query->orWhere('name', 'LIKE', '%' . $texto . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $texto . '%')
                    ->orWhere('ci', 'LIKE', '%' . $texto . '%')
                    ->orWhere('phone', 'LIKE', '%' . $texto . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $texto . '%');
            })
            ->paginate(8);
        // }

        return view('usuarios.index', compact('usuarios','texto'));
    }



    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|same:confirm-password',
            'roles'=>'required'
        ]);
        $input = $request->all();
        
        $input['password']= Hash::make($input['password']);
        
        $person = new Person();
        $person->email=$input['email'];
        $person->name=$input['name'];
        $person->last_name=$input['last_name'];
        $person->ci=$input['ci'];
        $person->phone=$input['phone'];
        $person->save();

        $persona = Person::latest()->first();
        $user = new User();
        $user->email=$input['email'];
        $user->password=$input['password'];
        $user->person_id=$persona->id;
        $user->save();

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    public function show($id)
    {
        $usuario = User::select('users.id','people.name','people.last_name')
        ->join('people','people.id','=','users.person_id')
        ->where('users.id','=',$id)
        ->first();
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $user = User::select('users.id','people.name','people.last_name','users.email','password','phone','ci')
        ->join('people','people.id','=','users.person_id')
        ->where('users.id','=',$id)
        ->first();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'password'=>'same:confirm-password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->email=$request->email;
        if (!empty($request->password)) {
            $user->password=$request->password;
        }
        $user->update();
        $person = Person::findOrFail($user->person_id);
        $person->email=$request->email;
        $person->name=$request->name;
        $person->last_name=$request->last_name;
        $person->ci=$request->ci;
        $person->phone=$request->phone;
        $person->update();
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->state=0;
        $user->update();
        return redirect()->route('usuarios.index');
    }
}
