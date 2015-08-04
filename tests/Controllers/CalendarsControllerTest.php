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

        $uri = 'calendars';

        //200 response
        $response = $this->client->get($uri);
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(true), true);
        
        //$this->assertArrayHasKey('id', $data);
        //$this->assertJson($data);

    }

    public function test_show_calendar(){
        
        $uri = 'calendars/1';
        $response = $this->client->get($uri);
        
        $this->assertEquals(200, $response->getStatusCode());


    }

    public function test_store_calendar()
    {
/*        $calendar_id = uniqid();
        $uri = 'calendars';

    $response = $this->client->post($uri, [
        'form_params' => ['summary' => 'my summary',
                   'desciption' => 'A random testing calendar',
                   'location' => 'Here',
                   'timezone' => 'GMT',
                   'user_id' => '2'
                   ]
    ]);*/

    }

    public function test_update_calendar()
    {
        $uri = 'calendars/1';

        $response = $this->client->put($uri, [
            'form_params' => ['summary' => 'hello'               ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function test_delete_calendar()
    {
        /*$uri = 'calendars/1';
        $response = $this->client->delete($uri);
*/
        //$response_del = $this->client->get($uri);
        //$this->assertEquals(200, $response_del->getStatusCode());

    }

    public function test_clear_calendar_events()
    {
        /*$uri= 'calendar1';
        $response = $this->client->delete($uri);
        */
    }
}