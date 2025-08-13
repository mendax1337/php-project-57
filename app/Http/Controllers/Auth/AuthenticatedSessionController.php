<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Показать страницу входа.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Обработать запрос аутентификации.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // флеш после успешного входа
        flash('Вы вошли в систему.')->success();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Выйти из системы.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Сначала полностью инвалидируем текущую сессию…
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // …а затем кладём флеш уже в новую «чистую» сессию
        flash('Вы вышли из системы.')->success();

        return redirect('/');
    }
}
