<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

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
            'email' => ['required','string','lowercase','email','max:255', Rule::unique(User::class)->ignore(request()->route('user')->id)],
            'role_id' => ['required','integer', Rule::exists(Role::class, 'id')],
        ];
    }
}
