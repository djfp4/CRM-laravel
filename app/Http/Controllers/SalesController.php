<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use App\Models\monitoring;
use App\Models\monitoring_detail;
use App\Models\Property;
use App\Models\Sale;
use Auth;

class SalesController extends Controller
{
    // function __construct(){
    //     $this->middleware('permission:ver-venta|crear-venta|editar-venta|borrar-venta',['only'=>['index']]);
    //     $this->middleware('permission:ver-venta|crear-venta',['only'=>['create','store']]);
    //     $this->middleware('permission:ver-venta|editar-venta',['only'=>['edit','update']]);
    //     $this->middleware('permission:ver-venta|borrar-venta',['only'=>['destroy']]);
    // }

    public function index()
    {
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1){
            $venta = Sale::select('properties.id','block','lot','surface','price','prices','city','model','name','last_name')
            ->join('properties','properties.id','=','sales.property_id')
            ->join('locations','locations.id','=','properties.location_id')
            ->join('types','types.id','=','properties.type_id')
            ->join('clients','clients.id','=','sales.client_id')
            ->join('people','people.id','=','clients.person_id')
            ->where('sales.state','=','1')
            ->paginate(8);
        }else{
            $venta = Sale::select('properties.id','block','lot','surface','price','prices','city','model','name','last_name')
            ->join('properties','properties.id','=','sales.property_id')
            ->join('locations','locations.id','=','properties.location_id')
            ->join('types','types.id','=','properties.type_id')
            ->join('clients','clients.id','=','sales.client_id')
            ->join('people','people.id','=','clients.person_id')
            ->where('sales.state','=','1')
            ->where('sales.user_id','=',$userId)
            ->paginate(8);
        }
        return view('ventas.index', compact('venta'));
    }

    public function create()
    {
        $propiedad = Property::select('properties.id','block','lot','surface','price','city','model')
        ->join('locations','locations.id','=','properties.location_id')
        ->join('types','types.id','=','properties.type_id')
        ->where('properties.state','=','1')
        ->get();
        $clientes = Client::select('clients.id','name','last_name')
        ->join('people','people.id','=','clients.person_id')
        ->where('clients.state','!=',0)
        ->get();
        return view('ventas.crear', compact('propiedad','clientes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id'=>'required',
            'property_id'=>'required',
            'prices'=>'required'
        ]);
        $userId = Auth::id();
        
        $sale = new Sale();
                $sale->user_id=$userId;
                $sale->prices=$request->get('prices');
                $sale->property_id=$request->get('property_id');
                $sale->client_id=$request->get('client_id');
                $sale->state=1;
                $sale->save();
        
        $propiedad=Property::findOrFail($request->property_id);

        $propiedad->state=0;
        $propiedad->update();      
        
        $client = Client::findOrFail($request->get('client_id'));
        $client->state=4;
        $client->update();
        return redirect()->route('ventas.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $propiedad = Property::select('properties.id','block','lot','surface','price','city','model')
        ->join('locations','locations.id','=','properties.location_id')
        ->join('types','types.id','=','properties.type_id')
        ->where('properties.state','=','1')
        ->get();
        
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $clientes = Client::select('clients.id','name','last_name')
            ->join('people','people.id','=','clients.person_id')
            ->where('clients.state','!=',0)
            ->paginate(8);
        }else{
            $clientes = Client::select('clients.id','name','last_name')
            ->join('people','people.id','=','clients.person_id')
            ->where('clients.state','!=',0)
            ->where('user_id','=',$userId)
            ->paginate(8);
        }
        
        $client = Client::select('clients.id','name','last_name')
        ->join('sales','clients.id','=','client_id')
        ->join('people','people.id','=','clients.person_id')
        ->where('clients.state','!=',0)
        ->where('sales.id','=',$id)
        ->first();

        $propied = Property::select('properties.id','block','lot','surface','price','city','model')
        ->join('sales','properties.id','=','property_id')
        ->join('locations','locations.id','=','properties.location_id')
        ->join('types','types.id','=','properties.type_id')
        ->where('sales.id','=',$id)
        ->first();

        $venta = Sale::findOrFail($id);
        return view('ventas.editar', compact('propiedad','clientes','venta','client','propied'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
