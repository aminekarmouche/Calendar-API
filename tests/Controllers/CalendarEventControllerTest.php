<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;

class CalendarEventControllerTest extends TestCase
{
	public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed();
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:9000/api/v1/', 'auth' => ['first@gmail.com', 'secret']]);
    }

    public function test_index_events()
    {
        $uri = 'calendars/1/events';
        $response = $this->client->get($uri);
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function test_show_event()
        {
            $uri = 'calendars/1/events/1';
            $response = $this->client->get($uri);
            $this->assertEquals(200, $response->getStatusCode());
        } 
        

    public function test_store_event()
    {
/*
        $uri = 'calendars/1/events';

        $response = $this->client->post($uri, [
            'form_params' => ['summary' => 'my summary',
                       'start' => 'A random testing calendar',
                       'end' => 'Here',
                       'calendar_id' => '1'
                       ]
        ]);*/
    }
    public function test_update_event()
    {
/*        $uri = 'calendars/1/events/1';

        $response = $this->client->put($uri, [
            'form_params' => ['summary' => 'modified'               ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
*/
    }
    public function test_delete_event()
    {
        /*
        $uri = 'calendars/1/events/1';
        $response = $this->client->delete($uri);

        $response_del = $this->client->get($uri);
        $this->assertEquals(200, $response_del->getStatusCode());
        */
    }

}