<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calendar;
use Auth, DB, Input;

class CalendarEventController extends Controller
{
    private $user;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($calendar_id)
    {
        try
        {
            $events = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                         ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                         ->where('user_id', $this->user->id)
                                         ->where('calendars.id', $calendar_id)
                                         ->get();

            if (Input::get('format') == 'ical') {

            } else {
                return $events;    
            }            
        } catch(Exception $e) 
        {
            return response($e->getMessage(), 500);
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $calendar_id)
    {
        if (Calendar::find($calendar_id)->user_id = $this->user->id)
        {
            $event = Event::create([
            'summary' => $request->summary,
            'start' => $request->start, 
            'end' => $request->end,
            'calendar_id' => $calendar_id,
                ]);
            $event->save();
        } else 
        {
            return response('You are not logged in!', 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($calendar_id, $event_id)
    {
        try 
        {        
            if (Input::get('format') == 'ical') {

                $event = Event::find($event_id);

                $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');
                $vEvent = new \Eluceo\iCal\Component\Event();

                $vEvent->setDtStart($event->start);
                $vEvent->setDtEnd($event->start);
                $vEvent->setNoTime(true);
                $vEvent->setSummary($event->summary);

                return ($vEvent);            

            } else {

                $event = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                             ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                             ->where('user_id', $this->user->id)
                                             ->where('calendars.id', $calendar_id)
                                             ->where('events.id', $event_id)
                                             ->get();
                return $event;                                
            }
        } catch(Exception $e) 
        {
            return response('Not Found!', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $calendar_id, $event_id)
    {
        try
        {
            $event = $event = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                         ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                         ->where('user_id', $this->user->id)
                                         ->where('calendars.id', $calendar_id)
                                         ->where('events.id', $event_id)
                                         ->update([
                                            'events.summary' => $request->summary,
                                            'events.start' => $request->start, 
                                            'events.end' => $request->end
                                            ]);
        } catch(Exception $e) 
        {
            return response($e->getMessage(), 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($calendar_id, $event_id)
    {
        try
        {
            DB::table('events')->where('events.id', $event_id)
                                    ->where('calendar_id', $calendar_id)
                                    ->delete();
        } catch(Exception $e) 
        {
            return response($e->getMessage(), 500);
        }
    }


}
