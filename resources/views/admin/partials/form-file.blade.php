@if($file_path != '')
    <div class="form-group" style="margin-left: 17%">
        <a href="{{ asset($file_path) }}" target="_blank">
            查看已上传
        </a>
    </div>
@endif