<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;


class CalendarsControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $client;

    //setUp function
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed();
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:9000/api/v1/', 'auth' => ['first@gmail.com', 'secret']]);
    }

    //overloading get post put patch and delete methods
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
        {
            return $this->call($method, $args[0]);
        }
     
        throw new BadMethodCallException;
    }

    public function test_index_calendars()
    {
        //testing json format
        $uri = 'calendars';

        //200 response
        $response = $this->client->get($uri);
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);



        //testing iCal format
        $uri = 'calendars?format=ical';
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);


    }

    public function test_show_calendar(){
        
        $uri = 'calendars/1';

        $response = $this->client->get($uri, [
                'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json'
            ]
        ]);
        $data = json_decode($response->getBody(true), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
        $this->assertArrayHasKey('summary', $data);

        

        /*$this->assertEquals('application/json', 
        $response->getHeader('Content-Type'));*/

    }

    public function test_store_calendar()
    {
        /*$uri = 'calendars';

        $response = $this->client->post($uri, [
            'form_params' => ['summary' => 'my summary',
                              'desciption' => 'A random testing calendar',
                              'location' => 'Here',
                              'timezone' => 'GMT+1'
                       ]
        ]);
        $this->assertEquals(201, $response->getStatusCode());*/

    }

    public function test_update_calendar()
    {
        $uri = 'calendars/1';
        $test_summary = 'test summary';

        $response = $this->client->put($uri, [
            'form_params' => ['summary' => 'test summary',
                              'timezone' => 'GMT+5'
                              ]
        ]);

        //add assertions
        $this->assertEquals(200, $response->getStatusCode());

/*        //testing validations
        $this->assertEquals(400, $this->client->put($uri, [
            'form_params' => ['timezone' => '5']
        ])->getStatusCode());*/

        
        //timezone":["The timezone field should be a valid timezone
    }

    public function test_delete_calendar()
    {
        $uri = 'calendars/1';
        
        $response = $this->client->delete($uri);

        $this->assertEquals(200, $response->getStatusCode());

/*        $response_del = $this->client->get($uri);
        $this->assertEquals(404, $response_del->getStatusCode());*/

    }

    public function test_clear_calendar_events()
    {
        /*$uri= 'calendar/1/clear';
        
        $response = $this->client->delete($uri);
        */

        //Assertions
    }
}