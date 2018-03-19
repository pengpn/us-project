/**
 * 后台公共函数
 * @author pnpengg
 * @date 2018-03-15
 * @namespace window.exrate_converter 汇率数据容器
 */

//改变每页显示数量
function perPageChange(obj)
{
    const per_page = $(obj).val();
    const current_url = window.location.href;
    let redirect_url = null;
    if(current_url.indexOf('per_page') !== -1){
        redirect_url = replaceUrlParamVal('per_page', per_page);
    }else{
        redirect_url = current_url.split('?')[0] + '?per_page=' + per_page +
            (window.location.search ? '&' + window.location.search.replace('?', '') : '');
    }
    $.pjax({ url: redirect_url, container: '#pjax-container' });
}

// 替换URL中参数值
function replaceUrlParamVal(param_name ,replace_with)
{
    const s_url = window.location.href.toString();
    const pattern = eval('/('+ param_name +'=)([^&]*)/gi');
    return s_url.replace(pattern, param_name +'='+ replace_with);
}


// 批量删除
function batchDelete(entity)
{
    let ids = '';
    $('input:checkbox').each(function(){
        const checked_val = $(this).prop('checked') ? $(this).val() : '';
        if (!checked_val) return true;
        ids += checked_val + ',';
    })

    if (ids) {
        ids = ids.substring(0, ids.length - 1);
        deleteHandler(route(entity + '.destroy' , ids));
    }
}

//单个删除
function singleDelete(entity, id)
{
    deleteHandler(route(entity + '.destroy', id));
}

//删除处理
function deleteHandler(url)
{
    swal({
        title: 'Are you sure delete？',
        icon: 'warning',
        buttons: {
            delete: 'Delete',
            cancel: 'Cancel'
        }
    }).then((value) => {
        switch(value) {
            case 'delete':
                const $form = $("<form></form>");
                $form.attr('action', url);
                $form.attr('method','POST');
                const $input_method = $('<input type="hidden" name="_method" value="DELETE">');
                const csrf_token = $('meta[name="csrf-token"]').attr('content');
                const $input_token = $('<input type="hidden" name="_token" value="'+ csrf_token +'" />');
                $form.append($input_method);
                $form.append($input_token);
                $form.appendTo('body');
                $form.css('display', 'none');
                $form.submit();
                break;
        }
    });
}