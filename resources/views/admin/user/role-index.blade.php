@extends('adminlte::page')

@section('title', '角色列表')

@section('content')
    <div class="box">
        <div class="box-header box-header-padding">
            @include('admin.partials.table-list-header')
            @component('admin.partials.table-list-filter')
                @slot('modal_body')
                    {!! Former::text('id')->label('ID') !!}
                    {!! Former::text('name')->label('名称') !!}
                @endslot
            @endcomponent
        </div>
        <div class="box-body no-padding table-responsive">
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="40"></th>
                    <th>ID</th>
                    <th>名称</th>
                    <th>角色概述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($role ?? [] as $value)
                    <tr>
                        <td><input type="checkbox" class="minimal" value="{{ $value->id }}"></td>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->description }}</td>
                        <td>
                            <div class="btn-group">
                                {{--@if(Gate::allows($entity . '.getacl'))--}}
                                {{--<a href="{!! route($entity . '.getacl', $value->id); !!}" class="btn bg-purple btn-xs">--}}
                                {{--<i class="fa fa-tree">设置权限</i>--}}
                                {{--</a>--}}
                                {{--@endif--}}
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
            @include('admin.partials.table-list-footer', ['list' => $role ?? []])
        </div>
    </div>

@stop

@section('js')
    <script type="text/javascript">
        $(function(){

        });
    </script>
@stop