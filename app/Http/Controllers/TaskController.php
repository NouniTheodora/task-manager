<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index(Request $request): TaskCollection
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('is_done')
            ->defaultSort('-created_at') // Sort by created_at DESC
            ->allowedSorts(['title', 'created_at', 'is_done']) // Default ASC
            ->paginate();

        return new TaskCollection($tasks);
    }

    public function show(Request $request, Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(DestroyTaskRequest $request, Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
