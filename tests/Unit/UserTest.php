<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoadLoginPage()
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function testLoginWithValidData()
    {
        $user = factory(User::class)->create();
        $this->post('/login', ['username' =>$user->username,'password' => 'password'] )->assertRedirect('/home');
    }

    public function testLoginWithInValidData()
    {
        $this->post('/login', ['username' =>'username','password' => 'password'] )->assertRedirect();
    }
}
