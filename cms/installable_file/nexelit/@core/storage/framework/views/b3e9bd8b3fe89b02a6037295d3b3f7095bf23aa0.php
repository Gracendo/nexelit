<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Services Area')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Services Area Settings')); ?></h4>

                        <form action="<?php echo e(route('admin.home21.services')); ?>" method="post" enctype="multipart/form-data">
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
                                            <label for="home_21_service_section_<?php echo e($lang); ?>_subtitle"><?php echo e(__('Sub Title')); ?></label>
                                            <input type="text" name="home_21_service_section_<?php echo e($lang->slug); ?>_subtitle" value="<?php echo e(get_static_option('home_21_service_section_'.$lang->slug.'_subtitle')); ?>" class="form-control" >

                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_<?php echo e($lang); ?>_title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" name="home_21_service_section_<?php echo e($lang->slug); ?>_title" value="<?php echo e(get_static_option('home_21_service_section_'.$lang->slug.'_title')); ?>" class="form-control" >
                                            <small class="info-text"><?php echo e(__('use {shape}text{/shape} to show shape in the title')); ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_<?php echo e($lang->slug); ?>_description"><?php echo e(__('Description')); ?></label>
                                            <textarea name="home_21_service_section_<?php echo e($lang->slug); ?>_description" class="form-control" cols="30" rows="10"><?php echo e(get_static_option('home_21_service_section_'.$lang->slug.'_description')); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_<?php echo e($lang); ?>_button_one_text"><?php echo e(__('Button One Text')); ?></label>
                                            <input type="text" name="home_21_service_section_<?php echo e($lang->slug); ?>_button_one_text" value="<?php echo e(get_static_option('home_21_service_section_'.$lang->slug.'_button_one_text')); ?>" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_<?php echo e($lang); ?>_item_explore_one_text"><?php echo e(__('Explore Text')); ?></label>
                                            <input type="text" name="home_21_service_section_<?php echo e($lang->slug); ?>_item_explore_one_text" value="<?php echo e(get_static_option('home_21_service_section_'.$lang->slug.'_item_explore_one_text')); ?>" class="form-control" >
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="home_21_service_section_button_one_url"><?php echo e(__('Button One URL')); ?></label>
                                <input type="text" name="home_21_service_section_button_one_url" value="<?php echo e(get_static_option('home_21_service_section_button_one_url')); ?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_service_area_items"><?php echo e(__('Items')); ?></label>
                                <input type="text" name="home_page_01_service_area_items" value="<?php echo e(get_static_option('home_page_01_service_area_items')); ?>" class="form-control" >
                                <small class="info-text"><?php echo e(__('enter how much service you want to show')); ?></small>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['title' => ''.e(__('Left Shape Image')).'','name' => 'home21_services_section_left_shape_image','id' => ''.e(get_static_option('home21_services_section_left_shape_image')).'','dimentions' => '770x1050']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Left Shape Image')).'','name' => 'home21_services_section_left_shape_image','id' => ''.e(get_static_option('home21_services_section_left_shape_image')).'','dimentions' => '770x1050']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['title' => ''.e(__('Right Shape Image')).'','name' => 'home21_services_section_right_shape_image','id' => ''.e(get_static_option('home21_services_section_right_shape_image')).'','dimentions' => '770x1050']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Right Shape Image')).'','name' => 'home21_services_section_right_shape_image','id' => ''.e(get_static_option('home21_services_section_right_shape_image')).'','dimentions' => '770x1050']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/home/creative-agency-two/services-area.blade.php ENDPATH**/ ?>