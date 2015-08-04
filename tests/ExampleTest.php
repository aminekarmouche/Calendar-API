<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use GuzzleHttp\Client;

require('vendor/autoload.php');

class ExampleTest extends TestCase
{



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

    public function test_not_authenticated_user()
    {
    }
}
