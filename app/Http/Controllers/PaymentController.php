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
use App\Models\Student;
use App\Models\Group;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago = Payment::select('payments.id','courses.name as curso','people.name','people.last_name'  ,'payments.type')
        ->join('courses','payments.course_id','=','courses.id')
        ->join('clients','payments.client_id','=','clients.id')
        ->join('people','clients.person_id','=','people.id')
        ->join('users','payments.user_id','=','users.id')
        ->where('payments.state','=',1)
        ->paginate(8);

        return view('pago.index', compact('pago'));
    }

    public function create()
    {
        $grupo = Group::all();
        $curso = Course::all();
        $cliente = CLient::select('clients.id','name','last_name')
        ->join('people','clients.person_id','=','people.id')
        ->where('state','!=',0)
        ->get();
        $user = User::select('users.id','name','last_name')
        ->join('people','users.person_id','=','people.id')
        ->where('state','=',1)
        ->get();

        return view('pago.crear', compact('curso','cliente','user','grupo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id'=>'required',
            'course_id'=>'required',
            'user_id'=>'required'
        ]);

        Payment::create($request->all());

        $pago = Payment::select('id')
        ->where('client_id','=',$request->client_id)
        ->first();

        $payment_detail = new Payment_detail();
                $payment_detail->mont=$request->get('mont');
                $payment_detail->date=$request->get('date');
                $payment_detail->payment_id=$pago->id;
                $payment_detail->save();

        $student = new Student();
        $student->group_id=$request->get('group_id');
        $student->client_id=$request->get('client_id');
        $student->save();

        return redirect()->route('pago.index');
    }

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
        $curso = Course::all();
        $cliente = CLient::select('clients.id','name','last_name')
        ->join('people','clients.person_id','=','people.id')
        ->where('state','!=',0)
        ->get();
        $user = User::select('users.id','name','last_name')
        ->join('people','users.person_id','=','people.id')
        ->where('state','=',1)
        ->get();
        $pago = Payment::findOrFail($id);
        $pago_d = Payment_detail::select('id','mont','date')
        ->where('payment_id','=',$id)
        ->first();

        return view('pago.editar', compact('curso','cliente','user','pago','pago_d'));
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
