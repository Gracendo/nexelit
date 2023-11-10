<?php $__env->startSection('site-title'); ?>
    <?php echo e($job->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($job->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($job->meta_description); ?>">
    <meta name="tags" content="<?php echo e($job->meta_tags); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url"  content="<?php echo e(route('frontend.jobs.single',$job->slug)); ?>" />
    <meta property="og:type"  content="job" />
    <meta property="og:title"  content="<?php echo e($job->title); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-job-details">
                        <ul class="job-meta-list">
                            <?php if(!empty($job->job_context)): ?>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> <?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_context_label')); ?></h4>
                                    <p><?php echo $job->job_context; ?></p>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($job->job_responsibility)): ?>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_responsibility_label')); ?></h4>
                                    <p><?php echo $job->job_responsibility; ?></p>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($job->education_requirement)): ?>
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">  <?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_education_requirement_label')); ?></h4>
                                        <p><?php echo $job->education_requirement; ?></p>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($job->experience_requirement)): ?>
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> <?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_experience_requirement_label')); ?></h4>
                                        <p><?php echo $job->experience_requirement; ?></p>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($job->additional_requirement)): ?>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> <?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_additional_requirement_label')); ?></h4>
                                    <p><?php echo $job->additional_requirement; ?></p>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($job->other_benefits)): ?>
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_others_benefits_label')); ?></h4>
                                        <p><?php echo $job->other_benefits; ?></p>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($job->application_fee_status) && $job->application_fee > 0): ?>
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_application_fee_text')); ?></h4>
                                        <p><?php echo e(amount_with_currency_symbol($job->application_fee )); ?></p>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="apply-procedure">
                             <?php if(time() >= strtotime($job->deadline)): ?>
                                <div class="alert alert-danger margin-top-30"><?php echo e(__('Dead Line Expired')); ?></div>
                            <?php else: ?>
                                <?php if(!empty(get_static_option('job_single_page_apply_form'))): ?>
                                    <a class="btn-boxed style-01 margin-top-30" href="<?php echo e(route('frontend.jobs.apply',$job->id)); ?>"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_apply_button_text')); ?></a>
                                <?php else: ?>
                                    <p><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_apply_button_text')); ?>: <span><?php echo e($job->email); ?></span></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                            <div class="widget job_information">
                                <h2 class="widget-title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_info_text')); ?></h2>
                                <ul class="job-information-list">
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_company_name_text')); ?></h4>
                                                <span class="details"><?php echo e($job->company_name); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_category_text')); ?></h4>
                                                <span class="details"><?php echo get_jobs_category_by_id($job->category_id,'link'); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_position_text')); ?></h4>
                                                <span class="details"><?php echo e($job->position); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-folder"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_type_text')); ?></h4>
                                                <span class="details"><?php echo e(str_replace('_',' ',$job->employment_status)); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_salary_text')); ?></h4>
                                                <span class="details"><?php echo e($job->salary); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_location_text')); ?></h4>
                                                <span class="details"><?php echo e($job->job_location); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-job-info">
                                            <div class="icon">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php echo e(get_static_option('job_single_page_'.$user_select_lang_slug.'_job_deadline_text')); ?></h4>
                                                <span class="details"><?php echo e(date('d M Y',strtotime($job->deadline))); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <div class="widget-area">
                            <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('career',['column' => false]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/jobs/jobs-single.blade.php ENDPATH**/ ?>