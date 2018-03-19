<div class="modal fade" id="filter-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">搜索</h4>
            </div>
            @if(isset($action) && $action)
                {!! Former::vertical_open()->method('GET')->action(route($entity.'.'.$action)) !!}
            @else
                {!! Former::vertical_open()->method('GET')->action(route($entity.'.index')) !!}
            @endif
            <div class="modal-body">
                {{ $modal_body }}
            </div>
            <div class="modal-footer">
                {!! Former::primary_button('提交')->type('submit')->data_dismiss('modal') !!}
                {!! Former::default_button('关闭')->data_dismiss('modal') !!}
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>