<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $modulo = Module::select('modules.id','modules.name','modules.description')
        ->get();
        return view('leccion.crear',compact('modulo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'module_id'=>'required'
        ]);

        Lesson::create($request->all());
        return redirect()->route('curso.index');
    }

    public function show($id)
    {
        $modulo = Module::select('id','name','description','course_id')
        ->where('id','=',$id)
        ->first();

        $curso = Course::select('courses.id','courses.name','courses.description','courses.duration','users.name as primer','users.last_name')
        ->join('users','users.id','=','user_id')
        ->where('courses.id','=', $modulo->course_id)
        ->first();

        $leccion = Lesson::select('id','name','description')
        ->where('module_id','=',$id)
        ->paginate(8);

        return view('leccion.show',compact('curso','modulo','leccion'));
    }

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
