<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar; 
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use DB;

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
        try {
            $calendars = Calendar::where('user_id', $this->user->id)->get();
            return $calendars;   
           } catch (Exception $e) {
               return response($e->getMessage(), 500);
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
        if (!Auth::user()) {
            return response('You are not logged in!', 401);
        } else 
        {
            $calendar = Calendar::create([
            'summary' => $request->summary,
            'description' => $request->description, 
            'location' => $request->location,
            'timezone' => $request->timezone,
            'user_id' => $this->user->id,
                ]);
            $calendar->save();    
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
        if (!Auth::user()) {
            return response('You are not logged in!', 401);
        } else {
            try {
                return Calendar::find($id)->where('user_id', '=', $this->user->id)
                                          ->where('id', $id)
                                          ->get();
                } catch (Exception $e) {
                    return response('Calendar Not Found!', 404);
                }    
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
        if(!Auth::user())
        {
            return response('You are not logged in!', 401);
        } else {
            $calendar = Calendar::find($id)->where('user_id', '=', $this->user->id)
                                           ->update([
                                            'summary' => $request->summary,
                                            'description' => $request->description, 
                                            'location' => $request->location,
                                            'timezone' => $request->timezone
                                            ]);
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
        $calendar= Calendar::find($id);
        $calendar->delete();
    }

    /**
     * Clear  all associated event
     *
     * @param  int  $id
     * @return Response
     */
    public function clear($id)
    {
        DB::table('events')->where('events.calendar_id', $id)
                           ->delete();
    }

    public function ical($id)
    {
        $calendar = Calendar::find($id);
        $vCalendar = new \Eluceo\iCal\Component\Calendar();
        return ($vCalendar);
        
    }
}
