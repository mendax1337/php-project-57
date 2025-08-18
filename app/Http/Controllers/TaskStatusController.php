<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    /**
     * Список статусов — доступен всем.
     */
    public function index(): \Illuminate\View\View
    {
        $statuses = \App\Models\TaskStatus::query()
            ->orderBy('id')
            ->paginate(20);

        return view('task_statuses.index', compact('statuses'));
    }

    /**
     * Форма создания — только для авторизованных (см. routes).
     */
    public function create(): View
    {
        return view('task_statuses.create');
    }

    /**
     * Создание статуса.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:task_statuses,name'],
        ], [
            'name.required' => 'Это обязательное поле.',
            'name.unique'   => 'Такое значение поля name уже существует.',
        ]);

        TaskStatus::create($validated);

        return redirect()
            ->route('task_statuses.index')
            ->with('success', 'Статус создан');
    }

    /**
     * Форма редактирования.
     */
    public function edit(TaskStatus $task_status): View
    {
        return view('task_statuses.edit', compact('task_status'));
    }

    /**
     * Обновление статуса.
     */
    public function update(Request $request, TaskStatus $task_status): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:task_statuses,name,' . $task_status->id],
        ], [
            'name.required' => 'Это обязательное поле.',
            'name.unique'   => 'Такое значение поля name уже существует.',
        ]);

        $task_status->update($validated);

        return redirect()
            ->route('task_statuses.index')
            ->with('success', 'Статус обновлён');
    }

    /**
     * Удаление статуса.
     * Если статус используется хотя бы в одной задаче — не удаляем и показываем флеш.
     */
    public function destroy(TaskStatus $task_status): RedirectResponse
    {
        if ($task_status->tasks()->exists()) {
            return redirect()
                ->route('task_statuses.index')
                ->with('error', 'Не удалось удалить статус');
        }

        $task_status->delete();

        return redirect()
            ->route('task_statuses.index')
            ->with('success', 'Статус удалён');
    }
}
