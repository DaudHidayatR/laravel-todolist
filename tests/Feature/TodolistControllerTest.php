<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{

    public function testTodolist()
    {
        $this->withSession([
            'user' => 'daud',
            'todolist' => [
                [
                    'id' => '1',
                    'todo'=> 'daud'
                ]
            ]
        ])->get('todolist')
            ->assertSeeText('1')
            ->assertSeeText('daud');
    }
}
