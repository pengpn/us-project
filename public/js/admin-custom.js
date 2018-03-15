/**
 * 后台公共函数
 * @author pnpengg
 * @date 2018-03-15
 * @namespace window.exrate_converter 汇率数据容器
 */


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