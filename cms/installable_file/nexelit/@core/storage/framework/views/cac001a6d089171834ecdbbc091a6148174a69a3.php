<script>
    $(document).ready(function (){
       "use strict";
        $(document).on('keyup','input[name="title"]',function (){
            <?php if($type === 'new'): ?>

                // alert(convertToSlug($('input[name="title"]').val()))

            $('input[name="slug"]').val(convertToSlug($('input[name="title"]').val()));
            if($('input[name="slug"]').val() == ''){
                return;
            }
            <?php else: ?>
            var slug =  $('input[name="slug"]').val();

            if(slug == ''){
                alert()
                $('input[name="slug"]').val(convertToSlug($('input[name="title"]').val()));
            }
            <?php endif; ?>
            $.ajax({
                type: 'post',
                url : "<?php echo e($url); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    type: '<?php echo e($type); ?>',
                    slug : $('input[name="slug"]').val(),
                    lang : $('#language').val()
                },
                success: function (data){
                    $('input[name="slug"]').val(data)
                }
            });
        });

        $(document).on('keyup','input[name="slug"]',function (){
            $('input[name="slug"]').val(convertToSlug($(this).val()));
            if($('input[name="slug"]').val() == ''){
                return;
            }
            $.ajax({
                type: 'post',
                url : "<?php echo e($url); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    type: '<?php echo e($type); ?>',
                    slug : $('input[name="slug"]').val(),
                    lang : $('#language').val()
                },
                success: function (data){
                    $('input[name="slug"]').val(data)
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

</script><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/backend/auto-slug-js.blade.php ENDPATH**/ ?>