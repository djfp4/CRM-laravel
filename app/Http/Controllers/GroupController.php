<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Client;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Course;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo = Group::select('groups.id','groups.name','start','end','courses.name as curso')
        ->join('courses','courses.id','=','course_id')
        ->paginate(8);

        return view('grupo.index', compact('grupo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curso = Course::all();
        return view('grupo.crear',compact('curso'));
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
            'name'=>'required',
            'start'=>'required',
            'end'=>'required',
            'course_id'=>'required'
        ]);
        Group::create($request->all());
        return redirect()->route('grupo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Group::select('groups.id','groups.name','start','end')
        ->join('courses','courses.id','=','course_id')
        ->where('course_id','=',$id)
        ->paginate(8);

        $curso = Course::findOrFail($id)->first();

        return view('grupo.show', compact('grupo','curso'));
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
        $grupo = Group::findOrFail($id);
        return view('grupo.editar',compact('curso','grupo'));
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
