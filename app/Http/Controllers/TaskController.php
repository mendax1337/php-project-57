<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        // index/show — публичные; остальное под auth
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(): View
    {
        $tasks = QueryBuilder::for(Task::query()->with(['status', 'creator', 'assignee']))
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->latest('id')
            ->paginate(50)
            ->withQueryString();

        return view('tasks.index', [
            'tasks'   => $tasks,
            'statuses'=> TaskStatus::pluck('name', 'id'),
            'users'   => User::pluck('name', 'id'),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', [
            'statuses' => TaskStatus::pluck('name', 'id'),
            'users'    => User::pluck('name', 'id'),
            'labels'   => Label::pluck('name', 'id'),
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by_id'] = (int) auth()->id();

        $task = Task::create($data);
        $task->labels()->sync($request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Задача успешно создана');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', ['task' => $task->load(['status', 'creator', 'assignee', 'labels'])]);
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task'     => $task->load('labels'),
            'statuses' => TaskStatus::pluck('name', 'id'),
            'users'    => User::pluck('name', 'id'),
            'labels'   => Label::pluck('name', 'id'),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        $task->labels()->sync($request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Задача успешно изменена');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена');
    }
}
