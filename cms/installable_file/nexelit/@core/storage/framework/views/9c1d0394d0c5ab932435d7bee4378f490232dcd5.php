<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('instructor:')); ?> <?php echo e($instructor->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('instructor:')); ?> <?php echo e($instructor->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="instructor-info-wrapper">
                        <div class="img-wrap">
                            <?php echo render_image_markup_by_attachment_id($instructor->image); ?>

                        </div>
                        <div class="content">
                            <h3 class="title"><?php echo e($instructor->name); ?></h3>
                            <span class="designation"><?php echo e($instructor->designation); ?></span>
                            <ul class="social-wrap">
                                <?php $__currentLoopData = $instructor->social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($instructor->social_icon_url[$loop->index] ?? '#'); ?>"><i class="<?php echo e($icon); ?>"></i></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="instructor-content-wrapper content-tab-wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#about_me_tab" role="tab"  aria-selected="true"><?php echo e(__('About Me')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#courses_tab" role="tab" aria-selected="false"><?php echo e(__('Courses')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  data-toggle="tab" href="#reviews-tab" role="tab"  aria-selected="false"><?php echo e(__('Reviews')); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about_me_tab" role="tabpanel">
                                <div class="tab-inner-area">
                                    <?php echo $instructor->lang_front->description; ?>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="courses_tab" role="tabpanel" >
                                <div class="my-courses-wrap">
                                    <div class="row">
                                        <?php $a=1; ?>
                                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="col-lg-6">
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.course.grid','data' => ['course' => $data,'increment' => $a]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.course.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['course' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'increment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($a)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                            <?php if($a == 4){ $a=1;}else{$a++;} ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-lg-12 text-center">
                                            <div class="alert alert-warning"><?php echo e(__('nothing found')); ?> </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12 text-center">
                                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                                            <?php echo e($courses->links()); ?>

                                        </nav>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab" role="tabpanel" >
                                <div class="instructor-review-wrapper feedback-comment-list-wrap">
                                    <ul class="feedback-list">
                                        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li class="single-feedback-item">
                                                <div class="content">
                                                    <h4 class="title"><?php echo e($data->user ? optional($data->user)->username : __("Anonymous")); ?></h4>
                                                    <div class="rating-wrap single">
                                                        <?php for( $i =1; $i <= $data->ratings; $i++ ): ?>
                                                            <i class="fas fa-star"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <div class="description"><?php echo e($data->message); ?></div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li class="alert alert-warning"><?php echo e(__('No Reviews Found')); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php echo e($reviews->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/courses/course-instructor.blade.php ENDPATH**/ ?>