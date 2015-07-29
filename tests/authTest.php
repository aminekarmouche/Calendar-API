 <?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Auth;

class authTest extends TestCase
{
	public function setUp()
    {
        parent::setUp();
        //Artisan::call('migrate');
        //Artisan::call('db:seed');
        //Auth::loginUsingId(1);
        // OR:
        //$this->be(User::find(1));
        //Auth::login('first@gmail.com', bcrypt('secret'));
    }


    /**
     * test unauthenticated user.
     *
     * @return void
     */
    public function test_unautheticated_user()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(401, $response->getStatusCode());	
        $response = $this->call('GET', '/calendars');
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function test_autheticated_user()
    {
        $response = $this->call('POST', '/calendars', ['email' => 'first@gmail.com',
								  'password' => bcrypt('secret')
		]);
		$this->assertEquals(401, $response->getStatusCode());

    }
}