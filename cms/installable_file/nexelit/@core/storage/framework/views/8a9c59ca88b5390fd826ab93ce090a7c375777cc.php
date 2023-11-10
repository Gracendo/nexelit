<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Donation Single Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Donation Single Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.donations.single.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="donation_single_<?php echo e($lang->slug); ?>_form_title"><?php echo e(__('Donation Form Title')); ?></label>
                                            <input type="text" name="donation_single_<?php echo e($lang->slug); ?>_form_title"  class="form-control" value="<?php echo e(get_static_option('donation_single_'.$lang->slug.'_form_title')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_single_<?php echo e($lang->slug); ?>_form_button_text"><?php echo e(__('Form Button Title')); ?></label>
                                            <input type="text" name="donation_single_<?php echo e($lang->slug); ?>_form_button_text"  class="form-control" value="<?php echo e(get_static_option('donation_single_'.$lang->slug.'_form_button_text')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="donation_single_<?php echo e($lang->slug); ?>_recent_donation_text"><?php echo e(__('Recent Donation Title')); ?></label>
                                            <input type="text" name="donation_single_<?php echo e($lang->slug); ?>_recent_donation_text"  class="form-control" value="<?php echo e(get_static_option('donation_single_'.$lang->slug.'_recent_donation_text')); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount"><?php echo e(__('Custom Donation Amount')); ?></label>
                                <input type="text" name="donation_custom_amount"  class="form-control" value="<?php echo e(get_static_option('donation_custom_amount')); ?>" id="donation_custom_amount">
                                <p><?php echo e(__('Separate amount by comma (,)')); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="donation_default_amount"><?php echo e(__('Default Donation Amount')); ?></label>
                                <input type="text" name="donation_default_amount"  class="form-control" value="<?php echo e(get_static_option('donation_default_amount')); ?>" id="donation_default_amount">
                            </div>
                            <div class="form-group">
                                <label for="donation_notify_mail"><?php echo e(__('Donation Notify Email')); ?></label>
                                <input type="text" name="donation_notify_mail"  class="form-control" value="<?php echo e(get_static_option('donation_notify_mail')); ?>" id="donation_notify_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/donations/donation-single-page-settings.blade.php ENDPATH**/ ?>