<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Calendar;
use Auth, DB, Input;
use Validator;
use App\Helpers\helpers;

class CalendarEventController extends Controller
{
    private $user;
    //Constructor
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of all events of a certain calendar
     * @param int $calendar_id
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
                
                $ical_events[] = array();
                foreach ($events as $event) {
                    $ical_events[] = event_to_ical($event);
                }
                return($ical_events);

            } else {
                return $events;    
            }            
        } catch(Exception $e) 
        {
            return response($e->getMessage(), 404);
        }

        
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  Request  $request
     * @param  int  $calendar_id
     * @return Response
     */
    public function store(Request $request, $calendar_id)
    {
        $rules = [
            'summary' => 'required',
            'start' => 'required|date|before:end',
            'end' => 'required|date'
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        } else {
            $event = Event::create([
            'summary' => $request->summary,
            'start' => $request->start, 
            'end' => $request->end,
            'calendar_id' => $calendar_id,
                ]);
            $event->save();
            return response($event, 201);  
        }
    }

    /**
     * Display the specified event.
     *
     * @param  int  $calendar_id
     * @param  int  $ event_id
     * @return Response
     */
    public function show($calendar_id, $event_id)
    {
        try 
        {        
            if (Input::get('format') == 'ical') {

                $event = Event::find($event_id);

                $ical_event = event_to_ical($event);
                return $ical_event;
            } else {

                $event = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                             ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                             ->where('user_id', $this->user->id)
                                             ->where('calendars.id', $calendar_id)
                                             ->where('events.id', $event_id)
                                             ->get();
                return $event;                                
            }
        } catch(ModelNotFoundException $e) 
        {
            return response('Not Found!', 404);
        }
    }

    /**
     * Update the specified event in storage.
     *
     * @param  Request  $request
     * @param  int  $calendar_id
     * @param  int  $ event_id
     * @return Response
     */
    public function update(Request $request, $calendar_id, $event_id)
    {   
        try
        {
            $rules = [
                'start' => 'date|before:end',
                'end' => 'date'
            ];

            $messages = [
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response($validator->errors(), 400);
            } 
            $event_id = DB::table('events')->join('calendars', 'events.calendar_id', '=', 'calendars.id')
                                             ->select('events.id', 'events.summary', 'events.start', 'events.end', 'events.calendar_id')
                                             ->where('user_id', $this->user->id)
                                             ->where('calendars.id', $calendar_id)
                                             ->where('events.id', $event_id)
                                             ->first()->id;
            
            $event = Event::findOrFail($event_id);
            $event->fill(\Request::all());
            $event->save();
            return response($event, 200);

        } catch(ModelNotFoundException $e) 
        {
            return response('Event not found!', 404);
        }  
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  int  $calendar_id
     * @param  int  $ event_id
     * @return Response
     */
    public function destroy($calendar_id, $event_id)
    {
        try
        {
            DB::table('events')->where('events.id', $event_id)
                                    ->where('calendar_id', $calendar_id)
                                    ->delete();
        } catch(ModelNotFoundException $e) 
        {
            return response('Event not found!', 404);
        }
    }


}
