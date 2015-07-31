<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{   
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'events';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */ 
    protected $fillable = [
    	'start',
    	'end',
    	'summary',
        'calendar_id'
    ];

   /* *
    * The attributes that should be mutated to dates.
    *
    * @var array*/
    
    protected $dates = ['start', 'end'];

    /**
    * Gets the event's calendar
    */
    public function calendar()
    {
        return $this->belongsTo('App\Calendar');
    }
}
