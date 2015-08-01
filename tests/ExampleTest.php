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

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed();

        $user = Auth::loginUsingId(2);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function test_not_authenticated_user()
    {
        // Most tests will assume a logged in user
        // But not this one.
        Auth::logout();
        $response = $this->call('GET', '/');    
        $this->assertEquals('Invalid credentials.', $response->getContent());
    }

    public function test_provide_error_feedback()
    {

    }
}
