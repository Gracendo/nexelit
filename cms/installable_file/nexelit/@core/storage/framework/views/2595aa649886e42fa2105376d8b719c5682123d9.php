<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Page Name & Slug Settings")); ?></h4>
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
                        <form action="<?php echo e(route('admin.general.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                        $pages_list = ['video_gallery','about','service','work','team','faq','price_plan','blog','contact','career_with_us','events','knowledgebase','donation','product','testimonial','feedback','clients_feedback','image_gallery','donor','appointment','quote','courses','support_ticket'];
                                    ?>
                                    <?php $__currentLoopData = $pages_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="from-group">
                                            <label for="<?php echo e($page); ?>_page_slug"><?php echo e(__(ucfirst(str_replace('_',' ',$page)))); ?> <?php echo e(__('Page Slug')); ?></label>
                                            <input type="text" class="form-control" value="<?php echo e(get_static_option($page.'_page_slug',\Illuminate\Support\Str::slug($page))); ?>" name="<?php echo e($page); ?>_page_slug" placeholder="<?php echo e(__('Slug')); ?>" >
                                            <small><?php echo e(__('slug example:')); ?> <?php echo e($page); ?></small>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="col-lg-6">
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
                                                <div class="accordion-wrapper">
                                                    <div id="accordion-<?php echo e($lang->slug); ?>">
                                                        <?php $__currentLoopData = $pages_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="card">
                                                            <div class="card-header" id="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#<?php echo e($page); ?>_page_content_<?php echo e($lang->slug); ?>" aria-expanded="true" >
                                                                        <span class="page-title"><?php if(!empty(get_static_option($page.'_page_'.$lang->slug.'_name'))): ?> <?php echo e(get_static_option($page.'_page_'.$lang->slug.'_name')); ?> <?php else: ?> <?php echo e(__(ucfirst(str_replace('_',' ',$page)))); ?>  <?php endif; ?></span>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="<?php echo e($page); ?>_page_content_<?php echo e($lang->slug); ?>" class="collapse"  data-parent="#accordion-<?php echo e($lang->slug); ?>">
                                                                <div class="card-body">
                                                                    <div class="from-group">
                                                                        <label for="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>_name"><?php echo e(__('Name')); ?></label>
                                                                        <input type="text" class="form-control" name="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>_name" value="<?php echo e(get_static_option($page.'_page_'.$lang->slug.'_name')); ?>"  placeholder="<?php echo e(__('Name')); ?>" >
                                                                    </div>
                                                                    <div class="form-group margin-top-20">
                                                                        <label for="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>_meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                                                        <input type="text" name="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>_meta_tags"  class="form-control" data-role="tagsinput" value="<?php echo e(get_static_option($page.'_page_'.$lang->slug.'_meta_tags')); ?>" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="about_page_<?php echo e($lang->slug); ?>_meta_description"><?php echo e(__('Meta Description')); ?></label>
                                                                        <textarea name="<?php echo e($page); ?>_page_<?php echo e($lang->slug); ?>_meta_description"  class="form-control" rows="5" ><?php echo e(get_static_option($page.'_page_'.$lang->slug.'_meta_description')); ?></textarea>
                                                                    </div>
                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['title' => __('Og Meta Image'),'name' => $page.'_page_'.$lang->slug.'_meta_image','dimentions' => '1200x1200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Og Meta Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page.'_page_'.$lang->slug.'_meta_image'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1200x1200')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script>
        (function (){
            "use strict";

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.update'); ?>
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
            $(document).ready(function (e) {
                $('.page-name').bind('change paste keyup',function (e) {
                    $(this).parent().parent().parent().prev().find('.page-title').text($(this).val());
                })
            })

        })(jQuery);
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/page-settings.blade.php ENDPATH**/ ?>