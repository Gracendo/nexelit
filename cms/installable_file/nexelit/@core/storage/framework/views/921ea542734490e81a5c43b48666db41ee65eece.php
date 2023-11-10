<?php $__env->startSection('page-meta-data'); ?>
<meta name="description" content="<?php echo e($page_post->meta_description); ?>">
<meta name="tags" content="<?php echo e($page_post->meta_tags); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if($page_post->visibility === 'user' && !auth()->guard('web')->check()): ?>
       <section class="padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-warning"><strong><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('login')); ?></a></strong> <?php echo e(__('to see page content')); ?></div>
                    </div>
                </div>
            </div>
       </section>
    <?php else: ?>
        <?php if(!empty($page_post->page_builder_status)): ?>
            <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page',$page_post->id); ?>

        <?php else: ?>
            <?php echo $__env->make('frontend.partials.dynamic-page-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/dynamic-single.blade.php ENDPATH**/ ?>