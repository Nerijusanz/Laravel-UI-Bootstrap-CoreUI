<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        abort_if(Gate::denies('user_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2','max:255'],
            'email' => ['required','string','lowercase','email','max:255','unique:App\Models\User,email,' . request()->route('user')->id],
            'role_id' => ['required','numeric','exists:App\Models\Role,id'],
        ];

    }
}
