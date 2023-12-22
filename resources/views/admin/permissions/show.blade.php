@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @can('permission_management_access')
                <a href="{{ route("admin.permissions.index") }}" class="btn btn-sm btn-link float-start">
                    &lt;&nbsp;{{ __('global.back_to_list') }}
                </a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>{{ __('global.show') }} {{ __('cruds.permission.title') }}</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row-reverse mb-1">
                        <div class="">
                            @can('permission_management_delete')
                                <button type="submit" class="btn btn-sm btn-danger text-light float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('admin-permission-delete-form').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" id="admin-permission-delete-form" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            @endcan
                        </div>
                        <div class="me-1">
                            @can('permission_management_edit')
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-info text-light float-end"><i class="fas fa-edit"></i></a>
                            @endcan
                        </div>
                    </div>
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
