<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Events Attendance Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Events Attendance Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.events.attendance')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="event_attendance_page_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" name="event_attendance_page_<?php echo e($lang->slug); ?>_title"  class="form-control" value="<?php echo e(get_static_option('event_attendance_page_'.$lang->slug.'_title')); ?>" id="event_attendance_page_<?php echo e($lang->slug); ?>_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_attendance_page_<?php echo e($lang->slug); ?>_form_button_title"><?php echo e(__('Form Button Title')); ?></label>
                                            <input type="text" name="event_attendance_page_<?php echo e($lang->slug); ?>_form_button_title"  class="form-control" value="<?php echo e(get_static_option('event_attendance_page_'.$lang->slug.'_form_button_title')); ?>" id="event_attendance_page_<?php echo e($lang->slug); ?>_form_button_title">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="event_attendance_receiver_mail"><?php echo e(__('Events Attendance Mail')); ?></label>
                                <input type="text" name="event_attendance_receiver_mail"  class="form-control" value="<?php echo e(get_static_option('event_attendance_receiver_mail')); ?>" id="event_attendance_receiver_mail">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/events/event-attendance-settings.blade.php ENDPATH**/ ?>