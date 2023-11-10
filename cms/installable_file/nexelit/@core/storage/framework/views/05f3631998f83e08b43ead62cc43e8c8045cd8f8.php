<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Cache Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Cache Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.cache.settings')); ?>" method="POST" id="cache_settings_form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="cache_type" id="cache_type" class="form-control">
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" data-value="view"><?php echo e(__('Clear View Cache')); ?></button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" data-value="route"><?php echo e(__('Clear Route Cache')); ?></button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" data-value="config"><?php echo e(__('Clear Configure Cache')); ?></button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" data-value="cache"><?php echo e(__('Clear Cache')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    (function($){
        "use strict";
        
        $(document).ready(function(){
            $(document).on('click','.clear-cache-submit-btn',function(e){
                e.preventDefault();
                $('#cache_type').val($(this).data('value'));
                $('#cache_settings_form').submit();
            });
        });
        
        
    })(jQuery);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/cache-settings.blade.php ENDPATH**/ ?>