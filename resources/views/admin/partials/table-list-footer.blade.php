@if(!empty($list))
    <div class="table-list-info">
        显示第{{ $list->firstItem() }} 至 {{ $list->lastItem() }} 项结果, 共{{ $list->total() }} 项
    </div>
    <div class="table-list-paginate">
        {{ $list->appends(request()->all())->links() }}
    </div>
    <div class="table-list-length">
        <label>
            显示 <select onchange="perPageChange(this)" class="input-sm" no-select2>
                @foreach([10,20,30,50,100] as $value)
                    <option {{ $value == request('per_page') ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </label>
    </div>
@endif