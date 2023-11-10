
<?php if(!empty(get_static_option('contact_page_contact_info_section_status'))): ?>
    <div class="inner-contact-section padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <?php $a = 1;?>
                <?php $__currentLoopData = $all_contact_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="single-contact-item">
                            <div class="icon style-0<?php echo e($a); ?>">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <span class="title"><?php echo e($data->title); ?></span>
                                <?php
                                    $info_details = !empty($data->description) ? explode("\n",$data->description) : [];
                                ?>
                                <?php $__currentLoopData = $info_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="details"><?php echo e($item); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($a == 4){$a =1;}else{$a++;} ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
<?php endif; ?>
<?php if(!empty(get_static_option('contact_page_contact_section_status'))): ?>
    <div class="contact-section padding-bottom-120">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h4 class="title"><?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_form_section_title')); ?></h4>
                                </div>
                                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php if($errors->any()): ?>
                                    <ul class="alert alert-danger">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <form action="<?php echo e(route('frontend.contact.message')); ?>" method="post" class="contact-page-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <?php echo render_form_field_for_frontend(get_static_option('contact_page_contact_form_fields')); ?>


                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn reverse-color"><?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_form_submit_btn_text')); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact_map">
                        <?php echo render_embed_google_map(get_static_option('contact_page_map_section_location'),get_static_option('contact_page_map_section_zoom')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/partials/contact-page-content.blade.php ENDPATH**/ ?>