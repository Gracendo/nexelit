<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('License Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("License Settings")); ?></h4>
                        <?php if('verified' == get_static_option('item_license_status')): ?>
                            <div class="alert alert-success"><?php echo e(__('Your Application is Registered')); ?></div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.general.license.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="item_purchase_key"><?php echo e(__('Purchase Key')); ?></label>
                                <input type="text" name="item_purchase_key"  class="form-control" value="<?php echo e(get_static_option('item_purchase_key')); ?>" id="item_purchase_key">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Submit Information')); ?></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/license-settings.blade.php ENDPATH**/ ?>