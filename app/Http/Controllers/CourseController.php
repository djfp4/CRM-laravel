<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\User;

class CourseController extends Controller
{
    

    public function index()
    {
        $curso = Course::select('courses.id','courses.name','courses.description','courses.duration','people.name as primer','people.last_name','price')
        ->join('users','users.id','=','user_id')
        ->join('people','people.id','=','person_id')
        ->where('courses.state','=',1)
        ->paginate(8);
        return view('curso.index',compact('curso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id','name','last_name')
        ->where('state','=',1)
        ->get();
        return view('curso.crear', compact('user'));
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
            'description'=>'required',
            'duration'=>'required',
            'user_id'=>'required'
        ]);

        Course::create($request->all());
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
        $user = User::select('users.id','name','last_name')
        ->join('people','person_id','=','people.id')
        ->where('state','=',1)
        ->get();
        $curso = Course::findOrFail($id);
        return view('curso.editar', compact('user','curso'));
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
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'duration'=>'required',
            'user_id'=>'required'
        ]);

        $curso = Course::findOrFail($id);
        $curso->update($request->all());
        return redirect()->route('curso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $curso = Course::findOrFail($id);
        $curso->state=0;
        $curso->update();
        return redirect()->route('curso.index');
    }
}
