<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }
    public function testUserService()
    {
        self::assertTrue(true);
    }
    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login('daud','admin'));
    }
    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login('admin','daud'));
    }
    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login('daud','daud'));
    }
}
