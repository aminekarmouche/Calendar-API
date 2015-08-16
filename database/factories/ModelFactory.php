<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

/*
$factory->define(App\Calendar::class, function ($faker) {
	return [
		'summary' => $faker->summary,
		'description' => $faker->description,
		'location' => $faker->location,
		'timezone' => $faker->timezone,
		//'user_id' => $factory(App\User::class)->create()->id
	];
});
*/

$factory->define(App\Event::class, function ($faker) {
	return [
		'summary' => $faker->word,
        'start' => $faker->dateTime,
    	'end' => $faker->dateTime($max = '2014-02-25 08:37:17')
	];	
});

$factory->define(App\Calendar::class, function ($faker) {
	return [
		'summary' => $faker->word,
		'description' => $faker->text,
		'location' => $faker->address,
		'timezone' => $faker->timezone
		//'user_id' => $faker->$factory(App\User::class)->create()->id
		//'user_id' => $factory(App\User::class)->create()->id
	];	
});
