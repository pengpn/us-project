/**
 * 插件参数设置
 * @author pnpeng
 * @date 2018-03-09
 */

// ajax
$.ajaxSetup({
    type: 'GET',   // 请求类型
    aysnc: true,   // 是否异步加载
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});
// toastr
toastr.options = {
    closeButton: true,  // 是否显示关闭按钮
    progressBar: true,  // 是否显示进度条
    showMethod: 'slideDown',  // 显示方式
    timeOut: 4000,      // 自动关闭超时时间
    positionClass: 'toast-top-right'  // 显示位置
};

// icheck
const icheck_settings = {
    checkboxClass: 'icheckbox_minimal-blue',   // checkbox样式
    radioClass : 'iradio_minimal-blue',   // radio样式
    increaseArea: '20%'                 // 触控范围增大百分比
};

// select2
const select2_settings = {
    tags: true,                 // 标记已选择项
    minimumResultsForSearch: 5   // 出现搜索栏的最小个数
};

