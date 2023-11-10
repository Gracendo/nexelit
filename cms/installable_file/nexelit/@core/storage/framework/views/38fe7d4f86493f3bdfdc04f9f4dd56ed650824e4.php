<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Verify Your Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-page-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-form-wrapper">
                        <h2><?php echo e(__('Verify Your Account')); ?></h2>
                        <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong><?php echo e(__('Check Mail for Verification code.')); ?></strong>
                        </div>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('user.email.verify')); ?>" method="post" enctype="multipart/form-data" class="account-form verify-mail">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" name="verification_code" class="form-control" placeholder="<?php echo e(__('Verify Code')); ?>">
                            </div>
                            <div class="form-group btn-wrapper">
                                <button type="submit" class="submit-btn"><?php echo e(__('Verify Email')); ?></button>
                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="col-12 text-center">
                                    <a href="<?php echo e(route('user.resend.verify.mail')); ?>"><?php echo e(__('Send Verify Code Again?')); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/email-verify.blade.php ENDPATH**/ ?>