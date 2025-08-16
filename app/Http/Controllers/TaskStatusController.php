<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    // Список статусов (доступен всем)
    public function index(): View
    {
        $statuses = TaskStatus::orderBy('id')->paginate(15);

        return view('task_statuses.index', compact('statuses'));
    }

    // Форма создания (только для авторизованных)
    public function create(): View
    {
        return view('task_statuses.create');
    }

    // Сохранение нового статуса
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255', 'unique:task_statuses,name'],
        ]);

        TaskStatus::create($data);

        flash('Статус успешно создан')->success();

        return redirect()->route('task_statuses.index');
    }

    // Форма редактирования
    public function edit(TaskStatus $task_status): View
    {
        return view('task_statuses.edit', ['status' => $task_status]);
    }

    // Обновление
    public function update(Request $request, TaskStatus $task_status): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255', 'unique:task_statuses,name,' . $task_status->id],
        ]);

        $task_status->update($data);

        flash('Статус успешно обновлён')->success();

        return redirect()->route('task_statuses.index');
    }

    // Удаление (запрещаем, если есть связанные задачи)
    public function destroy(TaskStatus $task_status): RedirectResponse
    {
        // Пока таблицы tasks ещё может не быть — проверим её наличие
        if (Schema::hasTable('tasks')) {
            $linked = DB::table('tasks')->where('status_id', $task_status->id)->exists();
            if ($linked) {
                flash('Невозможно удалить статус: есть связанные задачи')->error();
                return redirect()->route('task_statuses.index');
            }
        }

        $task_status->delete();
        flash('Статус успешно удалён')->success();

        return redirect()->route('task_statuses.index');
    }
}
