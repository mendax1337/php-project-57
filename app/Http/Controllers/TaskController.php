<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class TaskController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(Request $request): View
    {
        $statuses = TaskStatus::query()->orderBy('id')->pluck('name', 'id');
        $users    = User::query()->orderBy('name')->pluck('name', 'id');

        /** @var SpatieQueryBuilder<\App\Models\Task> $qb */
        $qb = SpatieQueryBuilder::for(Task::class);

        $qb->allowedFilters([
            AllowedFilter::exact('status_id'),
            AllowedFilter::exact('created_by_id'),
            AllowedFilter::exact('assigned_to_id'),
        ]);

        /** @phpstan-ignore-next-line */
        $qb->with(['status', 'creator', 'assignee'])
            ->orderBy('id');

        $tasks = $qb->paginate(15)->appends($request->query());

        return view('tasks.index', compact('tasks', 'statuses', 'users'));
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
            'labels'   => \App\Models\Label::query()->pluck('name', 'id'),
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by_id'] = (int) auth()->id();

        $task = Task::create($data);
        $task->labels()->sync($request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Task created');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task'     => $task,
            'statuses' => TaskStatus::query()->pluck('name', 'id'),
            'users'    => User::query()->pluck('name', 'id'),
            'labels'   => \App\Models\Label::query()->pluck('name', 'id'),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();

        $task->update($data);
        $task->labels()->sync($request->input('labels', []));

        return redirect()->route('tasks.index')->with('success', 'Task updated');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }
}
