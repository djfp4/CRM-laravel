<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Person;
use Auth;
use App\Services\FirebaseService;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $state="0";
        switch ($texto) {
            case 'nuevo':
                $state = '1';
                break;
            case 'contactado':
                $state = '2';
                break;
            case 'seguimiento':
                $state = '3';
                break;
            case 'cerrado':
                $state = '4';
                break;
            default:
                # code...
                break;
        }
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $cliente = Client::select('clients.id','name','last_name','ci','phone','birthday','address','email','clients.state')
            ->join('people','people.id','=','clients.person_id')
            ->where('clients.state','!=',0)
            ->where(function ($query) use ($texto,$state) {
            $query->orWhere('people.name', 'LIKE', '%' . $texto . '%')
                ->orWhere('people.last_name', 'LIKE', '%' . $texto . '%')
                ->orWhere('people.ci', 'LIKE', '%' . $texto . '%')
                ->orWhere('people.phone', 'LIKE', '%' . $texto . '%')
                ->orWhere('people.email', 'LIKE', '%' . $texto . '%')
                ->orWhere('address', 'LIKE', '%' . $texto . '%')
                ->orWhere('clients.state', 'LIKE', '%' . $state . '%');
            })
            ->paginate(8);
            return view('cliente.index', compact('cliente','texto'));


        }else{
            if ($rol->role_id==4||$rol->role_id==5) {
                $cliente="";
                $texto="";
                $prospecto = new FirebaseService();
                $mostrar = $prospecto->correo();
                $persona = Person::all();
                foreach ($persona as $per) {
                    foreach($mostrar['correo'] as $usuario)
                    {
                        if ($per->email==$usuario) {
                            $mostrar['correo'] = array_diff($mostrar['correo'], [$usuario]);
                        }
                    }
                }
                
                return view('cliente.index', compact('mostrar','cliente','texto'));
            }else{
                
                $cliente = Client::select('clients.id','name','last_name','ci','phone','birthday','address','email','clients.state')
                ->join('people','people.id','=','clients.person_id')
                ->where('clients.state','!=',0)
                ->where('user_id','=',$userId)
                ->where(function ($query) use ($texto,$state) {
                $query->orWhere('name', 'LIKE', '%' . $texto . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $texto . '%')
                    ->orWhere('ci', 'LIKE', '%' . $texto . '%')
                    ->orWhere('phone', 'LIKE', '%' . $texto . '%')
                    ->orWhere('email', 'LIKE', '%' . $texto . '%')
                    ->orWhere('address', 'LIKE', '%' . $texto . '%')
                    ->orWhere('clients.state', 'LIKE', '%' . $state . '%');
                })
                ->paginate(8);
                return view('cliente.index', compact('cliente','texto'));
            }
        }
        
        //$prospecto->eliminarCorreo('prueba@gmail.com');
    }

    public function create()
    {
        return view('cliente.crear');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $this->validate($request, [
            'name'=>'required',
            'email'=>'email|unique:people,email',
            'ci'=>'required|unique:people,ci|numeric|between:1000000,99999999',
            'phone'=>'required|numeric|between:60100000,79949999'
        ]);
        $person = new Person();
        $person->email=$request->get('email');
        $person->name=$request->get('name');
        $person->last_name=$request->get('last_name');
        $person->ci=$request->get('ci');
        $person->phone=$request->get('phone');
        $person->save();
        $id = Person::select('id')
        ->where('email','=',$request->get('email'))
        ->first();
        $client = new Client();
        $client->user_id=$userId;
        $client->person_id=$id->id;
        $client->birthday=$request->get('birthday');
        $client->address=$request->get('address');
        $client->state=$request->get('state');
        $client->save();
        
        return redirect()->route('cliente.index');
    }

    public function show($id)
    {
        $cliente = Client::select('clients.id','name','last_name')
        ->join('people','people.id','=','clients.person_id')
        ->where('clients.id','=',$id)
        ->first();
        return view('cliente.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Client::select('clients.id','name','last_name','email','phone','ci','birthday','address','clients.state')
        ->join('people','people.id','=','clients.person_id')
        ->where('clients.id','=',$id)
        ->first();
        return view('cliente.editar', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Client::findOrFail($id);
        $person = Person::findOrFail($cliente->person_id);

        $this->validate($request, [
            'name'=>'required|min:2|max:50',
            'email'=>'email|max:50|unique:people,email,'. $person->id,
            'ci'=>'required|numeric|between:1000000,99999999|unique:people,ci,'. $person->id,
            'phone'=>'required|numeric|between:60100000,79949999'
        ]);

        if ($cliente->state==3) {
            $person->name=$request->get('name');
            $person->last_name=$request->get('last_name');
            $person->ci=$request->get('ci');
            $person->email=$request->get('email');
            $person->phone=$request->get('phone');
            $person->update();
            $cliente->birthday=$request->get('birthday');
            $cliente->update();
        }else{
            $person->name=$request->get('name');
            $person->last_name=$request->get('last_name');
            $person->ci=$request->get('ci');
            $person->email=$request->get('email');
            $person->phone=$request->get('phone');
            $person->update();
            $cliente->birthday=$request->get('birthday');
            $cliente->state=$request->get('state');
            $cliente->update();
        }
        
        return redirect()->route('cliente.index');
    }

    public function destroy($id)
    {
        $cliente = Client::findOrFail($id);
        $cliente->state=0;
        $cliente->update();
        return redirect()->route('cliente.index');
    }
}
