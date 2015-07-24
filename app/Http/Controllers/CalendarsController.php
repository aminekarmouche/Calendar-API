<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class CalendarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //return in json
        $calendars = Calendar::all();
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
        Calendar::create([
            'summary' => 'Personal Calendar',
            'description' => 'A personal calendar for things outside work!',
            'location' => 'Morocco',
            'timezone' => 'GMT',
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Display a specific calendar
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Calendar::find($id);
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
