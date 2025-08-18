<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class TaskController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(): View
    {
        $tasks = Task::query()
            ->with(['status', 'creator', 'assignee', 'labels'])
            ->latest('id')
            ->paginate(20);

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task): View
    {
        $task->load(['status', 'creator', 'assignee', 'labels']);

        return view('tasks.show', compact('task'));
    }

    public function create(): View
    {
        return view('tasks.create', [
            'task'     => new Task(),
            'statuses' => TaskStatus::query()->pluck('name', 'id'),
            'users'    => User::query()->pluck('name', 'id'),
            'labels'   => Label::query()->pluck('name', 'id'),
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // создаём задачу и фиксируем автора
        $task = new Task($validated);
        $task->created_by_id = (int) auth()->id();
        $task->save();

        // метки (может не быть ни одной)
        $task->labels()->sync((array) $request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Task created');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task'     => $task->load('labels'),
            'statuses' => TaskStatus::query()->pluck('name', 'id'),
            'users'    => User::query()->pluck('name', 'id'),
            'labels'   => Label::query()->pluck('name', 'id'),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();

        $task->update($validated);

        // обновляем связи меток
        $task->labels()->sync((array) $request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Task updated');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }
}
