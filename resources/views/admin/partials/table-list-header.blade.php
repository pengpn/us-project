<div class="pull-left table-list-action">
    <span><input id="check-all" type="checkbox" class="minimal" value="" /></span>
    <div class="btn-group">
        <button type="button" class="btn btn-default">批量操作</button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a onclick="batchDelete('{{ $entity }}');" href="#">删除</a></li>
        </ul>
    </div>
</div>

<div class="box-tools">
    @if(Gate::allows($entity.'.create'))
        <div class="btn-group pull-left table-list-add-btn">
            <a href="{!! route($entity.'.create'); !!}" class="btn btn-sm btn-success"><i class="fa fa-save"></i>添加</a>
        </div>
    @endif
    <div class="btn-group pull-left table-list-search-btn">
        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>搜索</a>
        <a href="{{ request()->url() }}" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>重置</a>
    </div>
</div>

<!--表单项自动外包form-group(当没有Former::open的情况) -->
{!! Former::setOption('auto_wrap_form_group', true) !!}

<script type="text/javascript">
    $(function(){
        //复选框全选
        //icheck 里面的方法
        $('#check-all').on('ifChecked', function () {
            $('input:checkbox').iCheck('check');
        }).on('ifUnchecked', function () {
            $('input:checkbox').iCheck('uncheck');
        })
    });
</script>