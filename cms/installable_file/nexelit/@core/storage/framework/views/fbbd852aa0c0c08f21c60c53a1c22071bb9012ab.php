<?php $__env->startSection('section'); ?>
    <div class="dashboard-form-wrapper">
        <h2 class="title"><?php echo e(__('Change Password')); ?></h2>
        <form action="<?php echo e(route('user.password.change')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="old_password"><?php echo e(__('Old Password')); ?></label>
                <input type="password" class="form-control" id="old_password" name="old_password"
                       placeholder="<?php echo e(__('Old Password')); ?>">
            </div>
            <div class="form-group">
                <label for="password"><?php echo e(__('New Password')); ?></label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="<?php echo e(__('New Password')); ?>">
            </div>
            <div class="form-group">
                <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                <input type="password" class="form-control" id="password_confirmation"
                       name="password_confirmation" placeholder="<?php echo e(__('Confirm Password')); ?>">
            </div>
            <button type="submit" class="submit-btn dash-btn width-200"><?php echo e(__('Save changes')); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/change-password.blade.php ENDPATH**/ ?>