<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

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

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testBasicExample()
    {
        /*$client = new GuzzleHttp\Client();
        $response = $client->get('http://localhost:9000/', ['auth' =>  ['first@gmail.com', 'secret']]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $client->get('http://localhost:9000/calendars', ['auth' =>  ['first@gmail.com', 'secret']]);
        $this->assertEquals(200, $response->getStatusCode());*/
    }

    


    

}
