@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-sm btn-success" href="{{ route("admin.permissions.create") }}">
                {{ __('global.add') }} {{ __('cruds.permission.title_singular') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('cruds.permission.title') }} {{ __('global.list') }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('cruds.permission.fields.id') }}
                                    </th>
                                    <th>
                                        {{ __('cruds.permission.fields.title') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            {{ $permission->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $permission->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('user_management_show')
                                                <a class="btn btn-sm btn-warning" href="{{ route('admin.permissions.show', $permission->id) }}">
                                                    {{ __('global.view') }}
                                                </a>
                                            @endcan
                                            @can('permission_management_edit')
                                                <a class="btn btn-sm btn-success" href="{{ route('admin.permissions.edit', $permission->id) }}"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('permission_management_delete')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('admin-permission-delete-form').submit(); }">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" id="admin-permission-delete-form" method="POST" style="display: none" );">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            <div class="d-flex">
                {!! $permissions->links() !!}
            </div>
        </div>
    </div>

@endsection
