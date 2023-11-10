<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Login - <?php echo e(get_static_option('site_'.get_user_lang().'_title')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset('assets/uploads/site-favicon.'.get_static_option('site_favicon'))); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/themify-icons.css')); ?>">
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/typography.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/default-css.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/responsive.css')); ?>">
    <!-- modernizr css -->
    <script src="<?php echo e(asset('assets/common/vendor/modernizr-2.8.3.min.js')); ?>"></script>
    <style>
        
    .adminlogin-info {
      margin-top: 40px;
      display: block;
      width: 100%;
    }
    .adminlogin-info table {
      display: ;
      width: 100%;
    }
    .adminlogin-info table th,.adminlogin-info table td {
      font-size: 14px;
      font-weight: 700;
      padding: 10px;
    }
    button#autoLogin {
        border: none;
        padding: 5px 10px;
        border-radius: 2px;
        background-color: #439c43;
        color: #fff;
        transition: all 300ms;
    }
    
    button#autoLogin:hover {
        opacity: .7;
    }

    </style>
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>

    <!-- jquery latest version -->
    <script src="<?php echo e(asset('assets/common/vendor/jquery-2.2.4.min.js')); ?>"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo e(asset('assets/common/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.slicknav.min.js')); ?>"></script>

    <!-- others plugins -->
    <script src="<?php echo e(asset('assets/backend/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/scripts.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/layouts/login-screens.blade.php ENDPATH**/ ?>