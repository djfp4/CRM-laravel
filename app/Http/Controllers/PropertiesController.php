<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Type;
use App\Models\Location;


class PropertiesController extends Controller
{
    public function index()
    {
        $propiedad = Property::select('properties.id','block','lot','surface','price','city','model','properties.state')
        ->join('locations','locations.id','=','properties.location_id')
        ->join('types','types.id','=','properties.type_id')
        
        ->paginate(8);
        return view('propiedad.index', compact('propiedad'));
    }

    public function create()
    {
        $locacion   = Location::all();
        $modelo     = Type::all();
        return view('propiedad.crear', compact('locacion','modelo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'block'=>'required',
            'lot'=>'required',
            'surface'=>'required',
            'price'=>'required'
        ]);

        Property::create($request->all());
        return redirect()->route('propiedad.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $locacion   = Location::all();
        $modelo     = Type::all();
        $propiedad  = Property::findOrFail($id);
        return view('propiedad.editar', compact('locacion','modelo','propiedad'));
    }

    public function update(Request $request, Property $propiedad)
    {
        $this->validate($request, [
            'block'=>'required',
            'lot'=>'required',
            'surface'=>'required',
            'price'=>'required'
        ]);
        
        $propiedad->update($request->all());
        return redirect()->route('propiedad.index');
    }

    public function destroy(Property $propiedad)
    {
        $propiedad->state = 0;
        $propiedad->update();
        
        return redirect()->route('propiedad.index');
    }
}
