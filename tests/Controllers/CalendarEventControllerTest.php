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
        //testing json format
        $uri = 'calendars/1/events';

        $response = $this->client->get($uri);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);

        //testing iCal format
        $uri = 'calendars/1/events?format=ical';

        $response = $this->client->get($uri);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
    }

    public function test_show_event()
        {
            $uri = 'calendars/1/events/1';

            $response = $this->client->get($uri);

            $this->assertEquals(200, $response->getStatusCode());
        } 
        

    public function test_store_event()
    {

        $uri = 'calendars/1/events';

        $response = $this->client->post($uri, [
            'form_params' => ['summary' => 'my summary',
                              'start' => '2015-08-05 18:15:39',
                              'end' => '2015-09-05 18:15:39'
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());

    }
    public function test_update_event()
    {
        $uri = 'calendars/1/events/1';
        $test_summary = 'test summary';

        $response = $this->client->put($uri, [
            'form_params' => ['summary' => $test_summary
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }

    public function test_delete_event()
    {
        
        $uri = 'calendars/1/events/1';
        $response = $this->client->delete($uri);
        $this->assertEquals(200, $response->getStatusCode());
    }

}