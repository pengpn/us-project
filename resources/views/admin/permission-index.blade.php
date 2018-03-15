@extends('adminlte::page')

@section('title','Permissions')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/treeview/treeview.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="box box-success">
                <div class="box-header with-border"><h3 class="box-title">Permission add/edit</h3></div>
                {!! Former::vertical_open()->id('form')->action(route('permission.store')) !!}
                {!! Former::hidden('id') !!}
                <div class="box-body">
                    <div class="form-group">
                        <label>Parent</label>
                        <select id="permission-select" name="parent_id" class="form-control">
                            <option value="0">【Root】</option>
                            @foreach($permission_tree as $permission)
                                <option value="{{ $permission['id'] }}">
                                    {{ $permission['display_name'] }}
                                    @if(isset($permission['children']) && count($permission['children']))
                                        @include('admin.partials.permission-children',['children' => $permission['children'],
                                        'type' => 'select', 'index' => 0])
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {!! Former::text('display_name')->label('名称') !!}
                    {!! Former::text('name')->label('权限别名') !!}
                    {!! Former::text('icon')->label('图标') !!}
                    {!! Former::text('order_num')->label('排序')->value(0) !!}
                    {!! Former::radios()->radios(['显示' => ['name' => 'is_show','value' => '1'],
                        '隐藏' => ['name' => 'is_show', 'value' => '0']])->check(1)->label('左侧菜单栏')
                         ->addClass('minimal')->inline() !!}
                </div>
                <div class="box-footer">
                    @if(Gate::allows($entity.'.create'))
                        {!! Former::primary_button('添加')->type('submit')->icon('plus')->id('add-btn') !!}
                    @endif
                    @if(Gate::allows($entity.'.edit'))
                        {!! Former::primary_button('编辑')->type('submit')->icon('edit')->id('edit-btn')->addClass('display-none') !!}
                    @endif
                </div>

                {!! Former::close() !!}
            </div>
        </div>

        <div class="col-md-7">
            <div class="box">
                <div class="box-header with-border"><h3 class="box-title">权限树</h3></div>
                <div class="box-body">
                    <ul id="treeview" class="treeview-x display-none">
                        @foreach($permission_tree as $permission)
                            <li>
                                {{ $permission['display_name'] }}
                                <span class="margin-l-3">
                                    <a class="treeview-edit" data-id="{{ $permission['id'] }}" href="#"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="treeview-delete" data-id="{{ $permission['id'] }}" href="#"><i class="fa fa-trash-o"></i></a>
                                </span>
                                @if(isset($permission['children']) && count($permission['children']))
                                    @include('admin.partials.permission-children',['children' => $permission['children'],
                                    'type' => 'treeview', 'view' => 'permission'])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\PermissionRequest', '#form') !!}
    <script src="{{ asset('plugins/treeview/treeview.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            // 初始化权限树
            $('#treeview').treed();
            $('#treeview').fadeIn(500);

            // 添加按钮
            $('#add-btn').click(function(e){
                e.preventDefault();
                $('#edit-btn').fadeOut();
                // 表单改为添加页面状态
                $('#form').attr('action', route('permission.store'));
                $('#form [name="id"]').remove();
                $('#form [name="_method"][value="PUT"]').remove();
                $('#form').submit();
            });

            // 权限树 - 编辑
            $('.treeview-edit').click(function(){
                $.ajax({
                    url: route('permission.edit', $(this).data('id')),
                    success: function(ret){
                        // 赋值
                        $('[name="id"]').val(ret.id);
                        $('[name="display_name"]').val(ret.display_name);
                        $('[name="name"]').val(ret.name);
                        $('[name="icon"]').val(ret.icon);
                        $('[name="order_num"]').val(ret.order_num);
                        // 选中父级
                        $('#permission-select').val(ret.parent_id).trigger('change');
                        // 选中左侧显示
                        if(ret.is_show === 1){
                            $('[name="is_show"][value="1"]').iCheck('check');
                        }else{
                            $('[name="is_show"][value="0"]').iCheck('check');
                        }
                        // 显示编辑按钮
                        $('#edit-btn').attr('data-id', ret.id).fadeIn();
                        // 表单改为编辑页面状态
                        $('#form').attr('action', route('permission.update', $(this).data('id')));
                        if($('#form [name="id"]').length === 0){
                            $('#form').prepend('<input type="hidden" name="id" value="'+ $(this).data('id') +'" />');
                        }
                        if($('#form [name="_method"][value="PUT"]').length === 0){
                            $('#form').prepend('<input type="hidden" name="_method" value="PUT" />');
                        }
                    }.bind($(this))
                });
            });

            // 权限树 - 删除
            $('.treeview-delete').click(function(){
                // deleteHandler(route('permission.destroy', $(this).data('id')));
            });

        });
    </script>
@stop