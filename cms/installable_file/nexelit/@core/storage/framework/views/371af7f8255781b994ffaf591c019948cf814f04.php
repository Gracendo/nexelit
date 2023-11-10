<script>
    $(document).ready(function (){
        "use strict";
        $(document).on('keyup','.title-field',function (){
            var parent = $(this).parent().parent();
            var slugField = parent.find('.slug-field');
            <?php if($type === 'new'): ?>
            slugField.val(convertToSlug($(this).val()));
            if(slugField.val() == ''){
                return;
            }
            <?php else: ?>
            var slug =  slugField.val();

            if(slug == ''){
                slugField.val(convertToSlug($(this).val()));
            }
            <?php endif; ?>
            $.ajax({
                type: 'post',
                url : "<?php echo e($url); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    type: '<?php echo e($type); ?>',
                    slug : slugField.val(),
                    lang : $('.nav-tabs .nav-item .nav-link.active').data('lang')
                },
                success: function (data){
                    parent.find('input[name="slug"]').val(data)
                }
            });
        });

        $(document).on('keyup','.slug-field',function (){
            $(this).val(convertToSlug($(this).val()));
            if($(this).val() == ''){
                return;
            }
            var el = $(this);
            var value = el.val();
            $.ajax({
                type: 'post',
                url : "<?php echo e($url); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    type: '<?php echo e($type); ?>',
                    slug : value,
                    lang : $('.nav-tabs .nav-item .nav-link.active').data('lang')
                },
                success: function (data){
                    $(this).val(data)
                }
            });
        });

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/ /g, '-')
                // .replace(/[^\w-]+/g, '');
        }

    });
</script><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/backend/auto-slug-multilangual.blade.php ENDPATH**/ ?>