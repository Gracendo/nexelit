<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Job Single Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Job Single Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.jobs.single.page.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_context_label"><?php echo e(__('Job Context Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_context_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_context_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_context_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_responsibility_label"><?php echo e(__('Job Responsibility Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_responsibility_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_responsibility_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_responsibility_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_education_requirement_label"><?php echo e(__('Education Requirement Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_education_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_education_requirement_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_education_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_experience_requirement_label"><?php echo e(__('Experience Requirement Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_experience_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_experience_requirement_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_experience_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_additional_requirement_label"><?php echo e(__('Additional Requirement Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_additional_requirement_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_additional_requirement_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_additional_requirement_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_others_benefits_label"><?php echo e(__('Others Benefits Label')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_others_benefits_label"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_others_benefits_label')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_others_benefits_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_apply_button_text"><?php echo e(__('Job Apply Button Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_apply_button_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_apply_button_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_apply_button_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_info_text"><?php echo e(__('Job Information Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_info_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_info_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_info_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_company_name_text"><?php echo e(__('Company Name Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_company_name_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_company_name_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_company_name_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_category_text"><?php echo e(__('Job Category Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_category_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_category_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_category_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_position_text"><?php echo e(__('Job Position Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_position_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_position_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_position_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_type_text"><?php echo e(__('Job Type Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_type_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_type_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_type_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_salary_text"><?php echo e(__('Salary Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_salary_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_salary_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_salary_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_location_text"><?php echo e(__('Job Location Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_location_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_location_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_location_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_deadline_text"><?php echo e(__('Deadline Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_deadline_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_deadline_text')); ?>" id="job_single_page_<?php echo e($lang->slug); ?>_job_deadline_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="job_single_page_<?php echo e($lang->slug); ?>_job_application_fee_text"><?php echo e(__('Application Fee Text')); ?></label>
                                            <input type="text" name="job_single_page_<?php echo e($lang->slug); ?>_job_application_fee_text"  class="form-control" value="<?php echo e(get_static_option('job_single_page_'.$lang->slug.'_job_application_fee_text')); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_applicant_mail"><?php echo e(__('Job Application Receiving Mail')); ?></label>
                                <input type="text" name="job_single_page_applicant_mail"  class="form-control" value="<?php echo e(get_static_option('job_single_page_applicant_mail')); ?>" id="job_single_page_applicant_mail">
                            </div>
                            <div class="form-group">
                                <label for="job_single_page_apply_form"><strong><?php echo e(__('Apply Page Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="job_single_page_apply_form"  <?php if(!empty(get_static_option('job_single_page_apply_form'))): ?> checked <?php endif; ?> id="job_single_page_apply_form">
                                    <span class="slider"></span>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/jobs/job-single-page-settings.blade.php ENDPATH**/ ?>