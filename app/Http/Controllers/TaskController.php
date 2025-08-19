<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        // index/show — публичные; остальные требуют логин
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request): View
    {
        $q = Task::query()
            ->with(['status', 'creator', 'assignee', 'labels'])
            ->latest('id');

        // простые фильтры, как ждут тесты Хекслета
        if ($request->filled('status_id')) {
            $q->where('status_id', (int) $request->input('status_id'));
        }
        if ($request->filled('created_by_id')) {
            $q->where('created_by_id', (int) $request->input('created_by_id'));
        }
        if ($request->filled('assigned_to_id')) {
            $q->where('assigned_to_id', (int) $request->input('assigned_to_id'));
        }

        $tasks = $q->paginate(50)->withQueryString();

        return view('tasks.index', [
            'tasks'    => $tasks,
            'statuses' => TaskStatus::pluck('name', 'id'),
            'users'    => User::pluck('name', 'id'),
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
