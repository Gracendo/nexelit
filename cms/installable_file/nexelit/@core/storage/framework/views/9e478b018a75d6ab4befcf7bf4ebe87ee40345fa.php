<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Appointment Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Appointment Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.appointment.booking.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_information_tab_title"><?php echo e(__('Single Page Information Tab Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_information_tab_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_information_tab_title')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_booking_tab_title"><?php echo e(__('Single Page Booking Tab Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_booking_tab_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_booking_tab_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_feedback_tab_title"><?php echo e(__('Single Page Feedback Tab Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_feedback_tab_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_feedback_tab_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_information_text"><?php echo e(__('Single Page Booking Information Text')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_information_text"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_information_text')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_button_text"><?php echo e(__('Single Page Appointment Booking Button Text')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_button_text"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_button_text')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_about_me_title"><?php echo e(__('Single Page About me Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_about_me_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_about_me_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_educational_info_title"><?php echo e(__('Single Page Education Info Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_educational_info_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_additional_info_title"><?php echo e(__('Single Page Additional Info Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_additional_info_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_specialize_info_title"><?php echo e(__('Single Page Specialize Info Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_specialize_info_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_client_feedback_title"><?php echo e(__('Single Page Client Feedback Title')); ?></label>
                                            <input type="text" name="appointment_single_<?php echo e($lang->slug); ?>_appointment_booking_client_feedback_title"  class="form-control" value="<?php echo e(get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_<?php echo e($lang->slug); ?>_success_page_title"><?php echo e(__('Booking Success Page Title')); ?></label>
                                            <input type="text" name="appointment_booking_<?php echo e($lang->slug); ?>_success_page_title"  class="form-control" value="<?php echo e(get_static_option('appointment_booking_'.$lang->slug.'_success_page_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_<?php echo e($lang->slug); ?>_success_page_description"><?php echo e(__('Booking Success Page Description')); ?></label>
                                            <textarea name="appointment_booking_<?php echo e($lang->slug); ?>_success_page_description" cols="30" class="form-control" rows="5"><?php echo e(get_static_option('appointment_booking_'.$lang->slug.'_success_page_description')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_<?php echo e($lang->slug); ?>_cancel_page_title"><?php echo e(__('Booking Cancel Page Title')); ?></label>
                                            <input type="text" name="appointment_booking_<?php echo e($lang->slug); ?>_cancel_page_title"  class="form-control" value="<?php echo e(get_static_option('appointment_booking_'.$lang->slug.'_cancel_page_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_<?php echo e($lang->slug); ?>_cancel_page_description"><?php echo e(__('Booking Cancel Page Description')); ?></label>
                                            <textarea name="appointment_booking_<?php echo e($lang->slug); ?>_cancel_page_description" cols="30" class="form-control" rows="5"><?php echo e(get_static_option('appointment_booking_'.$lang->slug.'_cancel_page_description')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_page_<?php echo e($lang->slug); ?>_booking_button_text"><?php echo e(__('Booking Button Text')); ?></label>
                                            <input type="text" name="appointment_page_<?php echo e($lang->slug); ?>_booking_button_text"  class="form-control" value="<?php echo e(get_static_option('appointment_page_'.$lang->slug.'_booking_button_text')); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="appointment_notify_mail"><?php echo e(__('Appointment Notify Email')); ?></label>
                                <input type="email" name="appointment_notify_mail"  class="form-control" value="<?php echo e(get_static_option('appointment_notify_mail')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="disable_guest_mode_for_appointment_module"><strong><?php echo e(__('Enable/Disable Guest Checkout')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="disable_guest_mode_for_appointment_module"  <?php if(!empty(get_static_option('disable_guest_mode_for_appointment_module'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/appointment/appointment-settings.blade.php ENDPATH**/ ?>