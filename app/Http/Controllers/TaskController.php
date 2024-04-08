<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): TaskCollection
    {
        return new TaskCollection(Task::all());
    }

    public function show(Request $request, Task $task): TaskResource
    {
        return new TaskResource($task);
    }
}
