@extends('adminlte::page')

@section('title', '组别管理')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/treeview/treeview.css') }}">
@stop

@section('content')
    <div class="box">
        <div class="box-header box-header-padding">
            @include('admin.partials.table-list-header')
            @component('admin.partials.table-list-filter')
                @slot('modal_body')
                    {!! Former::text('id')->label('ID') !!}
                    {!! Former::text('department_name')->label('部门名称') !!}
                @endslot
            @endcomponent
        </div>
        <div class="box-body no-padding table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="40"></th>
                    <th>ID</th>
                    <th>部门名称</th>
                    <th>部门所在地</th>
                    <th>人员</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($department ?? [] as $value)
                    <tr>
                        <td><input type="checkbox" class="minimal" value="{{ $value->id }}" /></td>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->department_name }}</td>
                        <td>{{ $value->department_address }}</td>
                        <td>
                            @foreach($value->users ?? [] as $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group">
                                @component('admin.partials.table-list-normal-button')
                                    @slot('id'){{ $value->id }}@endslot
                                @endcomponent
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer no-border">
            @include('admin.partials.table-list-footer', ['list' => $department ?? []])
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop