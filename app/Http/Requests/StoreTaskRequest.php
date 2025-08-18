<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        // роут уже под auth, но для phpstan явно вернём true
        return true;
    }

    /**
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'status_id'       => ['required', 'exists:task_statuses,id'],
            'assigned_to_id'  => ['nullable', 'exists:users,id'],
        ];
        // Имёна полей соответствуют требованиям шага 4
    }
}
