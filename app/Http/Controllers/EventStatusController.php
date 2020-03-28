<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventStatus;
use App\Event;
use App\User;
use DB;

class EventStatusController extends Controller
{
    public $successStatus = 200;

    public function index()
    {

    }

    public function store(Request $request)
    {
        $input = $request->all();
        EventStatus::create($input);
        Event::where('id', $input['event_id'])
        ->update([
            'count' => DB::raw('count+1') 
        ]);
        return response()->json([
            'success' => true,
            'message' => 'You Join This Event !'
        ], $this->successStatus);
    }

    public function show(Request $request, $id)
    {
        $events = DB::table('event_status')
            ->join('users', 'event_status.user_id', '=', 'users.id')
            ->join('event_register', 'event_status.event_id', '=', 'event_register.id')
            ->select('users.name', 'status', 'event_register.*')
            ->where('event_status.user_id', '=', $id)
            ->get();
        return response()->json([
            'success' => true,
            'events' => $events
        ], $this->successStatus);
    }
}
