<?php $title = $title ?? __('Login To Leave Review'); ?>
<div class="login-form">
    <p><?php echo e($title); ?></p>

    <div class="login-form">
        <form action="<?php echo e(route('user.login')); ?>" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
            <?php echo csrf_field(); ?>
            <div class="error-wrap"></div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Username')); ?>">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>">
            </div>
            <div class="form-group btn-wrapper">
                <button type="submit" id="login_btn" class="submit-btn"><?php echo e(__('Login')); ?></button>
            </div>
            <div class="row mb-4 rmber-area">
                <div class="col-6">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                        <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <a class="d-block" href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Create New account?')); ?></a>
                    <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/partials/ajax-login-form.blade.php ENDPATH**/ ?>