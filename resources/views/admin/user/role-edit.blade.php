@extends('adminlte::page')

@section('title', '角色添加/编辑')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">角色添加/编辑</h3>
            @include('admin.partials.edit-form-header')
        </div>
        @if($action_method == 'create')
            {!! Former::horizontal_open()->id('form')->method('POST')->action(route($entity . '.store')) !!}
        @elseif($action_method == 'edit')
            {!! Former::horizontal_open()->id('form')->method('PUT')->action(route($entity.'.update', $id)) !!}
            {!! Former::populate($role) !!} <!-- $role填充到表单 -->
        @endif
            <div class="box-body">
                {!! Former::text('name')->label('名称') !!}
                {!! Former::text('description')->label('角色描述') !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\RoleRequest', '#form') !!}
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop
