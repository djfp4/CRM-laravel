<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\monitoring;
use App\Models\monitoring_detail;
use Auth;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $seguir = monitoring_detail::select('name','last_name','ci','phone','client_id')
            ->join('monitorings','monitorings.id','=','monitoring_id')
            ->join('users','users.id','=','user_id')
            ->join('clients','clients.id','=','client_id')
            ->join('people','clients.person_id','=','people.id')
            ->groupBy('clients.name')
            ->paginate(8);
        }else{
            $seguir = monitoring_detail::select('name','last_name','ci','phone','client_id')
            ->join('monitorings','monitorings.id','=','monitoring_id')
            ->join('users','users.id','=','user_id')
            ->join('clients','clients.id','=','client_id')
            ->join('people','clients.person_id','=','people.id')
            ->where('monitorings.user_id','=',$userId)
            ->groupBy('client_id')
            ->paginate(8);
        }
        return view('seguimiento.index', compact('seguir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $cliente = Client::select('clients.id','name','last_name')
        ->join('people','person_id','=','people.id')
        ->where('clients.state','!=',0)
        ->where('user_id','=',$userId)
        ->get();
        return view('seguimiento.crear', compact('cliente'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'activitie'=>'required',
            'date'=>'required',
            'client_id'=>'required',
        ]);
        $userId = Auth::id();
        
        $client = monitoring::select('id')
        ->where('client_id','=',$request->client_id)
        ->where('state','!=',0)
        ->exists();
        
        if ($client) {
            $d_monitoring = monitoring::select('id')
            ->where('client_id','=',$request->client_id)
            ->where('state','!=',0)
            ->first();

            $monitoring_d = new monitoring_detail();
                $monitoring_d->activitie=$request->get('activitie');
                $monitoring_d->date=$request->get('date');
                $monitoring_d->comment=$request->get('comment');
                $monitoring_d->monitoring_id=$d_monitoring->id;
                $monitoring_d->save();
        }else {
            $monitoring = new monitoring();
                $monitoring->user_id=$userId;
                $monitoring->client_id=$request->get('client_id');
                $monitoring->state=1;
                $monitoring->save();

            $d_monitoring = monitoring::select('id')
            ->where('client_id','=',$request->client_id)
            ->where('state','=',1)
            ->first();

            $monitoring_d = new monitoring_detail();
                $monitoring_d->activitie=$request->get('activitie');
                $monitoring_d->date=$request->get('date');
                $monitoring_d->comment=$request->get('comment');
                $monitoring_d->state=1;
                $monitoring_d->monitoring_id=$d_monitoring->id;
                $monitoring_d->save();
            
            $cliente = CLient::findOrFail($request->client_id);
            $cliente->state=3;
            $cliente->update();
        }
        return redirect()->route('seguimiento.index');
    }

    public function show($id)
    {
        $userId = Auth::id();
        $rol = User::select('role_id')
        ->join('model_has_roles','model_id','=','users.id')
        ->where('model_id','=',$userId)
        ->first();
        if($rol->role_id==1)
        {
            $seguir = monitoring_detail::select('monitoring_details.id','activitie','date','people.name','people.last_name')
            ->join('monitorings','monitorings.id','=','monitoring_id')
            ->join('users','users.id','=','user_id')
            ->join('clients','clients.id','=','client_id')
            ->join('people','clients.person_id','=','people.id')
            ->where('client_id','=',$id)
            ->where('monitoring_details.state','=',1)
            ->paginate(8);
            $cliente = Client::findOrFail($id);
        }else{
            $seguir = monitoring_detail::select('monitoring_details.id','activitie','date','people.name','people.last_name')
            ->join('monitorings','monitorings.id','=','monitoring_id')
            ->join('users','users.id','=','user_id')
            ->join('clients','clients.id','=','client_id')
            ->join('people','clients.person_id','=','people.id')
            ->where('monitorings.user_id','=',$userId)
            ->where('client_id','=',$id)
            ->where('monitoring_details.state','=',1)
            ->paginate(8);
            
            $cliente = Client::findOrFail($id);
        }
        return view('seguimiento.show', compact('seguir','cliente'));
    }

    public function edit($id)
    {
        $userId = Auth::id();
        $cliente = Client::select('clients.id','name','last_name')
        ->join('people','person_id','=','people.id')
        ->where('state','!=',0)
        ->get();
        $seguir_d = Monitoring::findOrFail($id);
        $seguir = monitoring_detail::select('id','activitie','date','comment')
        ->where('monitoring_id','=',$seguir_d->id)
        ->first();
        return view('seguimiento.editar', compact('cliente','seguir'));
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
