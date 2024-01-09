<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Models\Permission;

class UpdatePermissionRequest extends FormRequest
{

    public function authorize(): bool
    {
        abort_if(Gate::denies('permission_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules(): array
    {
        return [
            'permission_id' => ['required','integer', Rule::exists(Permission::class,'id')],
            'title' => ['required','string','lowercase','min:2','max:255', Rule::unique(Permission::class)->ignore($this->permission_id)],
        ];
    }
}
