<script type="text/javascript">
    jQuery(document).ready(function(){
        $("<?php echo $validator['selector']; ?>").validate({
            errorElement: 'span',
            errorClass: 'help-block error-help-block',

            errorPlacement: function(error, element) {
                element.attr('data-toggle', 'tooltip');
                element.attr('data-html', true);
                let title = '';
                $.each(error, function(i){
                    title += error[i].innerText + '<br>';
                });
                element.attr('data-original-title', title);
                element.tooltip();
            },

            unhighlight: function(element) {
                const $has_error = $(element).closest('.form-group.has-error');
                if($has_error.length === 0) return;
                // 添加绿色样式
                $has_error.removeClass('has-error').addClass('has-success');
                $has_error.removeAttr('data-original-title');
                $has_error.tooltip('hide');
                // 去除Tab栏标识
                const $has_tab = $('.nav-tabs-custom');
                if($has_tab.length === 0) return;
                if($(element).closest('.tab-pane').find('.has-error').length === 0){
                    const tab_index = $('.tab-pane').index($(element).closest('.tab-pane'));
                    $('.nav-tabs').find('li:eq('+ tab_index +')>a>i').remove();
                }
            },
            highlight: function(element) {
                const $has_error = $(element).closest('.form-group.has-error');
                if($has_error.length > 0) return;
                // 添加红色样式
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                // 添加Tab栏标识
                const $has_tab = $('.nav-tabs-custom');
                if($has_tab.length === 0) return;
                const tab_index = $('.tab-pane').index($(element).closest('.tab-pane'));
                const icon = ' <i class="fa fa-exclamation-circle text-red"></i>';
                const $tab_li = $('.nav-tabs').find('li:eq('+ tab_index +')');
                if($tab_li.find('i').length !== 0) return;
                $tab_li.children('a').append(icon);
            },

            ignore: 'input[type="hidden"], .hidden input, .hidden select, .modal input, .modal select',

            focusInvalid: false, // do not focus the last invalid input

            <?php if (Config::get('jsvalidation.focus_on_error')): ?>
            invalidHandler: function(form, validator) {
                if (!validator.numberOfInvalids())
                    return;

                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).offset().top - 40
                }, <?php echo Config::get('jsvalidation.duration_animate') ?>);
                $(validator.errorList[0].element).focus();
            },
            <?php endif; ?>

            submitHandler: function(){
                // 自动移除隐藏的克隆表
                const $tr_hidden = $('fieldset').find('table>tbody>tr.hidden');
                if($tr_hidden.length > 0){
                    $tr_hidden.remove();
                }
                // 自动移除模态框中的可提交元素
                const $modal = $('fieldset').find('.modal');
                if($modal.length > 0){
                    $modal.find('input,select').remove();
                }
                return true;
            },

            rules: <?php echo json_encode($validator['rules']); ?>
        });
    })
</script>
