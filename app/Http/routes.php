<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});

/*Route::get('auth/api', ['middleware' => 'auth.basic.once', function() {
    // Only authenticated users may enter...
}]);*/

//REST routing!
Route::resource('calendars', 'CalendarsController');
Route::delete('calendars/{calendars}/clear', 'CalendarsController@clear');
Route::get('calendars/{calendars}/ical', 'CalendarsController@ical');
Route::resource('calendars.events', 'CalendarEventController');
Route::get('calendars/{calendars}/events/{events}/ical','CalendarEventController@ical');
