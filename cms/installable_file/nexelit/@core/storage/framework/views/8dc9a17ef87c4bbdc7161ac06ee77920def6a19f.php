<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('RSS Feed Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("RSS Feed Settings")); ?></h4>
                        <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-danger"><?php echo e($error); ?></div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.general.rss.feed.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_rss_feed_url"><?php echo e(__("RSS Feed URL")); ?></label>
                                <input type="text" name="site_rss_feed_url" id="site_rss_feed_url" class="form-control" value="<?php echo e(get_static_option('site_rss_feed_url')); ?>">
                                <p class="info-text"><?php echo e(__('this url will be add after. www.youdomain.com/')); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="site_rss_feed_title"><?php echo e(__('RSS Feed Title')); ?></label>
                                <input type="text" name="site_rss_feed_title" id="site_rss_feed_title" class="form-control" value="<?php echo e(get_static_option('site_rss_feed_title')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="site_rss_feed_description"><?php echo e(__('RSS Feed Description')); ?></label>
                                <textarea name="site_rss_feed_description" id="site_rss_feed_description" cols="30" rows="5" class="form-control"><?php echo e(get_static_option('site_rss_feed_description')); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/rss-feed-settings.blade.php ENDPATH**/ ?>