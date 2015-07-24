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


Route::get('api/v1/', function () {
    return view('welcome');
});


/*Route::get('auth/api', ['middleware' => 'auth.basic.once', function() {
    // Only authenticated users may enter...
}]);*/

//REST routing!
Route::resource('api/v1/calendars', 'CalendarsController');
Route::resource('api/v1/calendars.events', 'CalendarEventController');
