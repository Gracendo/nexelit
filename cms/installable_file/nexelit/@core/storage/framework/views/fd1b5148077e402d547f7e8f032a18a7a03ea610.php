<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $a = 1; ?>
        <?php $__currentLoopData = $all_price_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $price_plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="pricing-plan-area <?php if( $a % 2 == 0): ?> bg-liteblue <?php endif; ?> price-inner padding-bottom-120 padding-top-110">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title desktop-center padding-bottom-55">
                            <h2 class="title"><?php echo e(get_price_plan_category_by_id($key)); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                            <div class="price-plan-slider global-carousel-init"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-nav="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            <?php $__currentLoopData = $price_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-price-plan-01 <?php if( $a % 2 != 0): ?> bg-lightwhite <?php endif; ?>  <?php if(!empty($data->highlight)): ?> style-02 active <?php endif; ?>">
                                    <div class="price-header">
                                        <div class="name-box">
                                            <h4 class="name"><?php echo e($data->title); ?></h4>
                                        </div>
                                        <div class="price-wrap">
                                            <span class="price"><?php echo e(amount_with_currency_symbol($data->price)); ?></span><span class="month"><?php echo e($data->type); ?></span>
                                        </div>
                                    </div>
                                    <div class="price-body">
                                        <ul>
                                            <?php
                                                $features = explode("\n",$data->features);
                                            ?>
                                            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($item); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <div class="btn-wrapper">
                                        <?php
                                            $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                        ?>
                                        <a href="<?php echo e($url); ?>" rel="canonical" class="boxed-btn"><?php echo e($data->btn_text); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $a++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/price-plan.blade.php ENDPATH**/ ?>