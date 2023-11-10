<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('courses_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="appointment-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-search-wrapper">
                        <div class="right-part">
                            <select name="category" class="form-control">
                                <option value=""><?php echo e(__("select category")); ?></option>
                                <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($category->id == $cat_id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e(optional($category->lang_front)->title); ?> (<?php echo e(optional($category->course)->count()); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <select name="sorting" class="form-control">
                                <option <?php if($sort === 'latest'): ?> selected <?php endif; ?> value="latest"><?php echo e(__("Latest")); ?></option>
                                <option <?php if($sort === 'oldest'): ?> selected <?php endif; ?> value="oldest"><?php echo e(__("Oldest")); ?></option>
                                <option <?php if($sort === 'top_rated'): ?> selected <?php endif; ?> value="top_rated"><?php echo e(__("Best Rated")); ?></option>
                                <option <?php if($sort === 'low_price'): ?> selected <?php endif; ?> value="low_price"><?php echo e(__("Low Price")); ?></option>
                                <option <?php if($sort === 'high_price'): ?> selected <?php endif; ?> value="high_price"><?php echo e(__("High Price")); ?></option>
                            </select>
                        </div>
                        <div class="left-part">
                            <div class="search-wrapper">
                                <form method="get">
                                    <input type="hidden" name="cat" value="<?php echo e($cat_id); ?>">
                                    <input type="hidden" name="sort" value="<?php echo e($sort); ?>">
                                    <div class="form-group search-box">
                                        <input type="text" class="form-control" name="s" placeholder="<?php echo e(__('Search')); ?>" value="<?php echo e($search_term); ?>">
                                        <button class="submit-btn"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $a=1; ?>
                <?php $__empty_1 = true; $__currentLoopData = $all_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 col-md-6">
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
                        <div class="alert alert-warning"><?php echo e(__('nothing found')); ?> <strong><?php echo e($search_term); ?></strong></div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-12 text-center">
                    <nav class="pagination-wrapper " aria-label="Page navigation ">
                        <?php echo e($all_courses->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function($) {
            'use strict';
            $(document).on('change','select[name="sorting"]',function (e){
                e.preventDefault();
                $('input[name="sort"]').val($(this).val());
            })
            $(document).on('change','select[name="category"]',function (e){
                e.preventDefault();
                $('input[name="cat"]').val($(this).val());
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/courses/courses.blade.php ENDPATH**/ ?>