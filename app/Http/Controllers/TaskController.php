<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;

class TaskController extends Controller
{
    public function index() {

        $todos = Task::paginate(10); // Fetch 10 tasks per page
    
        return TodoResource::collection($todos);
    }
    

    public function store(TodoRequest $request) {

        return $request->save();

    }

    public function show(Task $task) {
        return response()->json($task, 200);
    }

    public function update(TodoRequest $request, Task $task) {
        
        // Get validated data directly from the request
        $validatedData = $request->validated();

        $task->update($validatedData);
        return response()->json($task, 200);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json(null, 204);
    }
}
