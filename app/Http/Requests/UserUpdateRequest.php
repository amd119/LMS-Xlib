<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'username' => ['required', Rule::unique('users', 'username')->ignore($userId, 'UserID')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId, 'UserID')],
            'NamaLengkap' => ['required', 'string', 'max:255'],
            'Alamat' => ['required', 'string', 'max:255']
        ];
    }
}
