<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;

class RolesController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('role_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::with('permissions')->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('role_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::select('id','title')->get();

        return view('admin.roles.create',compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->safe()->except(['permission_ids']));

        $role->permissions()->sync($request->validated('permission_ids'));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role): View
    {
        abort_if(Gate::denies('role_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        abort_if(Gate::denies('role_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::select('id','title')->get();

        $role->load('permissions');

        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->safe()->except(['role_id','permission_ids']));

        $role->permissions()->sync($request->validated('permission_ids'));

        return redirect()->route('admin.roles.show',$role->id)->with('status',__('cruds.role.messages.updated'));
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_if(Gate::denies('role_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->permissions()->sync([]);

        $role->delete();

        return redirect()->route('admin.roles.index');

    }
}
