@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ __('global.add') }} {{ __('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('cruds.user.title_singular') }} {{ __('global.list') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('cruds.user.fields.id') }}
                                    </th>
                                    <th>
                                        {{ __('cruds.user.fields.name') }}
                                    </th>
                                    <th>
                                        {{ __('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ __('cruds.user.fields.role_id') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span class="badge bg-success">{{ $role->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('user_management_show')
                                                <a class="btn btn-sm btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                                    {{ __('global.view') }}
                                                </a>
                                            @endcan
                                            @can('user_management_edit')
                                                <a class="btn btn-sm btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                                    {{ __('global.edit') }}
                                                </a>
                                            @endcan
                                            @can('user_management_delete')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-sm btn-danger" value="{{ __('global.delete') }}">
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
