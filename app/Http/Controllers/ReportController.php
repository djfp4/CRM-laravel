<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\monitoring;
use App\Models\monitoring_detail;
use App\Models\Sale;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Credit;
use App\Models\Property;
use App\Models\Payment;
use App\Models\Payment_detail;
use App\Models\Person;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $userId = Auth::id();
        if(($request->get('fecha1'))==null)
        {
        $grafica1 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as control , people.name, people.last_name')
        ->join('monitorings','monitoring_id','=','monitorings.id')
        ->join('users','monitorings.user_id','=','users.id')
        ->join('clients','clients.id','=','monitorings.client_id')
        ->join('people','people.id','=','clients.person_id')
        ->groupBy('people.name','people.last_name')
        ->orderBy('control','desc')
        ->take(5)
        ->get();

        $grafica2 = sale::selectRaw('people.name, people.last_name, sum(sales.prices) AS venta')
            ->join('users','sales.user_id','=','users.id')
            ->join('people','people.id','=','users.person_id')
            ->groupBy('people.name','people.last_name')
            ->take(5)
            ->get();

        $mesActual = date('m');

        $grafica3 = sale::selectRaw('sum(sales.prices) AS venta')
        ->first();

        $puntos = [];
        foreach ($grafica1 as $hecho) {
            $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['control'])];
            $nom[] = [$hecho['name'].' '.$hecho['last_name']];
        }

        $puntos2 = [];
        foreach ($grafica2 as $hecho) {
            $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['venta'])];
            $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
        }

        }else{
            $fecha1 = $request->get('fecha1');
            $fecha2 = $request->get('fecha2');
            $grafica1 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as control , people.name, people.last_name')
            ->join('monitorings','monitoring_id','=','monitorings.id')
            ->join('users','monitorings.user_id','=','users.id')
            ->join('people','people.id','=','users.person_id')
            ->where('monitoring_details.date','>=',$fecha1)
            ->where('monitoring_details.date','<=',$fecha2)
            ->groupBy('people.name','people.last_name')
            ->orderBy('control','desc')
            ->take(5)
            ->get();

            $grafica2 = sale::selectRaw('people.name, people.last_name, sum(sales.prices) AS venta')
            ->join('users','sales.user_id','=','users.id')
            ->join('people','people.id','=','users.person_id')
            ->where('sales.created_at','>=',$fecha1)
            ->where('sales.created_at','<=',$fecha2)
            ->groupBy('people.name','people.last_name')
            ->take(5)
            ->get();

            $grafica3 = sale::selectRaw('sum(sales.prices) AS venta')
            ->where('sales.created_at','>=',$fecha1)
            ->where('sales.created_at','<=',$fecha2)
            ->first();

            $puntos = [];
            foreach ($grafica1 as $hecho) {
                $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['control'])];
                $nom[] = [$hecho['name'].' '.$hecho['last_name']];
            }

            $puntos2 = [];
            foreach ($grafica2 as $hecho) {
                $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['venta'])];
                $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
            }

        }
        // echo json_encode($puntos3);
        return view('reporte.anual', [   'data'=>json_encode($puntos), 
                                'dataNom'=>json_encode($nom),
                                'data2'=>json_encode($puntos2), 
                                'dataNom2'=>json_encode($nom2), 
                            ], compact('grafica3'));
        
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
