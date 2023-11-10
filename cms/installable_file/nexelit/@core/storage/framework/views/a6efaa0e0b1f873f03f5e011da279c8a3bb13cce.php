<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Feedback Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Feedback Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.feedback.page.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_form_title"><?php echo e(__('Form Title')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_form_title"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_form_title')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_form_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_name_label"><?php echo e(__('Name Label')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_name_label"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_name_label')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_name_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_email_label"><?php echo e(__('Email Label')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_email_label"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_email_label')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_email_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_ratings_label"><?php echo e(__('Ratings Label')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_ratings_label"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_ratings_label')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_ratings_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_description_label"><?php echo e(__('Description Label')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_description_label"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_description_label')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_description_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_<?php echo e($lang->slug); ?>_button_text"><?php echo e(__('Button Text')); ?></label>
                                            <input type="text" name="feedback_page_form_<?php echo e($lang->slug); ?>_button_text"  class="form-control" value="<?php echo e(get_static_option('feedback_page_form_'.$lang->slug.'_button_text')); ?>" id="feedback_page_form_<?php echo e($lang->slug); ?>_button_text">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="feedback_notify_mail"><?php echo e(__('Feedback Notify Email')); ?></label>
                                <input type="text" name="feedback_notify_mail"  class="form-control" value="<?php echo e(get_static_option('feedback_notify_mail')); ?>" id="feedback_notify_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/feedback/feedback-page-settings.blade.php ENDPATH**/ ?>