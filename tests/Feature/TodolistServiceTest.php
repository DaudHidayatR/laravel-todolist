<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class TodolistServiceTest extends TestCase
{
private TodolistService $todoListService;
protected function setUp(): void
{
    parent::setUp();
    $this->todoListService = $this->app->make(TodolistService::class);
}

    public function testTodolistServiceNotNull()
    {
    self::assertNotNull($this->todoListService);
    }

    public function testSaveTodo()
    {
        $this->todoListService->saveTodo("1", 'daud');
        $todolist = Session::get('todolist');
        foreach ($todolist as $value){
            self::assertEquals('1', $value['id']);
            self::assertEquals('daud', $value['todo']);
        }
    }

    public function testTodolistEmpty()
    {
        assertEquals([], $this->todoListService->getTodolist());
    }
    public function testTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'daud'
            ],
            [
                'id' => '2',
                'todo' => 'hidayat'
            ]
        ];
        $this->todoListService->saveTodo('1', 'daud');
        $this->todoListService->saveTodo('2', 'hidayat');
        assertEquals($expected, $this->todoListService->getTodolist());
    }
    public function testRemoveTodolist()
    {
        $this->todoListService->saveTodo('1', 'daud');
        $this->todoListService->saveTodo('2', 'Hidayat');
        $this->todoListService->getTodolist();
        $this->todoListService->removeTodolist('1');

        self::assertEquals(1, sizeof($this->todoListService->getTodolist()));
        $this->todoListService->removeTodolist('3');
        self::assertEquals(1, sizeof($this->todoListService->getTodolist()));

    }

}
