<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Form Section')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Form Section Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.contact.page.form.area')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#home-<?php echo e($lang->slug); ?>" role="tab"  aria-selected="true"><?php echo e($lang->name); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="home-<?php echo e($lang->slug); ?>" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="contact_page_<?php echo e($lang->slug); ?>_form_section_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" name="contact_page_<?php echo e($lang->slug); ?>_form_section_title" value="<?php echo e(get_static_option('contact_page_'.$lang->slug.'_form_section_title')); ?>" class="form-control" id="contact_page_<?php echo e($lang->slug); ?>_form_section_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_page_<?php echo e($lang->slug); ?>_form_submit_btn_text"><?php echo e(__('Button Text')); ?></label>
                                        <input type="text" name="contact_page_<?php echo e($lang->slug); ?>_form_submit_btn_text" value="<?php echo e(get_static_option('contact_page_'.$lang->slug.'_form_submit_btn_text')); ?>" class="form-control" id="contact_page_<?php echo e($lang->slug); ?>_form_submit_btn_text">
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="contact_page_form_receiving_mail"><?php echo e(__('Contact Form Mail')); ?></label>
                                <input type="text" name="contact_page_form_receiving_mail" value="<?php echo e(get_static_option('contact_page_form_receiving_mail')); ?>" class="form-control" id="contact_page_form_receiving_mail">
                                <span class="info-text"><?php echo e(__('you will get mail to this address. when anyone submit contact form.')); ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/contact-page/form-section.blade.php ENDPATH**/ ?>