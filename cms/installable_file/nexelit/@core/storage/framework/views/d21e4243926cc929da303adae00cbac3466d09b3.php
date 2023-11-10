<?php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($course->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 ?>
<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])); ?>" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="<?php echo e(optional($course->lang_front)->title ?? ''); ?>" />
    <meta property="og:image" content="<?php echo e($post_img); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($course->lang_front->meta_description ?? ''); ?>">
    <meta name="tags" content="<?php echo e($course->lang_front->meta_tag ?? ''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($course->lang_front->title ?? __('untitled')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($course->lang_front->title ?? __('untitled')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-area-wrapper">
                        <div class="thumb">
                            <?php echo render_image_markup_by_attachment_id($course->image); ?>

                        </div>
                        <div class="content-tab-wrapper">
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link" data-toggle="tab" href="#nav-overview" role="tab" aria-selected="true"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_overview_tab_title')); ?></a>
                                    <a class="nav-link active" data-toggle="tab" href="#nav-curriculum" role="tab"  aria-selected="false"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_curriculum_tab_title')); ?></a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-instructor" role="tab"  aria-selected="false"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_instructor_tab_title')); ?></a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-reviews" role="tab"  aria-selected="false"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_reviews_tab_title')); ?></a>
                                </div>
                            </nav>
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="nav-overview" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <?php echo $course->lang_front->description ?? ''; ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-curriculum" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="curriculum-item-wrapper">
                                            <?php $__currentLoopData = $all_curriculumn_with_lesson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curriculumn_id => $curriculum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="single-curriculum-item">
                                                <div id="accordion_<?php echo e($curriculumn_id); ?>">
                                                    <div class="card">
                                                        <div class="card-header" >
                                                            <div data-toggle="collapse" data-target="#collapseOne_<?php echo e($curriculumn_id); ?>" aria-expanded="<?php echo e($loop->first ? 'true' : 'false'); ?>" aria-controls="collapseOne">
                                                                <h3 class="title"><?php echo e($curriculum['curriculum']['title'] ?? ''); ?></h3>
                                                                <?php
                                                                $curr_description = $curriculum['curriculum']['description'] ?? '';
                                                                ?>
                                                                <?php if(!empty($curr_description) ): ?>
                                                                <p class="description"><?php echo $curr_description; ?></p>
                                                                <?php endif; ?>
                                                                 <span class="lesson-count"><?php echo e($curriculum['curriculum']['count'] ?? 0); ?> <?php echo e(__('Lessons')); ?></span>
                                                            </div>
                                                           
                                                        </div>
                                                        <div id="collapseOne_<?php echo e($curriculumn_id); ?>" class="collapse <?php if($loop->first): ?> show  <?php endif; ?>"  data-parent="#accordion_<?php echo e($curriculumn_id); ?>">
                                                            <div class="card-body">
                                                               <ul class="lesson-list">
                                                                   <?php
                                                                    $lessons = $curriculum['lessons'] ?? [];
                                                                   ?>

                                                                   <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson_id => $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                   <li>
                                                                       <a href="<?php echo e(route('frontend.course.lesson',['course_id' => $course->id,'id' => $lesson_id])); ?>">
                                                                           <div class="lession-title"><i class="fas fa-file-alt"></i> <?php echo e($lesson['title'] ?? __('Untitled')); ?></div>
                                                                           <div class="right">
                                                                               <span class="duration"><?php echo e($lesson['duration'] ?? ''); ?> <?php echo e($lesson['duration_type'] ?? ''); ?></span>
                                                                               <?php if(isset($lesson['preview']) && $lesson['preview'] === 'yes'): ?>
                                                                               <i class="fas fa-eye"></i>
                                                                               <?php elseif(isset($lesson['preview']) && $lesson['preview'] === 'no'): ?>
                                                                               <i class="fas fa-lock"></i>
                                                                               <?php endif; ?>
                                                                           </div>
                                                                       </a>
                                                                   </li>
                                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                               </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-instructor" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="instructor-wrap">
                                            <div class="thumb">
                                                <?php echo render_image_markup_by_attachment_id($course->instructor->image ?? ''); ?>

                                            </div>
                                            <div class="content-wrap">
                                                <span class="designation"><?php echo e($course->instructor->designation ?? ''); ?></span>
                                                <?php if(!empty(optional($course->instructor)->id)): ?>
                                                    <a href="<?php echo e(route('frontend.course.instructor',[Str::slug($course->instructor->name),optional($course->instructor)->id])); ?>">
                                                <?php endif; ?>
                                                <h3 class="title"><?php echo e(optional($course->instructor)->name); ?></h3>
                                                </a>
                                                <div class="description"><?php echo optional($course->instructor)->lang_front->description ?? ''; ?></div>
                                                <ul class="social-wrap">
                                                    <?php $__currentLoopData = $course->instructor->social_icons ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e($course->instructor->social_icon_url[$loop->index] ?? '#'); ?>"><i class="<?php echo e($icon); ?>"></i></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel" >
                                    <div class="tab-inner-area">
                                        <div class="feedback-wrapper">
                                            <?php if(auth()->guard('web')->check()): ?>
                                                <div class="feedback-form-wrapper">
                                                    <h3 class="title"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_leave_feedback_title')); ?></h3>
                                                    <form action="<?php echo e(route('frontend.course.review')); ?>" method="post" id="appointment_rating_form" class="appointment-booking-form">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="error-message"></div>
                                                        <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                                        <div class="form-group">
                                                            <label for="rating-empty-clearable2"><?php echo e(__('Ratings')); ?></label>
                                                            <input type="number" name="ratings"
                                                                   id="rating-empty-clearable2"
                                                                   class="rating text-warning"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""><?php echo e(__('Message')); ?></label>
                                                            <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn-boxed appointment" id="appointment_ratings"><?php echo e(__('Submit')); ?>  <i class="fas fa-spinner fa-spin d-none"></i></button>
                                                    </form>
                                                </div>
                                            <?php else: ?>
                                                <?php echo $__env->make('frontend.partials.ajax-login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                            <?php if(count($course->reviews) > 0): ?>
                                                <div class="feedback-comment-list-wrap margin-top-40">
                                                    <h3 class="title"><?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_client_feedback_title')); ?></h3>
                                                    <ul class="feedback-list">
                                                        <?php $__currentLoopData = $course->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="single-feedback-item">
                                                                <div class="content">
                                                                    <h4 class="title"><?php echo e($data->user ? $data->user->username : __("Anonymous")); ?></h4>
                                                                    <div class="rating-wrap single">
                                                                        <?php for( $i =1; $i <= $data->ratings; $i++ ): ?>
                                                                            <i class="fas fa-star"></i>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                    <div class="description"><?php echo e($data->message); ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <div class="course-details-list-wrap">
                            <ul>
                                <li><strong><i class="fas fa-money"></i> <?php echo e(__("Price")); ?></strong> <span class="right">
                                    <span class="price-wrap">
                                        <?php if(!empty($course->price) && $course->price == 0): ?>
                                            <?php echo e(__('Free')); ?>

                                            <?php else: ?>
                                            <?php echo e(amount_with_currency_symbol($course->price)); ?> <del><?php echo e(amount_with_currency_symbol($course->sale_price)); ?></del></span>
                                        <?php endif; ?>
                                    </span>
                                </li>
                                <?php if(!empty(optional($course->instructor)->id)): ?>
                                <li><strong><i class="fas fa-user-graduate"></i> <?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_instructor_tab_title')); ?></strong> <span class="right"> <a href="<?php echo e(route('frontend.course.instructor',[Str::slug($course->instructor->name),optional($course->instructor)->id])); ?>"><?php echo e(optional($course->instructor)->name); ?></a></span></li>
                                <?php endif; ?>
                                <li><strong><i class="fas fa-clock-o"></i> <?php echo e(__("Duration")); ?></strong> <span class="right"> <?php echo e($course->duration); ?> <?php echo e($course->duration_type); ?></span></li>
                                <li><strong><i class="fas fa-tags "></i> <?php echo e(__("Category")); ?></strong> <span class="right"><a
                                                href="<?php echo e(route('frontend.course.category',[Str::slug(optional(optional($course->category)->lang_front)->title,'-',optional(optional($course->category)->lang_front)->lang),optional($course->category)->id])); ?>"><?php echo e(optional(optional($course->category)->lang_front)->title); ?></a></span></li>
                                <li><strong><i class="fas fa-folder-open"></i> <?php echo e(get_static_option('course_single_'.$user_select_lang_slug.'_curriculum_tab_title')); ?></strong> <span class="right"><?php echo e(count(unserialize($course->curriculum_id,['class' => false]))); ?></span></li>
                                <li><strong><i class="fas fa-file-alt"></i> <?php echo e(__("Lectures")); ?></strong> <span class="right"><?php echo e(optional($course->lesson_count)->count()); ?></span></li>
                                <li><strong><i class="fas fa-users"></i> <?php echo e(__("Enrolled")); ?></strong> <span class="right"><?php echo e($course->enrolled_student); ?></span></li>
                            </ul>
                            <?php if($course->enroll_required): ?>
                            <div class="btn-wrapper">
                                <?php
                                    $URL = $is_purchased ? route('frontend.course.lesson.start',$course->id) : route('frontend.course.enroll',$course->id);
                                    $button_url = $course->external_url ?? $URL;
                                ?>
                                <a href="<?php echo e($button_url); ?>" class="boxed-btn <?php echo e($is_purchased  ? 'purchased' : ''); ?> "><?php echo e($is_purchased ? __('Start Learning') : get_static_option('course_single_'.$user_select_lang_slug.'_enroll_button_text')); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/frontend/js/bootstrap4-rating-input.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.ajax-login-form-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function ($){
            "use strict";

            $(document).on('click', '#appointment_ratings', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('appointment_rating_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.course.review')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#appointment_ratings').children('i').removeClass('d-none');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        $('#appointment_ratings').children('i').addClass('d-none');
                        errMsgContainer.html('');
                        errMsgContainer.append('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');

                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#appointment_ratings').children('i').addClass('d-none');
                    }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/courses/single.blade.php ENDPATH**/ ?>