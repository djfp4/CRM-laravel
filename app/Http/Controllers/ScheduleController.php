<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Client;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\User;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario = Schedule::all();
        return view('horario.index', compact('horario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupo = Group::select('groups.id','groups.name','courses.name as curso')
        ->join('courses','courses.id','=','course_id')
        ->where('groups.state','=',1)
        ->get();
        return view('horario.crear', compact('grupo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'group_id'=>'required'
        ]);
        Schedule::create($request->all());
        return redirect()->route('curso.index');
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
        $grupo = Group::select('groups.id','groups.name','courses.name as curso')
        ->join('courses','courses.id','=','course_id')
        ->where('groups.state','=',1)
        ->get();
        $horario = Schedule::findOrFail($id);
        return view('horario.crear', compact('grupo','horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->validate($request, [
            'day'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'group_id'=>'required'
        ]);
        $schedule->update($request->all());
        return redirect()->route('schedule.index');
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
