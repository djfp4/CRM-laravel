<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\model_has_role;

use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only'=>['index']]);
    }

    public function index(Request $request)
    {
        $userId = Auth::id();
        $role = model_has_role::select('role_id')
        ->where('model_id','=',$userId)
        ->first();
        switch($role->role_id)
        {
            case '1':
                $grafica1 = sale::selectRaw('count(sales.user_id) as ventas , people.name, people.last_name')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('ventas','desc')
                ->take(5)
                ->get();

                $grafica2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as cliente , people.name, people.last_name')
                ->join('monitorings','monitoring_details.monitoring_id','=','monitorings.id')
                ->join('clients','monitorings.client_id','=','clients.id')
                ->join('people','people.id','=','clients.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('cliente','desc')
                ->take(5)
                ->get();

                $puntos = [];
                foreach ($grafica1 as $hecho) {
                    $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['ventas'])];
                    $nom[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                $puntos2 = [];
                foreach ($grafica2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['cliente'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }
                return view('home', [   
                                'data'=>json_encode($puntos), 
                                'dataNom'=>json_encode($nom),
                                'data2'=>json_encode($puntos2), 
                                'dataNom2'=>json_encode($nom2)
                            ]);
                break;

                


            case '2':
                $grafica3 = sale::selectRaw('people.name, people.last_name, DATE(sales.created_at) AS fecha, DAY(sales.created_at) as dia, MONTH(sales.created_at) as mes, YEAR(sales.created_at) as anho')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->where('sales.user_id','=',$userId)
                ->take(5)
                ->get();

                $agente2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as control , people.name, people.last_name')
                ->join('monitorings','monitoring_id','=','monitorings.id')
                ->join('clients','clients.id','=','monitorings.client_id')
                ->join('users','monitorings.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->where('monitorings.user_id','=',$userId)
                ->groupBy('people.name','people.last_name')
                ->orderBy('control','desc')
                ->take(5)
                ->get();

                
                $puntos2 = [];
                $nom2 = [];
                foreach ($agente2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['control'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                $puntos3 = [];
                $venta = 0;
                for ($i=1; $i < 31; $i++) { 
                    foreach ($grafica3 as $hecho) {
                        if ($hecho->dia==$i) {
                            $venta++;
                            $puntos3[] = ['y'=>$hecho->fecha,'venta'=>$venta];
                        }
                         $puntos3[] = ['y'=>$hecho->anho."-".$hecho->mes."-".$i,'venta'=>$venta];
                        // $nom3[] = [$hecho['name'].' '.$hecho['last_name']];
                    }
                           
                }

                return view('agente', [   
                                'data'=>json_encode($puntos2), 
                                'dataNom'=>json_encode($nom2), 
                                'data3'=>json_encode($puntos3)
                            ]);
                break;
            case '3':
                $mesActual = date('m');

                $grafica3 = sale::selectRaw('people.name, people.last_name, DATE(sales.created_at) AS fecha, DAY(sales.created_at) as dia, MONTH(sales.created_at) as mes, YEAR(sales.created_at) as anho')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->where('sales.user_id','=',$userId)
                ->take(5)
                ->get();

                $agente2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as control , people.name, people.last_name')
                ->join('monitorings','monitoring_id','=','monitorings.id')
                ->join('clients','clients.id','=','monitorings.client_id')
                ->join('users','monitorings.user_id','=','users.id')
                ->join('people','people.id','=','clients.person_id')
                ->where('monitorings.user_id','=',$userId)
                ->groupBy('people.name','people.last_name')
                ->orderBy('control','desc')
                ->take(5)
                ->get();

                $puntos3 = [];
                $venta = 0;
                for ($i=1; $i < 31; $i++) { 
                    foreach ($grafica3 as $hecho) {
                        if ($hecho->dia==$i) {
                            $venta++;
                            $puntos3[] = ['y'=>$hecho->fecha,'venta'=>$venta];
                        }
                        
                        // $nom3[] = [$hecho['name'].' '.$hecho['last_name']];
                    }
                            $puntos3[] = ['y'=>$hecho->anho."-".$hecho->mes."-".$i,'venta'=>$venta];
                }
                $puntos2 = [];
                $nom2 = [];
                foreach ($agente2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['control'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                return view('agente', [   
                                'data'=>json_encode($puntos2), 
                                'dataNom'=>json_encode($nom2), 
                                'data3'=>json_encode($puntos3)
                            ]);
                break;
            case '4':
                $grafica1 = sale::selectRaw('count(sales.user_id) as ventas , people.name, people.last_name')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('ventas','desc')
                ->take(5)
                ->get();

                $grafica2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as cliente , people.name, people.last_name')
                ->join('monitorings','monitoring_details.monitoring_id','=','monitorings.id')
                ->join('clients','monitorings.client_id','=','clients.id')
                ->join('people','people.id','=','clients.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('cliente','desc')
                ->take(5)
                ->get();

                $puntos = [];
                foreach ($grafica1 as $hecho) {
                    $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['ventas'])];
                    $nom[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                $puntos2 = [];
                foreach ($grafica2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['cliente'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }
                return view('home', [   
                                'data'=>json_encode($puntos), 
                                'dataNom'=>json_encode($nom),
                                'data2'=>json_encode($puntos2), 
                                'dataNom2'=>json_encode($nom2)
                            ]);

                break;
            case '5':
                $grafica1 = sale::selectRaw('count(sales.user_id) as ventas , people.name, people.last_name')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('ventas','desc')
                ->take(5)
                ->get();

                $grafica2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as cliente , people.name, people.last_name')
                ->join('monitorings','monitoring_details.monitoring_id','=','monitorings.id')
                ->join('clients','monitorings.client_id','=','clients.id')
                ->join('people','people.id','=','clients.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('cliente','desc')
                ->take(5)
                ->get();

                $puntos = [];
                foreach ($grafica1 as $hecho) {
                    $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['ventas'])];
                    $nom[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                $puntos2 = [];
                foreach ($grafica2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['cliente'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }
                return view('home', [   
                                'data'=>json_encode($puntos), 
                                'dataNom'=>json_encode($nom),
                                'data2'=>json_encode($puntos2), 
                                'dataNom2'=>json_encode($nom2)
                            ]);
                break;

            case '6':
                return redirect()->route('credito.index');
                break;
            case '7':
                $grafica1 = sale::selectRaw('count(sales.user_id) as ventas , people.name, people.last_name')
                ->join('users','sales.user_id','=','users.id')
                ->join('people','people.id','=','users.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('ventas','desc')
                ->take(5)
                ->get();

                $grafica2 = monitoring_detail::selectRaw('count(monitoring_details.monitoring_id) as cliente , people.name, people.last_name')
                ->join('monitorings','monitoring_details.monitoring_id','=','monitorings.id')
                ->join('clients','monitorings.client_id','=','clients.id')
                ->join('people','people.id','=','clients.person_id')
                ->groupBy('people.name','people.last_name')
                ->orderBy('cliente','desc')
                ->take(5)
                ->get();

                $puntos = [];
                foreach ($grafica1 as $hecho) {
                    $puntos[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['ventas'])];
                    $nom[] = [$hecho['name'].' '.$hecho['last_name']];
                }

                $puntos2 = [];
                foreach ($grafica2 as $hecho) {
                    $puntos2[] = ['name'=>$hecho['name'],'y'=>floatval($hecho['cliente'])];
                    $nom2[] = [$hecho['name'].' '.$hecho['last_name']];
                }
                return view('home', [   
                                'data'=>json_encode($puntos), 
                                'dataNom'=>json_encode($nom),
                                'data2'=>json_encode($puntos2), 
                                'dataNom2'=>json_encode($nom2)
                            ]);
                break;
            case '8':
                return redirect()->route('usuario.index');
                break;
            case '9':
                return redirect()->route('grupo.index');
                break;
           
        
                            default:
                                # code...
                                break;
        }
        
    }
        
}
        

