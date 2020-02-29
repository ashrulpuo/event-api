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
        return response()->json([
            'success' => true,
            'message' => 'You Join This Event !'
        ], $this->successStatus);
    }

    public function show(Request $request)
    {
        $userId = $request->all();
        // $events = User::find(8)->events;
        $events = DB::table('event_status')
        ->join('user', 'event_status.user_id', '=', 'user.id')
        ->select('event_status.id', 'event_status.user_id')
        // ->where('user.id', $userId)  
        ->get();
        dd($events); 
    }
}
