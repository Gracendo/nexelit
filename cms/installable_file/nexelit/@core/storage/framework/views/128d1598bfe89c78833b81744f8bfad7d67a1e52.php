<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Preloader Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <?php $site_color = get_static_option('site_color'); ?>
    <style>
        /* admin preloader settings */
        ul.predefine-preloader-wrap {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
        }

        ul.predefine-preloader-wrap li {
            margin: 10px;
        }
        ul.predefine-preloader-wrap li {
            display: inline-block;
            border: 1px solid #e2e2e2;
            cursor: pointer;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* style 01 */
        .backend-preloader-wrap .lds-circle {
            display: inline-block;
            transform: translateZ(1px);
        }
        .backend-preloader-wrap .lds-circle > div {
            display: inline-block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            background: <?php echo e($site_color); ?>;
            animation: lds-circle 2.4s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        ul.predefine-preloader-wrap li.selected {
            border-color: <?php echo e($site_color); ?>;
            position: relative;
        }
        ul.predefine-preloader-wrap li.selected:after {
            position: absolute;
            left: 0px;
            top: 0;
            z-index: 1;
            color: #fff;
            content: "\f058";
            font-size: 16px;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            line-height: 18px;
            width: 25px;
            height: 25px;
            background-color: <?php echo e($site_color); ?>;
            padding-left: 4px;
            padding-top: 3px;

        }

        @keyframes lds-circle {
            0%, 100% {
                animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
            }
            0% {
                transform: rotateY(0deg);
            }
            50% {
                transform: rotateY(1800deg);
                animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
            }
            100% {
                transform: rotateY(3600deg);
            }
        }

        /* style 02 */
        .backend-preloader-wrap .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .backend-preloader-wrap .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid <?php echo e($site_color); ?>;
            border-color: <?php echo e($site_color); ?> transparent <?php echo e($site_color); ?> transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* style 03 */
        .backend-preloader-wrap .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .backend-preloader-wrap .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: <?php echo e($site_color); ?>;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }
        .backend-preloader-wrap .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }
        .backend-preloader-wrap .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }
        .backend-preloader-wrap .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }
        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }
            50%, 100% {
                top: 24px;
                height: 32px;
            }
        }
        /* style 04 */
        .lds-heart {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            transform: rotate(45deg);
            transform-origin: 40px 40px;
        }
        .lds-heart div {
            top: 32px;
            left: 32px;
            position: absolute;
            width: 32px;
            height: 32px;
            background: <?php echo e($site_color); ?>;
            animation: lds-heart 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        .lds-heart div:after,
        .lds-heart div:before {
            content: " ";
            position: absolute;
            display: block;
            width: 32px;
            height: 32px;
            background: <?php echo e($site_color); ?>;
        }
        .lds-heart div:before {
            left: -24px;
            border-radius: 50% 0 0 50%;
        }
        .lds-heart div:after {
            top: -24px;
            border-radius: 50% 50% 0 0;
        }
        @keyframes lds-heart {
            0% {
                transform: scale(0.95);
            }
            5% {
                transform: scale(1.1);
            }
            39% {
                transform: scale(0.85);
            }
            45% {
                transform: scale(1);
            }
            60% {
                transform: scale(0.95);
            }
            100% {
                transform: scale(0.9);
            }
        }

        /* style 05*/
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid <?php echo e($site_color); ?>;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: <?php echo e($site_color); ?> transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /*  style 06 */
        .lds-roller {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
        }
        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: <?php echo e($site_color); ?>;
            margin: -4px 0 0 -4px;
        }
        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
            top: 63px;
            left: 63px;
        }
        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
            top: 68px;
            left: 56px;
        }
        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
            top: 71px;
            left: 48px;
        }
        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }
        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
            top: 71px;
            left: 32px;
        }
        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
            top: 68px;
            left: 24px;
        }
        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
            top: 63px;
            left: 17px;
        }
        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12px;
        }
        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* style 07 */
        .lds-default {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-default div {
            position: absolute;
            width: 6px;
            height: 6px;
            background: <?php echo e($site_color); ?>;
            border-radius: 50%;
            animation: lds-default 1.2s linear infinite;
        }
        .lds-default div:nth-child(1) {
            animation-delay: 0s;
            top: 37px;
            left: 66px;
        }
        .lds-default div:nth-child(2) {
            animation-delay: -0.1s;
            top: 22px;
            left: 62px;
        }
        .lds-default div:nth-child(3) {
            animation-delay: -0.2s;
            top: 11px;
            left: 52px;
        }
        .lds-default div:nth-child(4) {
            animation-delay: -0.3s;
            top: 7px;
            left: 37px;
        }
        .lds-default div:nth-child(5) {
            animation-delay: -0.4s;
            top: 11px;
            left: 22px;
        }
        .lds-default div:nth-child(6) {
            animation-delay: -0.5s;
            top: 22px;
            left: 11px;
        }
        .lds-default div:nth-child(7) {
            animation-delay: -0.6s;
            top: 37px;
            left: 7px;
        }
        .lds-default div:nth-child(8) {
            animation-delay: -0.7s;
            top: 52px;
            left: 11px;
        }
        .lds-default div:nth-child(9) {
            animation-delay: -0.8s;
            top: 62px;
            left: 22px;
        }
        .lds-default div:nth-child(10) {
            animation-delay: -0.9s;
            top: 66px;
            left: 37px;
        }
        .lds-default div:nth-child(11) {
            animation-delay: -1s;
            top: 62px;
            left: 52px;
        }
        .lds-default div:nth-child(12) {
            animation-delay: -1.1s;
            top: 52px;
            left: 62px;
        }
        @keyframes lds-default {
            0%, 20%, 80%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
        }

        /* style 08 */
        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: <?php echo e($site_color); ?>;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(24px, 0);
            }
        }

        /* style 09 */
        .lds-grid {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-grid div {
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: <?php echo e($site_color); ?>;
            animation: lds-grid 1.2s linear infinite;
        }
        .lds-grid div:nth-child(1) {
            top: 8px;
            left: 8px;
            animation-delay: 0s;
        }
        .lds-grid div:nth-child(2) {
            top: 8px;
            left: 32px;
            animation-delay: -0.4s;
        }
        .lds-grid div:nth-child(3) {
            top: 8px;
            left: 56px;
            animation-delay: -0.8s;
        }
        .lds-grid div:nth-child(4) {
            top: 32px;
            left: 8px;
            animation-delay: -0.4s;
        }
        .lds-grid div:nth-child(5) {
            top: 32px;
            left: 32px;
            animation-delay: -0.8s;
        }
        .lds-grid div:nth-child(6) {
            top: 32px;
            left: 56px;
            animation-delay: -1.2s;
        }
        .lds-grid div:nth-child(7) {
            top: 56px;
            left: 8px;
            animation-delay: -0.8s;
        }
        .lds-grid div:nth-child(8) {
            top: 56px;
            left: 32px;
            animation-delay: -1.2s;
        }
        .lds-grid div:nth-child(9) {
            top: 56px;
            left: 56px;
            animation-delay: -1.6s;
        }
        @keyframes lds-grid {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        /* style 10 */
        .lds-hourglass {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-hourglass:after {
            content: " ";
            display: block;
            border-radius: 50%;
            width: 0;
            height: 0;
            margin: 8px;
            box-sizing: border-box;
            border: 32px solid <?php echo e($site_color); ?>;
            border-color: <?php echo e($site_color); ?> transparent <?php echo e($site_color); ?> transparent;
            animation: lds-hourglass 1.2s infinite;
        }
        @keyframes lds-hourglass {
            0% {
                transform: rotate(0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }
            50% {
                transform: rotate(900deg);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            100% {
                transform: rotate(1800deg);
            }
        }

        /* style 11 */
        .lds-ripple {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ripple div {
            position: absolute;
            border: 4px solid <?php echo e($site_color); ?>;
            opacity: 1;
            border-radius: 50%;
            animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }
        .lds-ripple div:nth-child(2) {
            animation-delay: -0.5s;
        }
        @keyframes lds-ripple {
            0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
            }
            100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
            }
        }

        /* style 12 */
        .lds-spinner {
            color: <?php echo e($site_color); ?>;
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-spinner div {
            transform-origin: 40px 40px;
            animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
            content: " ";
            display: block;
            position: absolute;
            top: 3px;
            left: 37px;
            width: 6px;
            height: 18px;
            border-radius: 20%;
            background: <?php echo e(get_static_option('site_color')); ?>;
        }
        .lds-spinner div:nth-child(1) {
            transform: rotate(0deg);
            animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
            transform: rotate(30deg);
            animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
            transform: rotate(60deg);
            animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
            transform: rotate(90deg);
            animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
            transform: rotate(120deg);
            animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
            transform: rotate(150deg);
            animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
            transform: rotate(180deg);
            animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
            transform: rotate(210deg);
            animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
            transform: rotate(240deg);
            animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
            transform: rotate(270deg);
            animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
            transform: rotate(300deg);
            animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
            transform: rotate(330deg);
            animation-delay: 0s;
        }
        @keyframes lds-spinner {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Preloader Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.preloader.settings')); ?>" method="Post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="preloader_default" id="preloader_default" value="<?php echo e(get_static_option('preloader_default')); ?>">
                            <div class="form-group">
                                <label for="preloader_status"><strong><?php echo e(__('Preloader Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="preloader_status" <?php if(!empty(get_static_option('preloader_status'))): ?> checked <?php endif; ?> id="preloader_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="preloader_custom"><strong><?php echo e(__('Custom Image Preloader Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="preloader_custom" <?php if(!empty(get_static_option('preloader_custom'))): ?> checked <?php endif; ?> id="preloader_custom">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="preloader_cacncel_button"><strong><?php echo e(__('Preloader Cacnel Button Show/hide')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="preloader_cacncel_button" <?php if(!empty(get_static_option('preloader_cacncel_button'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group custom_preloader_field_wrapper" style="display: <?php if(!empty(get_static_option('preloader_custom'))): ?> block <?php else: ?> none <?php endif; ?>">
                                <label for="preloader_custom_image"><strong><?php echo e(__('Custom Preloader Image')); ?></strong></label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $blog_img = get_attachment_image_by_id(get_static_option('preloader_custom_image'),null,true);
                                            $blog_image_btn_label = 'Upload Image';
                                        ?>
                                        <?php if(!empty($blog_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($blog_img['img_url']); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php  $blog_image_btn_label = 'Change Image'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="preloader_custom_image" name="preloader_custom_image" value="<?php echo e(get_static_option('preloader_custom_image')); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($blog_image_btn_label)); ?>

                                    </button>
                                </div>
                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png,gif.')); ?></small>
                            </div>
                            <ul class="predefine-preloader-wrap" style="display: <?php if(!empty(get_static_option('preloader_custom'))): ?> none <?php else: ?> flex <?php endif; ?>">
                                <li data-preloader="1">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-circle"><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="2">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-dual-ring"></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="3">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-facebook"><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="4">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-heart"><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="5">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="6">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="7">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="8">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="9">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="10">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-hourglass"></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="11">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-ripple"><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                                <li data-preloader="12">
                                    <div class="backend-preloader-wrap">
                                        <div class="backend-preloader-inner">
                                            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="db_backup_btn"><?php echo e(__('Save Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                selectDefaultPreloader()
                function selectDefaultPreloader(){
                    var value = $('#preloader_default').val();
                    $('.predefine-preloader-wrap > li[data-preloader="'+value+'"]').addClass('selected');
                }
                $(document).on('click','.predefine-preloader-wrap > li',function (e) {
                    e.preventDefault();
                    var el = $(this);
                    el.addClass('selected').siblings().removeClass('selected');
                    $('#preloader_default').val(el.data('preloader'));
                });

                $(document).on('change','#preloader_custom',function (e) {
                    e.preventDefault();
                    var el = $(this);
                    var preloaderField = $('.custom_preloader_field_wrapper');
                    var preDefinePreloader = $('.predefine-preloader-wrap');
                    if(el.is(':checked')){
                        preloaderField.show();
                        preDefinePreloader.hide();
                    }else{
                        preloaderField.hide();
                        preDefinePreloader.css({
                            'display' : 'flex'
                        });
                    }
                })

            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/preloader-settings.blade.php ENDPATH**/ ?>