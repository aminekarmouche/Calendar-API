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

    public function testBasicExample()
    {


/*        $user = factory(App\User::class)->create([
            'name' =>'amine',
            'email' => 'amine2@gmail.com',
            'password' => bcrypt('secret')
            ]);*/

        //$this->seeInDatabase('users', ['email' => 'first@gmail.com']);
        //$this->actingAs($user)->visit('/');
 

/*        $this->visit('/')
             ->see('Laravel 5');
       $user = factory(App\User::class)->create([
            'name' =>'amine',
            'email' => 'amine@gmail.com',
            'password' => bcrypt('secret')
            ]);

        $this->withSession(['foo' => 'bar'])
             ->visit('/');
        $this->actingAs($user)
             ->get('/');
             
    }

    public function testApi()
    {
        $user = factory('App\User')->create();
        $this->withSession([])
             ->visit('/');

        $this->actingAs($user)
             ->withSession(['email' => 'amine@gmail.com',
                            'password' => bcrypt('secret')
                            ])
             ->visit('/')
             ->see('Laravel 5');
        
    }



    public function shouldAuthenticateUsingAllGivenParameters($login, $password, $method)
    {
        $httpClient = $this->getHttpClientMock();
        $httpClient->expects($this->once())
            ->method('authenticate')
            ->with($login, $password, $method);
        $client = new Client($httpClient);
        $client->authenticate($login, $password, $method);
*/
    }
    

}
