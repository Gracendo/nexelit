<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Section Manage')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Section Manage')); ?></h4>
                        <form action="<?php echo e(route('admin.homeone.section.manage')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_key_feature_section_status"><strong><?php echo e(__('Key Feature Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_key_feature_section_status"  <?php if(!empty(get_static_option('home_page_key_feature_section_status'))): ?> checked <?php endif; ?> id="home_page_key_feature_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_about_us_section_status"><strong><?php echo e(__('About Us Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_about_us_section_status"  <?php if(!empty(get_static_option('home_page_about_us_section_status'))): ?> checked <?php endif; ?> id="home_page_about_us_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_service_section_status"><strong><?php echo e(__('Service Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_service_section_status"  <?php if(!empty(get_static_option('home_page_service_section_status'))): ?> checked <?php endif; ?> id="home_page_service_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_counterup_section_status"><strong><?php echo e(__('Counterup Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_counterup_section_status"  <?php if(!empty(get_static_option('home_page_counterup_section_status'))): ?> checked <?php endif; ?> id="home_page_counterup_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_case_study_section_status"><strong><?php echo e(__('Case Study Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_case_study_section_status"  <?php if(!empty(get_static_option('home_page_case_study_section_status'))): ?> checked <?php endif; ?> id="home_page_case_study_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_testimonial_section_status"><strong><?php echo e(__('Testimonial Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_testimonial_section_status"  <?php if(!empty(get_static_option('home_page_testimonial_section_status'))): ?> checked <?php endif; ?> id="home_page_testimonial_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_latest_news_section_status"><strong><?php echo e(__('Latest News Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_latest_news_section_status"  <?php if(!empty(get_static_option('home_page_latest_news_section_status'))): ?> checked <?php endif; ?> id="home_page_latest_news_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_brand_logo_section_status"><strong><?php echo e(__('Brand Logo Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_brand_logo_section_status"  <?php if(!empty(get_static_option('home_page_brand_logo_section_status'))): ?> checked <?php endif; ?> id="home_page_brand_logo_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_support_bar_section_status"><strong><?php echo e(__('Support Bar Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_support_bar_section_status"  <?php if(!empty(get_static_option('home_page_support_bar_section_status'))): ?> checked <?php endif; ?> id="home_page_support_bar_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="home_page_price_plan_section_status"><strong><?php echo e(__('Price Plan Section Show/Hide')); ?></strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="home_page_price_plan_section_status"  <?php if(!empty(get_static_option('home_page_price_plan_section_status'))): ?> checked <?php endif; ?> id="home_page_price_plan_section_status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="home_page_team_member_section_status"><strong><?php echo e(__('Team Member Section Show/Hide')); ?></strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="home_page_team_member_section_status"  <?php if(!empty(get_static_option('home_page_team_member_section_status'))): ?> checked <?php endif; ?> id="home_page_team_member_section_status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_call_to_action_section_status"><strong><?php echo e(__('Call To Action Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_call_to_action_section_status"  <?php if(!empty(get_static_option('home_page_call_to_action_section_status'))): ?> checked <?php endif; ?> id="home_page_call_to_action_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_quality_section_status"><strong><?php echo e(__('Quality Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_quality_section_status"  <?php if(!empty(get_static_option('home_page_quality_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_contact_section_status"><strong><?php echo e(__('Contact Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_contact_section_status"  <?php if(!empty(get_static_option('home_page_contact_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_quote_faq_section_status"><strong><?php echo e(__('Quote & Faq Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_quote_faq_section_status"  <?php if(!empty(get_static_option('home_page_quote_faq_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_video_section_status"><strong><?php echo e(__('Video Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_video_section_status"  <?php if(!empty(get_static_option('home_page_video_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_expertice_section_status"><strong><?php echo e(__('Expertise Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_expertice_section_status"  <?php if(!empty(get_static_option('home_page_expertice_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_event_section_status"><strong><?php echo e(__('Events Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_event_section_status"  <?php if(!empty(get_static_option('home_page_event_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_appointment_section_status"><strong><?php echo e(__('Appointment Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_appointment_section_status"  <?php if(!empty(get_static_option('home_page_appointment_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_donation_cause_section_status"><strong><?php echo e(__('Donation Causes Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_donation_cause_section_status"  <?php if(!empty(get_static_option('home_page_donation_cause_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_work_process_section_status"><strong><?php echo e(__('Work Process Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_work_process_section_status"  <?php if(!empty(get_static_option('home_page_work_process_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_offer_section_status"><strong><?php echo e(__('Offer Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_offer_section_status"  <?php if(!empty(get_static_option('home_page_offer_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_featured_fruit_section_status"><strong><?php echo e(__('Featured Fruit Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_featured_fruit_section_status"  <?php if(!empty(get_static_option('home_page_featured_fruit_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_process_section_status"><strong><?php echo e(__('Process Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_process_section_status"  <?php if(!empty(get_static_option('home_page_process_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_online_store_section_status"><strong><?php echo e(__('Online Store Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_online_store_section_status"  <?php if(!empty(get_static_option('home_page_online_store_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_top_selling_section_status"><strong><?php echo e(__('Top Selling Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_top_selling_section_status"  <?php if(!empty(get_static_option('home_page_top_selling_section_status'))): ?> checked <?php endif; ?> >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <?php if($home_page_variant == '17'): ?>
                                <div class="col-lg-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.switcher','data' => ['title' => __('All Courses Section Show/Hide'),'name' => 'home_page_all_courses_section_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('All Courses Section Show/Hide')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_all_courses_section_status')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.switcher','data' => ['title' => __('Featured Courses Section Show/Hide'),'name' => 'home_page_featured_courses_section_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Featured Courses Section Show/Hide')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_featured_courses_section_status')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.switcher','data' => ['title' => __('Our Speciality Section Show/Hide'),'name' => 'home_page_our_speciality_section_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Our Speciality Section Show/Hide')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_our_speciality_section_status')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.switcher','data' => ['title' => __('Our Speciality Section Show/Hide'),'name' => 'home_page_course_category_section_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Our Speciality Section Show/Hide')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_course_category_section_status')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <?php if($home_page_variant == '18'): ?>
                                    <div class="col-lg-4">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.switcher','data' => ['title' => __('Product Categories Section Show/Hide'),'name' => 'home_page_product_category_section_status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Product Categories Section Show/Hide')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_product_category_section_status')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/section-manage.blade.php ENDPATH**/ ?>