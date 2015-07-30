<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;

class CalendarsControllerTest extends TestCase
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

    //setUp function
	public function setUp()
    {
        parent::setUp();

    }

    //testing the index function
    public function test_index_calendars()
    {
        $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:9000', 'auth' => ['first@gmail.com', 'secret']]);

        $response = $client->get('calendars');
        $this->assertEquals(200, $response->getStatusCode());

        //$res = $this->get('/calendars');
        
        //decode to json
        $data = json_decode($response->getBody(true), true);
        $this->assertNotNull($data);
    }
    
    public function test_store_calendar()
    {
       

    }

    public function test_destroy_calendar()
    {

    }

    public function test_update_calendar()
    {

    }

    public function test_clear_calendar_events()
    {

    }

    public function test_show_calendar()
    {

    }

}