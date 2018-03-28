@extends('adminlte::page')

@section('title', '用户列表')

@section('content')
    <div class="box">
        <div class="box-header box-header-padding">
            @include('admin.partials.table-list-header')
            @component('admin.partials.table-list-filter')
                @slot('modal_body')
                    {!! Former::text('id')->label('ID') !!}
                    {!! Former::text('username')->label('用户名') !!}
                    {!! Former::text('email')->label('邮箱') !!}
                    {!! Former::text('name')->label('昵称') !!}
                @endslot
            @endcomponent
        </div>
        <div class="box-body no-padding table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="40"></th>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>昵称</th>
                    <th>角色</th>
                    <th>上级用户</th>
                    <th>部门</th>
                    {{--<th>职位</th>--}}
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users ?? [] as $user)
                        <tr>
                            <td><input type="checkbox" class="minimal" value="{{ $user->id }}" /></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="label label-info">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($user->superiors as $superior)
                                    <span class="label label-info">{{ $superior->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->department->department_name }}</td>
                            <td>
                                <div class="btn-group">
                                    @component('admin.partials.table-list-normal-button')
                                        @slot('id'){{ $user->id }}@endslot
                                    @endcomponent
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer no-border">
            @include('admin.partials.table-list-footer', ['list' => $users ?? []])
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop
