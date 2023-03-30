<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('login');
    }
    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "daud",
            "password" => "admin"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "daud");
    }
    public function testValidationError(){
        $this->post('login', [])
            ->assertSeeText('User or password is required');
    }
    public function testloginFailed()
    {
        $this->post('/login', [
            'user' => 'daud',
            'password' => 'salahpassword'
        ])->assertSeeText('User or password wrong');
    }

}
