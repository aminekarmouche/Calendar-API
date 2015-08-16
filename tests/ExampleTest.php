<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Calendar;
use GuzzleHttp\Client;

require('vendor/autoload.php');

class ExampleTest extends TestCase
{

    use DatabaseTransactions;
    
    //overloading get post put patch and delete methods
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
        {
            return $this->call($method, $args[0]);
        }
     
        throw new BadMethodCallException;
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed();

/*        $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:9000', 'auth' => ['first@gmail.com', 'secret']]);
        $response = $client->get('calendars');
        dd($response);*/
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function test_database()
    {
        //$this->seeInDatabase('calendar', ['id' => '2']);

        /*factory(App\Calendar::class, 20)->create()
                                        ->each(function($calendar) {
                                            $calendar->relatedItems()->save(factory('App\User')->make());
                                        });*/
/*        $users = factory(App\User::class, 3)->create()
                                            ->each(function($u){
                                                $u->calendars()->save(factory('App\Calendar')->make());
                                            });*/
        /*$calendars = factory(App\Calendar::class)->create()
                                                 ->each(function($u){
                                                    $u->user()->save(factory('App\User')->make());
                                                 });*/
        
        //$calendars = factory(App\Calendar::class, 2)->create();
        //$events = factory(App\Event::class, 2)->make();
        //dd($calendars->toArray());

    }
}
