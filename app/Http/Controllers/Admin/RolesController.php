<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Role;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;

class RolesController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('role_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('role_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.roles.create');
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->validated());

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role): View
    {
        abort_if(Gate::denies('role_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        abort_if(Gate::denies('role_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validated());

        return redirect()->route('admin.roles.show',$role->id)->with('status',__('cruds.role.messages.updated'));
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_if(Gate::denies('role_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('admin.roles.index');

    }
}
