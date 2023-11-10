<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Video Gallery Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Video Gallery Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.video.gallery.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_video_gallery_post_items"><?php echo e(__('Video Gallery Items')); ?></label>
                                <input type="number" class="form-control" name="site_video_gallery_post_items" value="<?php echo e(get_static_option('site_video_gallery_post_items')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="site_video_gallery_order_by"><?php echo e(__('Order By')); ?></label>
                                <select name="site_video_gallery_order_by"  class="form-control">
                                    <option <?php if(get_static_option('site_video_gallery_order_by') === 'id'): ?> selected <?php endif; ?> value="id"><?php echo e(__('Id')); ?></option>
                                    <option <?php if(get_static_option('site_video_gallery_order_by') === 'title'): ?> selected <?php endif; ?> value="title"><?php echo e(__('Title')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="site_video_gallery_order"><?php echo e(__('Order')); ?></label>
                                <select name="site_video_gallery_order"  class="form-control">
                                    <option <?php if(get_static_option('site_video_gallery_order') === 'ASC'): ?> <?php endif; ?> value="ASC"><?php echo e(__('Ascending')); ?></option>
                                    <option <?php if(get_static_option('site_video_gallery_order') === 'DESC'): ?> <?php endif; ?> value="DESC"><?php echo e(__('Descending')); ?></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/video-gallery/video-gallery-page-settings.blade.php ENDPATH**/ ?>