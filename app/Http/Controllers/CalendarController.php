<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Event;
use Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        if($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                      ->whereDate('end',   '<=', $request->end)
                      ->where('user_id','=',$userId)
                      ->get(['id', 'title', 'start', 'end']);
 
            return response()->json($data);
       }

       return view('calendario.index');
    }
    public function create()
    {

    }
    public function ajax(Request $request)
    {
        $userId = Auth::id();
        switch ($request->type) {
            case 'add':
               $event = Event::create([
                   'title' => $request->title,
                   'start' => $request->start,
                   'end' => $request->end,
                   'user_id' => $userId
               ]);
             return response()->json($event);
              break;
   
            case 'update':
               $event = Event::find($request->id)->update([
                   'title' => $request->title,
                   'start' => $request->start,
                   'end' => $request->end,
               ]);
  
              return response()->json($event);
              break;
   
            case 'delete':
               $event = Event::find($request->id)->delete();
   
             return response()->json($event);
              break;
              
            default:
              # code...
              break;
            }
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
