<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/lesson-page.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="navbar-outer">
    <div class="lesson-navbar-area">
        <div class="container-fluid">
            <div class="nav-inner-wrap">
                <div class="logo-wrapper">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="right-side-content">
                    <div class="course-title-wrap">
                        <h1 class="title"><?php echo e(optional($course->lang_front)->title); ?></h1>
                    </div>
                    <div class="button-wrap">
                        <a href="<?php echo e(route('frontend.course.single',[optional($course->lang_front)->slug,$course->id])); ?>" class="boxed-btn"><?php echo e(__('Back To')); ?> <?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_name')); ?></a>
                        <a href="#" class="boxed-btn" id="expand_lesson"><i class="fas fa-arrows-alt-h"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="course-content-wrapper-for-lesson">
    <div class="lesson-wrap">
        <div class="curriculum-item-wrapper">
            <?php $__currentLoopData = $course->curriculum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curriculum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="single-curriculum-item">
                    <div id="accordion_<?php echo e($curriculum->id); ?>">
                        <div class="card">
                            <div class="card-header" >
                                <div data-toggle="collapse" data-target="#collapseOne_<?php echo e($curriculum->id); ?>" aria-expanded="<?php echo e(($preview_lesson->curriculum_id == $curriculum->id) ? 'true' : 'false'); ?>" aria-controls="collapseOne">
                                    <h3 class="title"><?php echo e(optional($curriculum->lang_front)->title); ?></h3>
                                    <?php if(optional($curriculum->lang_front)->description ): ?>
                                        <p class="description"><?php echo optional($curriculum->lang_front)->description; ?></p>
                                    <?php endif; ?>
                                </div>
                                <span class="lesson-count"><?php echo e(optional($curriculum->lesson)->count()); ?> <?php echo e(__('Lessons')); ?></span>
                            </div>
                            <div id="collapseOne_<?php echo e($curriculum->id); ?>" class="collapse <?php if($preview_lesson->curriculum_id == $curriculum->id): ?> show  <?php endif; ?>"  data-parent="#accordion_<?php echo e($curriculum->id); ?>">
                                <div class="card-body">
                                    <ul class="lesson-list">
                                        <?php $__currentLoopData = $curriculum->lesson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php if($lesson->id == $preview_lesson->id): ?> active <?php endif; ?>">
                                                <a href="<?php echo e(route('frontend.course.lesson',['course_id' => $course->id,'id' => $lesson->id])); ?>">
                                                    <div class="lession-title"><i class="fas fa-file-alt"></i> <?php echo e(optional($lesson->lang_front)->title ?? __('Untitled')); ?></div>
                                                    <div class="right">
                                                        <span class="duration"> <?php echo e($lesson->duration); ?> <?php echo e($lesson->duration_type ?? ''); ?></span>
                                                        <?php if(auth()->guard('web')->check() && $allowed_to_access_content): ?>
                                                            <i class="fas fa-eye"></i>
                                                        <?php elseif(!empty($lesson->preview) && $lesson->preview === 'yes'): ?>
                                                            <i class="fas fa-eye"></i>
                                                        <?php elseif(!empty($lesson->preview) && $lesson->preview === 'no'): ?>
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
    <div class="content-lesson-outer-wrap">
        <div class="content-lesson-wrap">
            <?php if($allowed_to_access_content || optional($preview_lesson)->preview === 'yes' ): ?>
                <?php if(optional($preview_lesson)->video_embed_code): ?>
                <div class="video-embed-code-wrap">
                    <?php echo optional($preview_lesson)->video_embed_code; ?>

                </div>
                <?php endif; ?>
                <div class="description">
                    <?php echo optional(optional($preview_lesson)->lang_front)->description ?? ''; ?>

                    <div class="attachment-file margin-top-40">
                        <?php if(file_exists('assets/uploads/course-lesson/'.optional($preview_lesson)->file)): ?>
                            <a href="<?php echo e(asset('assets/uploads/course-lesson/'.optional($preview_lesson)->file)); ?>" download=""><?php echo e(optional($preview_lesson)->file); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning"><?php echo sprintf(__('This content is protected, please %s and enroll course to view this content!'),'<a href="'.route('user.login').'">'.__('Login').'</a>'); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function ($){
            "use strict";

            $(document).on('click','#expand_lesson',function (e){
                e.preventDefault();
                $(this).toggleClass('active')
                $('.course-content-wrapper-for-lesson .lesson-wrap').toggleClass('hide');
                $('.course-content-wrapper-for-lesson .content-lesson-wrap').toggleClass('expand');
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/courses/course-lesson.blade.php ENDPATH**/ ?>