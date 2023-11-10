<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Course')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between margin-bottom-30">
                            <h4 class="header-title"><?php echo e(__('Add New Course')); ?></h4>
                            <a href="<?php echo e(route('admin.courses.all')); ?>" class="btn btn-info"><?php echo e(__('All Courses')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.courses.new')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $default_lang = get_default_language(); ?>
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($lang->slug == $default_lang): ?> active <?php endif; ?>" data-lang="<?php echo e($lang->slug); ?>" data-toggle="tab" href="#slider_tab_<?php echo e($lang->slug); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-40" >
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($lang->slug == $default_lang): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($lang->slug); ?>" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" class="form-control title-field" name="title[<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug"><?php echo e(__('Slug')); ?></label>
                                            <input type="text" class="form-control slug-field" name="slug[<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Slug')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Description')); ?></label>
                                            <input type="hidden" name="description[<?php echo e($lang->slug); ?>]" >
                                            <div class="summernote"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title"><?php echo e(__('Meta title')); ?></label>
                                            <input type="text" class="form-control" name="meta_title[<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Meta title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                            <textarea  class="form-control max-height-120" name="meta_description[<?php echo e($lang->slug); ?>]"cols="30" rows="10" placeholder="<?php echo e(__('Meta Description')); ?>"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                            <input type="text" name="meta_tags[<?php echo e($lang->slug); ?>]"  class="form-control" data-role="tagsinput" >
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_title"><?php echo e(__('Og Meta title')); ?></label>
                                            <input type="text" class="form-control" name="og_meta_title[<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Og Meta title')); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="max_student"><?php echo e(__('Maximum Student')); ?></label>
                                <input type="number" class="form-control" name="max_student" >
                            </div>
                            <div class="form-group">
                                <label for="price"><?php echo e(__('Price')); ?></label>
                                <input type="number" class="form-control" name="price" >
                                <span class="info-text"><?php echo e(__('enter 0 to make it free')); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="sale_price"><?php echo e(__('Sale Price')); ?></label>
                                <input type="number" class="form-control" name="sale_price" >
                            </div>
                            <div class="form-group">
                                <label for="external_url"><?php echo e(__('External URL')); ?></label>
                                <input type="text" class="form-control" name="external_url" >
                                <span class="info-text"><?php echo e(__('it will goes to your enter url when anyone click into enroll button')); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="duration"><?php echo e(__('Duration')); ?></label>
                                <input type="text" class="form-control" name="duration" >
                            </div>
                            <div class="form-group">
                                <label for="duration_type"><?php echo e(__('Duration Type')); ?></label>
                                <select name="duration_type" class="form-control">
                                    <option value="min"><?php echo e(__('Minute')); ?></option>
                                    <option value="hr"><?php echo e(__('Hours')); ?></option>
                                    <option value="days"><?php echo e(__('Days')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured"><strong><?php echo e(__('Featured')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="featured" >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="enroll_required"><strong><?php echo e(__('Enroll Required')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enroll_required" >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['name' => 'image','title' => __('Image'),'id' => null,'dimentions' => '1920x1080px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Image')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1920x1080px')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['name' => 'og_meta_image','title' => __('Og Meta Image'),'id' => null,'dimentions' => '1920x1080px']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('og_meta_image'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Og Meta Image')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1920x1080px')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                            <div class="form-group">
                                <label for="categories_id"><?php echo e(__('Category')); ?></label>
                                <select name="categories_id" class="form-control nice-select wide">
                                    <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->lang->title ?? __('untitled')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instructor_id"><?php echo e(__('Instructor')); ?></label>
                                <select name="instructor_id" class="form-control nice-select wide">
                                    <?php $__currentLoopData = $all_instructor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($inst->id); ?>"><?php echo e($inst->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control">
                                    <option value="draft"><?php echo e(__('Draft')); ?></option>
                                    <option value="publish"><?php echo e(__('Publish')); ?></option>
                                </select>
                            </div>
                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                <label for="additional_info" class="d-block"><?php echo e(__('Curriculum')); ?> <span class="d-none"><i class="fas fa-spinner fa-spin"></i></span></label>
                               <div class="curriculmn-outer-wrap">
                                   <div class="curriculmn-repeater-wrap">
                                       <div class="action-wrap">
                                           <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                       <ul class="nav nav-tabs" role="tablist">
                                           <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <li class="nav-item">
                                                   <a class="nav-link <?php if($lang->slug == $default_lang): ?> active <?php endif; ?>"  data-toggle="tab" href="#repeater_tab_<?php echo e($lang->slug); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                               </li>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </ul>
                                       <div class="tab-content" >
                                           <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <div class="tab-pane fade <?php if($lang->slug == $default_lang): ?> show active <?php endif; ?>" id="repeater_tab_<?php echo e($lang->slug); ?>" role="tabpanel" >
                                                   <div class="form-group">
                                                       <input type="text" class="form-control" name="curriculum_title[1][<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Curriculum title')); ?>">
                                                   </div>
                                                   <div class="form-group">
                                                       <textarea  class="form-control max-height-120" name="curriculum_description[1][<?php echo e($lang->slug); ?>]"cols="30" rows="10" placeholder="<?php echo e(__('Curriculum description')); ?>"></textarea>
                                                   </div>
                                               </div>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </div>
                                   </div>
                                   <div class="all-field-wrap lesson">
                                       <div class="form-group">
                                           <input type="text" class="form-control" name="course_lesson[1][]"  placeholder="<?php echo e(__('create new lesson')); ?>">
                                       </div>
                                       <div class="action-wrap">
                                           <span class="edit d-none"><a href="#"><i class="ti-pencil"></i></a></span>
                                           <span class="add"><i class="ti-plus"></i></span>
                                           <span class="remove"><i class="ti-trash"></i></span>
                                       </div>
                                   </div>
                               </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('backend.partials.repeater.course-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.partials.icon-field.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.auto-slug-multilangual','data' => ['url' => route('admin.courses.slug.check'),'type' => 'new']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.auto-slug-multilangual'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.courses.slug.check')),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('new')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script>
        (function (){
            "use strict";

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }

            $(document).ready(function () {

                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
                $(document).on('click','.curriculmn-repeater-wrap .action-wrap .remove',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-outer-wrap');

                    if (container.length > 1){
                        el.show(300);
                        parent.parent().hide(300).remove();
                    }else{
                        el.hide(300);
                    }
                });

                $(document).on('click','.curriculmn-repeater-wrap .action-wrap .add',function (e){
                    e.preventDefault();
                    var el = $(this);
                    var parent = el.parent().parent();
                    var container = $('.curriculmn-repeater-wrap');
                    var clonedDiv = $(this).parent().parent().parent().clone();
                    var containerLength = container.length;
                    var allFields = clonedDiv.find('.form-control');
                    allFields.val('');
                    allFields.each(function (item,index){
                        var name = $(this).attr('name');
                        var number = name.replace(/\d+/g,containerLength + 1);
                        $(this).attr('name',number);
                    });
                    clonedDiv.find('.curriculmn-repeater-wrap > .action-wrap .remove').css({'display':'inline-block'});
                    clonedDiv.find('.all-field-wrap.lesson').not(':first').remove();

                    var allTab =  clonedDiv.find('.tab-pane');
                    allTab.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('id');
                        el.attr('id',oldId+containerLength);
                    });
                    var allTabNav =  clonedDiv.find('.nav-link');
                    allTabNav.each(function (index,value){
                        var el = $(this);
                        var oldId = el.attr('href');
                        el.attr('href',oldId+containerLength);
                    });
                    container.parent().parent().append(clonedDiv);
                    if (container.length > 0){
                        parent.parent().find('.remove').show(300);
                    }
                });

            });
        })(jQuery);
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/courses/course-new.blade.php ENDPATH**/ ?>