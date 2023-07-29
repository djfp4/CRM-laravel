<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;

class ModuleController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $curso = Course::select('courses.id','courses.name','courses.description','courses.duration')
        ->get();
        return view('modulo.crear',compact('curso'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'course_id'=>'required'
        ]);

        Module::create($request->all());
        return redirect()->route('curso.index');
    }

    public function show($id)
    {
        $curso = Course::select('courses.id','courses.name','courses.description','courses.duration','people.name as primer','people.last_name')
        ->join('users','users.id','=','user_id')
        ->join('people','person_id','=','people.id')
        ->where('courses.id','=',$id)
        ->first();

        $modulo = Module::select('id','name','description')
        ->where('course_id','=',$id)
        ->paginate(8);

        return view('modulo.show',compact('curso','modulo'));
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
