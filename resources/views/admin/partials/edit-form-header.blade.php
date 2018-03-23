<div class="box-tools">
    <div class="btn-group pull-left margin-r-10">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> 后退</a>
    </div>
    <div class="btn-group pull-left margin-r-10">
        <a href="{{ route($entity . '.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
    </div>
</div>

{!! Former::setOption('auto_mark_required', true) !!}