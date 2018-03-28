@extends('adminlte::page')

@section('title', '用户添加/编辑')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">用户添加/编辑</h3>
            @include('admin.partials.edit-form-header')
        </div>
        @if($action_method == 'create')
            {!! Former::open_for_files()->id('form')->method('POST')->action(route($entity.'.store')) !!}
        @elseif($action_method == 'edit')
            {!! Former::open_for_files()->id('form')->method('PUT')->action(route($entity.'.update', $id)) !!}
            {!! Former::populate($user) !!}
            {!! Former::populateField('role_ids', $role_selected) !!}
            {!! Former::populateField('superior_user_ids', $superior_user_selected) !!}
        @endif
        <div class="box-body">
            {!! Former::text('username')->label('账号') !!}
            {!! Former::password('password')->label('密码')->autocomplete('new-password') !!}
            {!! Former::text('name')->label('显示名称') !!}
            {!! Former::text('email')->label('邮箱') !!}
            {!! Former::file('avatar')->label('头像') !!}
            @component('admin.partials.form-file')
                @slot('file_path'){{ $user->avatar or '' }}@endslot
            @endcomponent
            {!! Former::multiselect('role_ids')->options($role_options)->label('角色') !!}
            {!! Former::multiselect('superior_user_ids')->options($superior_user_options)->label('上级用户') !!}
            {!! Former::select('department_id')->options($department_options)->label('所属部门') !!}

        </div>
        <div class="box-footer">
            {!! Former::actions(
                Former::primary_button('提交')->type('submit'),
                Former::warning_button('重置')->type('reset')
            ) !!}
        </div>
        {!! Former::close() !!}
    </div>
@stop
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\AdminUserRequest', '#form') !!}
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop