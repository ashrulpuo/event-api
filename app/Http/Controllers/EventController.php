<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'success' => true,
            'events' => $events
        ], $this->successStatus);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['event_startTime'] = date('H:i', strtotime($input['event_startTime']));
        $input['event_endTime'] = date('H:i', strtotime($input['event_endTime']));
        $input['event_date'] = date("Y-m-d",strtotime($input['event_date']));
        Event::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Event success created'
        ], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $detail = Event::find($event)->first();
        return response()->json([
            'success' => true,
            'eventDetail' => $detail
        ], $this->successStatus);
    }
}
