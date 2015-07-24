<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//seeding two users
        $firstUser = DB::table('users')->insertGetId([
            'name' => 'first',
            'email' => 'first@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $secondUser = DB::table('users')->insertGetId([
            'name' => 'second',
            'email' => 'second@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $this->command->info('Users are created!');

        //creating a calendar
        $calendar1 = DB::table('calendars')->insertGetID([
        	'summary' => 'Personal Calendar',
        	'description' => 'A personal calendar for things outside work!',
        	'location' => 'Morocco',
        	'timezone' => 'GMT',
        	'user_id' => $firstUser,
        	]);
        $this->command->info('Calendar1 is created!');

        $event1 = DB::table('events')->insertGetID([
        	'start' => '',
        	'end' => '',
        	'summary' => 'meeting with my friends for coffee!',
        	'calendar_id' => $calendar1,
        	]);
        $this->command->info('Event is created!');
		$this->command->info($event1);
    }
}
