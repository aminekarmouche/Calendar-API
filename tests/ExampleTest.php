<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
/*    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }*/

    public function testApi()
    {
        $user = factory('App\User')->create();
        $this->withSession([
                'name' => 'amine'
                ])
             ->visit('/')
             ->see('Laravel 5');
            var_dump($user);

        /*$this->actingAs($user)
             ->withSession(['email' => 'amine@gmail.com',
                            'password' => bcrypt('secret')
                            ])
             ->visit('/')
             ->see('Laravel 5');
        */
    }
}
