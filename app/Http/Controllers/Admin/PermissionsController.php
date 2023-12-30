<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Permission;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;


class PermissionsController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('permission_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::paginate();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        abort_if(Gate::denies('permission_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $permission = Permission::create($request->validated());

        return redirect()->route('admin.permissions.index');
    }

    public function show(Permission $permission): View
    {
        abort_if(Gate::denies('permission_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        abort_if(Gate::denies('permission_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return redirect()->route('admin.permissions.show',$permission->id)->with('status',__('cruds.permission.messages.updated'));
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permission_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return redirect()->route('admin.permissions.index');

    }
}
