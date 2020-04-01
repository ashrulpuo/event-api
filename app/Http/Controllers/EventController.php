<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Interest;
use App\EventStatus;

class EventController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userStatus = EventStatus::select('event_id')->where('user_id', $id)->get()->toArray();
        $interest = Interest::select('interest')->where('user_id', $id)->get()->toArray();
        $events = Event::whereNotIn('event_category', $interest)->whereNotIn('id', $userStatus)->get()->toArray();
        $eventsInterest = Event::whereIn('event_category', $interest)->whereNotIn('id', $userStatus)->get()->toArray();

        $data = array_merge($eventsInterest, $events);
        return response()->json([
            'success' => true,
            'events' => $data
        ], $this->successStatus);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['event_startTime'] = date('H:i', strtotime($input['event_startTime']));
        $input['event_endTime'] = date('H:i', strtotime($input['event_endTime']));
        $input['event_date'] = date("Y-m-d",strtotime($input['event_date']));
        $input['count'] = 0;
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
    public function show($id)
    {
        // dd($id);
        $detail = Event::where('id', $id)->first();
        return response()->json([
            'success' => true,
            'eventDetail' => $detail
        ], $this->successStatus);
    }
}
