<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    public function index(): View
    {
        $statuses = TaskStatus::query()
            ->orderBy('id')
            ->paginate(20);

        return view('task_statuses.index', compact('statuses'));
    }

    public function create(): View
    {
        return view('task_statuses.create', [
            'task_status' => new TaskStatus(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:task_statuses,name'],
        ]);

        TaskStatus::create($data);

        return redirect()->route('task_statuses.index')
            ->with('success', 'Статус создан');
    }

    public function edit(TaskStatus $task_status): View
    {
        return view('task_statuses.edit', compact('task_status'));
    }

    public function update(Request $request, TaskStatus $task_status): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:task_statuses,name,' . $task_status->id],
        ]);

        $task_status->update($data);

        return redirect()->route('task_statuses.index')
            ->with('success', 'Статус обновлён');
    }

    public function destroy(TaskStatus $task_status): RedirectResponse
    {
        if ($task_status->tasks()->exists()) {
            return redirect()->route('task_statuses.index')
                ->with('error', 'Не удалось удалить статус');
        }

        $task_status->delete();

        return redirect()->route('task_statuses.index')
            ->with('success', 'Статус удалён');
    }
}
