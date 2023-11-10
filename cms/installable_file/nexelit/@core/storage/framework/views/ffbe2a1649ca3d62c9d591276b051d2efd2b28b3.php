<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('feedback_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('feedback_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('feedback_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="contact-section padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title text-center margin-bottom-50">
                                    <h4 class="title"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_form_title')); ?></h4>
                                </div>
                                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <form action="<?php echo e(route('frontend.clients.feedback.store')); ?>" method="post" class="contact-page-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                             <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="form-group">
                                <label for="name"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_name_label')); ?></label>
                                <input type="text" name="name" id="name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_email_label')); ?></label>
                                <input type="text" name="email" id="email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="ratings"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_ratings_label')); ?></label>
                                <input type="hidden" name="ratings" id="ratings" class="form-control" >
                                <ul class="ratings_list">
                                    <li data-value="1">1</li>
                                    <li data-value="2">2</li>
                                    <li data-value="3">3</li>
                                    <li data-value="4">4</li>
                                    <li data-value="5">5</li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="description"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_description_label')); ?></label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="10" ></textarea>
                            </div>
                            <?php echo render_form_field_for_frontend(get_static_option('feedback_page_form_fields')); ?>

                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn reverse-color"><?php echo e(get_static_option('feedback_page_form_'.$user_select_lang_slug.'_button_text')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if(!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_status'))): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
    <?php endif; ?>
    <script>
        (function ($) {
            "use strict";

            $(document).on('click','.ratings_list li',function (e) {
                e.preventDefault();

                var el = $(this);
                var value = el.data('value');
                el.addClass('selected').siblings().removeClass('selected');
                $('#ratings').val(value);
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/feedback-page.blade.php ENDPATH**/ ?>