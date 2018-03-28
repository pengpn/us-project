@extends('adminlte::page')

@section('title', '编辑/添加')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">部门添加/编辑</h3>
            @include('admin.partials.edit-form-header')
        </div>
        @if($action_method == 'create')
            {!! Former::horizontal_open()->id('form')->method('POST')->action(route($entity.'.store')) !!}
        @elseif($action_method == 'edit')
            {!! Former::horizontal_open()->id('form')->method('PUT')->action(route($entity.'.update', $id)) !!}
            {!! Former::populate($department) !!}
            {!! Former::populateField('department_user_ids', $department_user_selected) !!}
        @endif
        <div class="box-body">
            {!! Former::text('department_name')->label('部门名称') !!}
            {!! Former::text('department_address')->label('部门所在地') !!}
            {!! Former::multiselect('department_user_ids')->options($admin_user_options)->label('人员') !!}
        </div>
        <div class="box-footer">
            {!! Former::actions(
                Former::primary_button('保存')->type('submit'),
                Former::warning_button('重置')->type('reset')
            ) !!}
        </div>
        {!! Former::close() !!}
    </div>
@stop

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\DepartmentRequest', '#form') !!}
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop
