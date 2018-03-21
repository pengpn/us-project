/**
 * Pjax全局处理
 * @author pnpeng
 * @date 2018-03-12
 */

$.pjax.defaults.timeout = 5000;
$.pjax.defaults.maxCacheLength = 0;
NProgress.configure({ parent: '#pjax-container' });

// 全局加载Pjax
$(document).pjax('a:not(a[target="_blank"])',{
    container: '#pjax-container'
});

// 避免Pjax超时
$(document).on('pjax:timeout', function(event){
    event.preventDefault();
});

// 表单提交Pjax
$(document).on('submit', 'form:not([no-pjax])', function(event){
    $.pjax.submit(event, '#pjax-container');
});

// Pjax请求处理
$(document).on('pjax:send', function(xhr){
    if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        const $submit_btn = $('form:not([no-pjax]) :submit');
        if($submit_btn){
            $submit_btn.button('loading');
        }

        //点击modal弹框中的提交按钮时,使得该弹框的灰色遮罩消失，防止与Pjax样式冲突
        if ($('.modal').hasClass('in')) {
            $('.modal').modal('toggle');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        }
    }
    NProgress.start();
});

// Pjax加载成功后的处理
$(document).on('pjax:complete', function(xhr){
    if(xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        const $submit_btn = $('form[pjax] :submit');
        if($submit_btn) {
            $submit_btn.button('reset');
        }
    }
    initPlugins();
    NProgress.done();
});


// Pjax加载错误后的处理
$(document).on('pjax:error', function(event, XMLHttpRequest, textStatus, errorMsg) {
    throwErrorMessage(XMLHttpRequest);
    // history.back();
    return false;
});

// 初始化插件（Pjax加载后立即触发，使得JS插件初始化的动画效果更流畅）
initPlugins();
function initPlugins()
{
     // select2
     const $select_obj = $('select:not([no-select2])');
     if($select_obj.length > 0){
         $('.modal select').css('width', '100%');  // 修复模态框下的select2插件宽度变窄问题
         $select_obj.select2(select2_settings);
     }
    // icheck
    const $input_obj = $('input:checkbox.minimal, input:radio.minimal');
    if($input_obj.length > 0){
        $input_obj.iCheck(icheck_settings);
    }
//     // datepicker
//     if($('.datepicker').length > 0){
//         $('.datepicker').datepicker(datepicker_settings);
//         // 禁止datepicker插件触发模态框的显示、隐藏事件
//         $('.datepicker').on('show', function(e){
//             e.stopPropagation();
//         }).on('hide', function(e){
//             e.stopPropagation();
//         });
//     }
//     // 清空模态框中的populate数据
//     flushModal($('.modal-search'));
//     // 动态显示title（避免input控件长度过短导致看不到其完整值）
//     $('input').mouseover(function(){
//         $(this).attr('title', $(this).val());
//     });
}


$(function(){
    // 点击左侧菜单栏触发高亮效果（使用Pjax后需要处理）
    $('.sidebar-menu li:not(.treeview) > a').on('click', function(){
        const $li = $(this).parent();
        $li.addClass('active');
        // 自动收缩兄弟元素
        $li.siblings('.treeview.menu-open').find('> a').trigger('click');
        // 去掉兄弟元素的高亮效果
        $li.siblings().removeClass('active').find('li').removeClass('active');
        // 添加父级元素的高亮效果
        $li.closest('li.treeview').addClass('active');
        // 去掉父级的兄弟元素的高亮效果
        $li.closest('li.treeview').siblings().removeClass('active');
    });
});