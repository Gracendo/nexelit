<?php $__env->startSection('site-title'); ?>
    <?php echo e($knowledgebase->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($knowledgebase->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($knowledgebase->meta_description); ?>">
    <meta name="tags" content="<?php echo e($knowledgebase->meta_tag); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="knowledgebase-details-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-knowledgebase-details">
                        <?php echo $knowledgebase->content; ?>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('knowledgebase',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/knowledgebase/knowledgebase-single.blade.php ENDPATH**/ ?>