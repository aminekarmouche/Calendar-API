<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calendars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'summary',
		'description',
		'location',
		'timezone',
        'user_id' 
    ];
    
    /**
     * Gets the calendar user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets the a calendar's events
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
