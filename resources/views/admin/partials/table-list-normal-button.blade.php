@if(Gate::allows($entity . '.edit'))
    <a href="{!! route($entity . '.edit', $id); !!}" class="btn bg-blue btn-xs">
        <i class="fa fa-pencil-square-o">编辑</i>
    </a>
@endif

@if(Gate::allows($entity . '.destroy'))
    <a onclick="singleDelete('{{ $entity }}','{{ $id }}')" class="btn btn-danger btn-xs">
        <i class="fa fa-trash-o">删除</i>
    </a>
@endif
