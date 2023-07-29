<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Payment_detail;

class PaymentDetailController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $pago_detalle = Payment_detail::select('id','mont','date')
        ->where('payment_id','=',$id)
        ->where('payment_details.state','=',1)
        ->paginate(8);

        $cliente = Payment_detail::select('people.name','people.last_name','courses.name as curso','courses.price')
        ->join('payments','payments.id','=','payment_id')
        ->join('clients','payments.client_id','=','clients.id')
        ->join('people','clients.person_id','=','people.id')
        ->join('courses','payments.course_id','=','courses.id')
        ->where('payment_details.state','=',1)
        ->first();

        $deuda = Payment_detail::selectRaw('sum(mont) as pago')
        ->where('payment_id','=',$id)
        ->first();
        $falta = intval($cliente->price) - intval($deuda->pago);
        return view('pago_detalle.show', compact('pago_detalle','cliente','falta'));
    }

    public function edit($id)
    {
        //
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
