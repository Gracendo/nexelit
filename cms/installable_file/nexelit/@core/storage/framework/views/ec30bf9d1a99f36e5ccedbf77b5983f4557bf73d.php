<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/colorpicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Module Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Module Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.module.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php $default_lang = get_default_language();
                            ?>
                            <div class="form-group">
                                <label for="job_module_status"><strong><?php echo e(get_static_option('career_with_us_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="job_module_status"  <?php if(!empty(get_static_option('job_module_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="events_module_status"><strong><?php echo e(get_static_option('events_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="events_module_status"  <?php if(!empty(get_static_option('events_module_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="product_module_status"><strong><?php echo e(get_static_option('product_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="product_module_status"  <?php if(!empty(get_static_option('product_module_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="donations_module_status"><strong><?php echo e(get_static_option('donation_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="donations_module_status"  <?php if(!empty(get_static_option('donations_module_status'))): ?> checked <?php endif; ?>>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="knowledgebase_module_status"><strong><?php echo e(get_static_option('knowledgebase_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="knowledgebase_module_status"  <?php if(!empty(get_static_option('knowledgebase_module_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="appointment_module_status"><strong><?php echo e(get_static_option('appointment_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="appointment_module_status"  <?php if(!empty(get_static_option('appointment_module_status'))): ?> checked <?php endif; ?>>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="course_module_status"><strong><?php echo e(get_static_option('courses_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="course_module_status"  <?php if(!empty(get_static_option('course_module_status'))): ?> checked <?php endif; ?>>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="support_ticket_module_status"><strong><?php echo e(get_static_option('support_ticket_page_'.$default_lang.'_name')); ?> <?php echo e(__('Module Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="support_ticket_module_status"  <?php if(!empty(get_static_option('support_ticket_module_status'))): ?> checked <?php endif; ?>>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/general-settings/module-settings.blade.php ENDPATH**/ ?>