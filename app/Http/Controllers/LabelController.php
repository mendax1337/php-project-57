<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class LabelController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    /** Ограничим доступ к изменениям меток только для авторизованных */
    public static function middleware(): array
    {
        return [
            // index – публичный; всё остальное только для залогиненных
            new Middleware('auth', except: ['index']),
        ];
    }

    public function index(): View
    {
        $labels = Label::query()
            ->orderBy('id', 'asc')
            ->paginate(20);

        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        return view('labels.create', ['label' => new Label()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Label::create($data);

        return redirect()->route('labels.index')->with('success', 'Label created');
    }

    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label): RedirectResponse
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $label->update($data);

        return redirect()->route('labels.index')->with('success', 'Label updated');
    }

    public function destroy(Label $label): RedirectResponse
    {
        // Нельзя удалить метку, если она используется в задачах
        if ($label->tasks()->exists()) {
            return redirect()
                ->route('labels.index')
                ->with('error', 'Не удалось удалить метку');
        }

        $label->delete();

        return redirect()->route('labels.index')->with('success', 'Label deleted');
    }
}
