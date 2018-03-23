@extends('adminlte::page')

@section('title', '设置角色权限')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/treeview/treeview.css') }}">
    <style>
        .treeview-x .icheckbox_minimal-blue{
            margin-bottom: 2px !important;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="box">
                <div class="box-header with-border"><h3 class="box-title">权限树</h3></div>
                {!! Former::open()->id('form')->action(route('role.setacl', $id)) !!}
                <div class="box-body">
                    <ul id="treeview" class="treeview-x display-none">
                        @foreach($permission_tree as $permission)
                            <li>
                                <input type="checkbox" @if($own_permissions->contains($permission['id'])) checked @endif
                                name="permission_ids[]" value="{{ $permission['id'] }}" class="minimal" />
                                {{ $permission['display_name'] }}
                                @if(isset($permission['children']) && count($permission['children']))
                                    @include('admin.partials.permission-children',['children' => $permission['children'],
                                    'type' => 'treeview', 'view' => 'role'])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="box-footer">
                    {!! Former::primary_button('设置')->type('submit')->icon('edit') !!}
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('plugins/treeview/treeview.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            // 初始化权限树
            $('#treeview').treed();
            $('#treeview').fadeIn(500);
        });
    </script>
@stop