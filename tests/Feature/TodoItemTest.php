<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoItemTest extends TestCase
{
    use RefreshDatabase;

    const TODO_ITEMS = [
        [
            'content' => "First Todo Item",
        ],
        [
            'content' => "Second Todo Item",
        ]
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_save_todo_items()
    {
        $response = $this->post('/api/todo_items', [
            'todo_items' => self::TODO_ITEMS,
        ]);

        $response->assertStatus(200);

        $todoItems = json_decode($response->getContent());

        foreach ($todoItems as $index => $todoItem) {
            $this->assertEquals(self::TODO_ITEMS[$index]['content'], $todoItem->content);
        }
    }
}
