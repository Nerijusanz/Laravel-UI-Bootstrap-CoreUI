<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\Permission;

class StoreRoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        abort_if(Gate::denies('role_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','lowercase','min:2','max:255', Rule::unique(Role::class)],
            'permission_ids' => ['required','array'],
            'permission_ids.*' => ['integer', Rule::exists(Permission::class, 'id')]
        ];

    }
}
