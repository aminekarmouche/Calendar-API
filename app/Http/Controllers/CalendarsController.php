<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar; 
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Input, DB, Validator;

class CalendarsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display all calendars 
     *
     * @return Mixed
     */
    public function index()
    {   
        /*$calendars = Calendar::where('user_id', $this->user->id)->get();
        $ical_calendars = array();*/

        //using eloquent
        $calendars = $this->user->calendars->all();
        
        try {            
            if (Input::get('format') == 'ical') {
                foreach ($calendars as $calendar) {
                    $cal = calendar_to_ical($calendar);
                    $ical_calendars[] = $cal->render();
                }
                return $ical_calendars;
            }
            else {
                return $calendars;
            }   
           } catch (ModelNotFoundException $e) {
               return response($e->getMessage(), 404);
           }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'summary' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'timezone' => 'required|timezone'
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'timezone' => 'The :attribute field should be a valid timezone',
            'string' => 'The :attribute field be a string'
        ];

        try
        {
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response($validator->errors(), 400);
            } else {

                $calendar = new Calendar;
                $calendar->summary = $request->summary;
                $calendar->description = $request->description;
                $calendar->location = $request->location;
                $calendar->timezone = $request->timezone;
                $calendar->user_id = $this->user->id;

                $calendar->save();
                return response($calendar, 201);    
            }
        } catch (Exception $e)
        {
            return response($e->getMessage(), 404);
        }
    }


    /**
     * Display a specific calendar 
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
        try {
            //get calendar
            $calendar = $this->user->calendars->find($id);

            if (Input::get('format') == 'ical') {

                return calendar_to_ical($calendar)->render();        
            } else {
                return response($calendar, 200);
            }
        } catch (ModelNotFoundException $e) {
            return response('Calendar Not Found!', 404);
        }     
    }

    /**
     * Update the specified calendar information
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $rules = [
            'summary' => 'string',
            'description' => 'string',
            'location' => 'string',            
            'timezone' => 'timezone'
            ];

            $messages = [
                'timezone' => 'The :attribute field should be a valid timezone',
                'string' => 'The :attribute field be a string'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response($validator->errors(), 400);
            } else {
                $calendar = $this->user->calendars->find($id);

                $calendar->fill(\Request::all());
                $calendar->save();
                return response($calendar, 200);
            } 

            

        } catch(ModelNotFoundException $e) 
        {
            return response($e->getMessage(), 404);
        }
    }
    
    /**
     * Remove the a specific calendar
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
                
                $calendar = $this->user->calendars->find($id);
                $calendar->delete();
                return response('Calendar Deleted!', 200);
            } catch(ModelNotFoundException $e) 
            {
                return response('Calendar not found!', 404);
            }  
    }

    /**
     * Clear all associated events of a certain calendar
     *
     * @param  int  $id
     * @return Response
     */
    public function clear($id)
    {
        try {
            /*DB::table('events')->where('events.calendar_id', $id)
                               ->delete();*/
            $events = $this->user->calendars->find($id)->events->all();
            foreach ($events as $event) {
                $event->delete();
            }
            return response('Events Deleted!', 200);
        } catch (ModelNotFoundException $e) {
            return response('Calendar not found!', 404);
        }
    }
}
