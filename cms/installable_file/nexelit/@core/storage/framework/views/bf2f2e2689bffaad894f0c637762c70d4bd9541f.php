<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Events Single Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Events Single Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.events.single.page.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="event_single_<?php echo e($lang->slug); ?>_event_info_title"><?php echo e(__('Event Info Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_event_info_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_event_info_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_event_info_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_date_title"><?php echo e(__('Date Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_date_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_date_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_date_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_time_title"><?php echo e(__('Time Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_time_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_time_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_time_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_cost_title"><?php echo e(__('Cost Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_cost_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_cost_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_cost_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_category_title"><?php echo e(__('Category Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_category_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_category_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_category_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_organizer_title"><?php echo e(__('Event Organizer Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_organizer_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_organizer_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_organizer_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_organizer_name_title"><?php echo e(__('Organizer Name Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_organizer_name_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_organizer_name_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_organizer_name_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_organizer_email_title"><?php echo e(__('Organizer Email Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_organizer_email_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_organizer_email_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_organizer_email_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_organizer_phone_title"><?php echo e(__('Organizer Phone Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_organizer_phone_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_organizer_phone_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_organizer_phone_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_organizer_website_title"><?php echo e(__('Organizer Website Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_organizer_website_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_organizer_website_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_organizer_website_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_venue_title"><?php echo e(__('Event Venue Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_venue_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_venue_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_venue_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_venue_name_title"><?php echo e(__('Venue Name Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_venue_name_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_venue_name_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_venue_name_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_venue_location_title"><?php echo e(__('Venue Location Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_venue_location_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_venue_location_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_venue_location_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_venue_phone_title"><?php echo e(__('Venue Phone Title')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_venue_phone_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_venue_phone_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_venue_phone_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_reserve_button_title"><?php echo e(__('Reserve Seat Button Text')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_reserve_button_title"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_reserve_button_title')); ?>" id="event_single_<?php echo e($lang->slug); ?>_reserve_button_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_available_ticket_text"><?php echo e(__('Available Ticket Text')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_available_ticket_text"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_available_ticket_text')); ?>" id="event_single_<?php echo e($lang->slug); ?>_available_ticket_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_<?php echo e($lang->slug); ?>_event_expire_text"><?php echo e(__('Event Expire Text')); ?></label>
                                            <input type="text" name="event_single_<?php echo e($lang->slug); ?>_event_expire_text"  class="form-control" value="<?php echo e(get_static_option('event_single_'.$lang->slug.'_event_expire_text')); ?>" id="event_single_<?php echo e($lang->slug); ?>_event_expire_text">
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/events/event-single-page-settings.blade.php ENDPATH**/ ?>