<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;

require('vendor/autoload.php');

class ExampleTest 
{
    use DatabaseMigrations;

        public function setUp()
    {
        
        parent::setUp();
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:9000/api/v1/', 'auth' => ['first@gmail.com', 'secret']]);
        //Artisan::call('migrate');
        //Artisan::call('db:seed');
        //$this->call("DatabaseSeeder");

            }
    
/*    //overloading get post put patch and delete methods
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
        {
            return $this->call($method, $args[0]);
        }
     
        throw new BadMethodCallException;
    }*/





    /**
     * A basic functional test example.
     *
     * @return void
     */

    

    public function test_database()
    {
        $users = App\User::all();
        foreach ($users as $user) {
            echo($user->id);
        }
        //Auth::loginUsingId(2);
        $response = $this->client->get('calendars');

        //dd($response->getStatusCode());
        //dd($this->client);
        
        //$this->assertEquals(200, $response->getStatusCode());
        //  $data = json_decode($response->getBody(true), true);
        
        //dd($this->client);
        
        //$response = $this->client->get('calendars');
        //dd($response);

        

        //200 response
        //$response = $this->client->get($uri);
        //$this->assertEquals(200, $response->getStatusCode());
        //$data = json_decode($response->getBody(true), true);

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

        //$user = factory(App\User::class)->create();
        //$calendar = factory(App\Calendar::class)->make();
        
        //$calendar->create();

        //$calendar->user_id = $user->id;
        //dd($calendar->summary);
        
        //$calendar->create();
        
        //$events = factory(App\Event::class, 2)->make();
        //dd($calendars->toArray());

    }
}
