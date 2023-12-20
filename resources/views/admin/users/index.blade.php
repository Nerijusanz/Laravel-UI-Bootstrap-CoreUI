@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-sm btn-success" href="{{ route("admin.users.create") }}">
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
                                        {{ __('cruds.user.fields.role') }}
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
                                            <?php
                                                if(! optional($user->roles->first())->title){
                                                    echo sprintf('<span class="badge bg-danger">%s</span>',__('cruds.user.fields.no_role'));
                                                }else{
                                                    echo ($user->roles->first()->title == 'Admin') ?
                                                        sprintf('<span class="badge bg-primary">%s</span>',$user->roles->first()->title) :
                                                        sprintf('<span class="badge bg-success">%s</span>',$user->roles->first()->title);
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            @can('user_management_show')
                                                <a class="btn btn-sm btn-link" href="{{ route('admin.users.show', $user->id) }}">
                                                    {{ __('global.view') }}
                                                </a>
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
