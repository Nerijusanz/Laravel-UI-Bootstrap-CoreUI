<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;


class UsersController extends Controller
{

    public function index(): View
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with('roles')->paginate();

        return view('admin.users.index',compact('users'));
    }


    public function create(): View
    {
        abort_if(Gate::denies('user_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::select('id','title')->get();

        return view('admin.users.create',compact('roles'));
    }


    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->safe()->except(['role_id']));
        $user->roles()->sync($request->validated('role_id'));

        return redirect()->route('admin.users.index');
    }


    public function show(User $user): View
    {
        abort_if(Gate::denies('user_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show',compact('user'));
    }


    public function edit(User $user): View
    {
        abort_if(Gate::denies('user_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::select('id','title')->get();

        $user->load('roles');

        return view('admin.users.edit',compact('roles','user'));
    }


    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->safe()->except(['user_id','role_id']));
        $user->roles()->sync($request->validated('role_id'));

        if(isset($request['password']) && $request['password'] !== null){

            $validator = Validator::make($request->all(), [
                'password' => ['required','string','max:255', Password::defaults(), 'confirmed'],
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

            $validated = $validator->validated();

            $user->update([
                'password' => Hash::make($validated['password'])
            ]);
        }

        return redirect()->route('admin.users.show',$user->id)->with('status',__('cruds.user.messages.updated'));
    }


    public function destroy(User $user): RedirectResponse
    {
        abort_if(Gate::denies('user_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
