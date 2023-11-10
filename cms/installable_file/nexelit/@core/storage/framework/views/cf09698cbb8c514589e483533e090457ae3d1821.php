<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('video_gallery_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_gallery_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-gallery-video">
                            <div class="embed-code">
                                <?php echo $data->embed_code; ?>

                            </div>
                            <div class="content">
                                <h3 class="title"><?php echo e($data->title); ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <div class="col-lg-12">
                   <div class="blog-pagination">
                       <?php echo $all_gallery_videos->links(); ?>

                   </div>
               </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/video-gallery.blade.php ENDPATH**/ ?>