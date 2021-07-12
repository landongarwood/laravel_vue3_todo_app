<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;

class TodoItemsController extends Controller
{
    public function store()
    {
        $todoItems = request()->input('todo_items');

        $syncedIds = [];

        foreach ($todoItems as $todoItem) {
            $todoItem = TodoItem::updateOrCreate([
                'id' => $todoItem['id'] ?? uniqid(),
            ], $todoItem);

            $syncedIds[] = $todoItem->id;
        }

        TodoItem::whereNotIn('id', $syncedIds)->delete();

        return response()->json(TodoItem::all()->toArray());
    }
}
