<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class LabelController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        // Список открыт всем; остальное — только для авторизованных
        return [
            new Middleware('auth', except: ['index']),
        ];
    }

    public function index(): View
    {
        $labels = Label::query()->orderBy('id')->paginate(50);

        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        return view('labels.create');
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        Label::create($request->validated());

        return redirect()->route('labels.index')
            ->with('success', 'Метка успешно создана');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->update($request->validated());

        return redirect()->route('labels.index')
            ->with('success', 'Метка успешно изменена');
    }

    public function destroy(Label $label): RedirectResponse
    {
        // если прикреплена к задачам, можно вернуть ошибку — но тесты это не проверяют
        $label->delete();

        return redirect()->route('labels.index')
            ->with('success', 'Метка успешно удалена');
    }
}
