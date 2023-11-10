<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Email Message Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Email Message Settings")); ?></h4>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <form action="<?php echo e(route('admin.general.email.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="service_query_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Service Query Mail Success Message')); ?></label>
                                            <input type="text" name="service_query_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('service_query_'.$lang->slug.'_success_message')); ?>" id="service_query_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when anyone contact your from service query form.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="case_study_query_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Case Study Query Mail Success Message')); ?></label>
                                            <input type="text" name="case_study_query_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('case_study_query_'.$lang->slug.'_success_message')); ?>" id="case_study_query_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when anyone contact your from case study query form.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="quote_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Quote Mail Success Message')); ?></label>
                                            <input type="text" name="quote_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('quote_mail_'.$lang->slug.'_success_message')); ?>" id="quote_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one contact your from quote form.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="order_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Order Mail Success Message')); ?></label>
                                            <input type="text" name="order_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('order_mail_'.$lang->slug.'_success_message')); ?>" id="order_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one place order.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Contact Mail Success Message')); ?></label>
                                            <input type="text" name="contact_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('contact_mail_'.$lang->slug.'_success_message')); ?>" id="contact_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one contact you via contact page form.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="get_in_touch_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Get In Touch Form Success Message')); ?></label>
                                            <input type="text" name="get_in_touch_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('get_in_touch_mail_'.$lang->slug.'_success_message')); ?>" id="get_in_touch_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one contact you via get in touch form.')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="apply_job_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Apply Job Form Success Message')); ?></label>
                                            <input type="text" name="apply_job_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('apply_job_'.$lang->slug.'_success_message')); ?>" id="apply_job_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any apply to any job')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_attendance_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Event Attendance Form Success Message')); ?></label>
                                            <input type="text" name="event_attendance_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('event_attendance_mail_'.$lang->slug.'_success_message')); ?>" id="event_attendance_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any submit event attendance form')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_form_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Feedback Form Success Message')); ?></label>
                                            <input type="text" name="feedback_form_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('feedback_form_mail_'.$lang->slug.'_success_message')); ?>" id="feedback_form_mail_<?php echo e($lang->slug); ?>_success_message">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any submit feedback form')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_form_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Call To Action Query Form Success Message')); ?></label>
                                            <input type="text" name="appointment_form_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('appointment_form_mail_'.$lang->slug.'_success_message')); ?>">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one submit call to action query form')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="estimate_form_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Estimate Form Success Message')); ?></label>
                                            <input type="text" name="estimate_form_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('estimate_form_mail_'.$lang->slug.'_success_message')); ?>">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one submit estimate form')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="enroll_form_mail_<?php echo e($lang->slug); ?>_success_message"><?php echo e(__('Course Enroll Form Success Message')); ?></label>
                                            <input type="text" name="enroll_form_mail_<?php echo e($lang->slug); ?>_success_message"  class="form-control" value="<?php echo e(get_static_option('enroll_form_mail_'.$lang->slug.'_success_message')); ?>">
                                            <small class="form-text text-muted"><?php echo e(__('this message will show when any one submit course enroll form')); ?></small>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/email-settings.blade.php ENDPATH**/ ?>