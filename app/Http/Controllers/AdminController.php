<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class AdminController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function show($adminId)
    {
        $adminEvents = Event::where('user_id', $adminId)->get();
        return response()->json([
            'success' => true,
            'events' => $adminEvents
        ], $this->successStatus);
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
    public function updateEvent(Request $request, $id)
    {
        $input = $request->all();
        $event = Event::find($id);
        $input['event_startTime'] = date('H:i', strtotime($input['event_startTime']));
        $input['event_endTime'] = date('H:i', strtotime($input['event_endTime']));
        $input['event_date'] = date("Y-m-d",strtotime($input['event_date']));
        $event->update($input);
        return response()->json([
            'success' => true,
            'message' => 'success update event'
        ], $this->successStatus);
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
