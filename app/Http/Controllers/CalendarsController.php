<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Input;

class CalendarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $calendars = Calendar::where('user_id', $user->id)->get();
        return $calendars;
    }

    /**
     * Create a new calendar for the authenticated user.
     *
     * @return Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $calendar = Calendar::create([
        'summary' => $request->summary,
        'description' => $request->description, 
        'location' => $request->location,
        'timezone' => $request->timezone,
        'user_id' => $user->id,
            ]);
        $calendar->save();
    }

    /**
     * Display a specific calendar
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        return Calendar::find($id)->where('user_id', $user->id)->get();
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
        $calendar = Calendar::find($id);

/*        $calendar->summary = $request->summary;
        $calendar->description = $request->description; 
        $calendar->location = $request->location;
        $calendar->timezone = $request->timezone;*/
        
        //$calendar->save();
        $user = Auth::user();
        Calendar::where('id', $id)
                  ->where('user_id', $user->id)
                  ->update([
                    'summary' => $request->summary,
                    'description' => $request->description, 
                    'location' => $request->location,
                    'timezone' => $request->timezone,
                    ]);

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
}
