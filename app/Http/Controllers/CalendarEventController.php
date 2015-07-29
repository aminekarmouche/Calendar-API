<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $events = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                     ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                     ->where('user_id', $user->id)
                                     ->get();
        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $calendar_id)
    {
        $user = Auth::user();

        $event = Event::create([
        'summary' => $request->summary,
        'start' => $request->start, 
        'end' => $request->end,
        'calendar_id' => $calendar_id,
            ]);
        $event->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($calendar_id, $event_id)
    {
        $user = Auth::user();
        $event = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                     ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                     ->where('user_id', $user->id)
                                     ->where('events.id', $event_id)
                                     ->get();
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($calendar_id, $event_id)
    {
        $user = Auth::user();
        DB::table('events')->where('events.id', $event_id)
                                    ->where('calendar_id', $calendar_id)
                                    ->delete();
    }
}
