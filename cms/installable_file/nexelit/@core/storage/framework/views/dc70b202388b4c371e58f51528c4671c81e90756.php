<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Knowledgebase Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Knowledgebase Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.knowledge.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_knoeledgebase_post_items"><?php echo e(__('Knowledgebase Topics')); ?></label>
                                <input type="text" class="form-control" name="site_knoeledgebase_post_items" id="site_knoeledgebase_post_items" value="<?php echo e(get_static_option('site_knoeledgebase_post_items')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/knowledgebase/knowledgebase-page-settings.blade.php ENDPATH**/ ?>