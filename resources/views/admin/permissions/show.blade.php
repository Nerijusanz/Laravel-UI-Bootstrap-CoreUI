@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @can('permission_management_access')
                <a class="btn btn-sm btn-link float-start" href="{{ route("admin.permissions.index") }}">
                    &lt;&nbsp;{{ __('global.back_to_list') }}
                </a>
            @endcan
            @can('permission_management_delete')
                <button type="submit" class="btn btn-sm btn-danger float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('admin-permission-delete-form').submit(); }">
                    <i class="fas fa-trash"></i>
                </button>
                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" id="admin-permission-delete-form" method="POST" style="display: none" );">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            @endcan
            @can('permission_management_edit')
                <a class="btn btn-sm btn-success float-end" href="{{ route('admin.permissions.edit', $permission->id) }}"><i class="fas fa-edit"></i></a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('global.show') }} {{ __('cruds.permission.title') }}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ __('cruds.permission.fields.id') }}
                                </th>
                                <td>
                                    {{ $permission->id ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('cruds.permission.fields.title') }}
                                </th>
                                <td>
                                    {{ $permission->title ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
