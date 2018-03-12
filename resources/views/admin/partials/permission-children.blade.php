@if($type == 'select')
    @foreach($children as $child)
        <option value="{{ $child['id'] }}">
            {{ str_repeat('━', $index + 1) }} {{ $child['display_name'] }}
        </option>
        @if(isset($child['children']) && count($child['children']) > 0)
            @php $index++; @endphp
            @include('admin.partials.permission-children',['children' => $child['children'], 'type' => $type, 'index' => $index])
            @php $index = 0; @endphp
        @endif
    @endforeach
@endif

@if($type == 'treeview')
    <ul>
        @foreach($children as $child)
            <li>
                @if($view == 'role')
                    <input type="checkbox" @if($own_permissions->contains($child['id'])) checked @endif
                    name="permission_ids[]" value="{{ $child['id'] }}" class="minimal" />
                @endif
                {{ $child['display_name'] }}
                @if($view == 'permission')
                    <span class="margin-l-3">
                        <a class="treeview-edit" data-id="{{ $child['id'] }}" href="#"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="treeview-delete" data-id="{{ $child['id'] }}" href="#"><i class="fa fa-trash-o"></i></a>
                    </span>
                @endif
                @if(isset($child['children']) && count($child['children']) > 0)
                    @include('admin.partials.permission-children',['children' => $child['children'], 'type' => $type])
                @endif
            </li>
        @endforeach
    </ul>
@endif