<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('image_gallery_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
               <div class="col-lg-12">
                   <div class="case-studies-masonry-wrapper">
                       <ul class="case-studies-menu style-01">
                           <li class="active" data-filter="*"><?php echo e(__('All')); ?></li>
                           <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <li data-filter=".<?php echo e(Str::slug($data->title)); ?>"><?php echo e($data->title); ?></li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </ul>
                       <div class="case-studies-masonry">
                           <?php $__currentLoopData = $all_gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="col-lg-4 col-md-6 masonry-item <?php echo e(Str::slug(get_image_category_name_by_id($data->cat_id))); ?>">
                                   <div class="single-gallery-image ">
                                       <?php
                                           $gallery_img = get_attachment_image_by_id($data->image,'full',false);
                                           $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';
                                       ?>
                                       <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                       <div class="img-hover">
                                           <a href="<?php echo e($img_url); ?>" title="<?php echo e($data->title); ?>" class="image-popup">
                                               <i class="fas fa-search"></i>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </div>
                   </div>
                   <div class="blog-pagination">
                       <?php echo $all_gallery_images->links(); ?>

                   </div>
               </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/image-gallery.blade.php ENDPATH**/ ?>