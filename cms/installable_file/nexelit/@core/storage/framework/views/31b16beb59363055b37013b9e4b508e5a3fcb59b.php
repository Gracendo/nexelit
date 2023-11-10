<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url" content="<?php echo e(route('frontend.services.single',$service_item->slug)); ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php echo e($service_item->title); ?>"/>
    <?php echo render_og_meta_image_by_attachment_id($service_item->image); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($service_item->meta_description); ?>">
    <meta name="tags" content="<?php echo e($service_item->meta_tag); ?>">
    <?php echo render_og_meta_image_by_attachment_id($service_item->image); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($service_item->title); ?> -  <?php echo e(get_static_option('service_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($service_item->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="page-content service-details padding-top-120 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-details-item">
                        <div class="thumb margin-bottom-40">
                            <?php echo render_image_markup_by_attachment_id($service_item->image); ?>

                        </div>
                        <div class="service-description">
                            <?php echo $service_item->description; ?>

                        </div>
                        <?php if(!empty($price_plan)): ?>
                        <div class="price-plan-wrapper margin-top-40">
                            <div class="row">
                                <?php $__currentLoopData = $price_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6">
                                    <div class="single-price-plan-01 margin-bottom-20">
                                        <div class="price-header">
                                            <div class="name-box">
                                                <h4 class="name"><?php echo e($data->title); ?></h4>
                                            </div>
                                            <div class="price-wrap">
                                                <span class="price"><?php echo e(amount_with_currency_symbol($data->price)); ?></span><span
                                                        class="month"><?php echo e($data->type); ?></span>
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
                                            <a href="<?php echo e($url); ?>" class="boxed-btn"><?php echo e($data->btn_text); ?></a>
                                        </div>
                                    </div>
                                </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('service',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/service/service-single.blade.php ENDPATH**/ ?>