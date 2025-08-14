<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userId = (int) auth()->id();

        return [
            'name'  => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique('users')->ignore($userId)],
        ];
    }
}
