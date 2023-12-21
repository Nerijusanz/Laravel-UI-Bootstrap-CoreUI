<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StorePermissionRequest extends FormRequest
{

    public function authorize(): bool
    {
        abort_if(Gate::denies('permission_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','min:2','max:255'],
        ];

    }
}
