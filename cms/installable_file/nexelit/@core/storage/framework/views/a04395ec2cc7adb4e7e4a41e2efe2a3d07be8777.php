<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Lesson')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
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
                            <h4 class="header-title"><?php echo e(__('Edit Lesson')); ?></h4>
                            <a href="<?php echo e(route('admin.courses.lesson.all')); ?>" class="btn btn-info"><?php echo e(__('All Lesson')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.courses.lesson.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="id" value="<?php echo e($lesson->id); ?>">
                            <input type="hidden" name="curriculum_id" value="<?php echo e($lesson->curriculum_id); ?>">
                            <input type="hidden" name="course_id" value="<?php echo e($lesson->course_id); ?>">
                            <?php $default_lang = get_default_language();  ?>
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($lang->slug == $default_lang): ?> active <?php endif; ?>"  data-toggle="tab" href="#slider_tab_<?php echo e($lang->slug); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-40" >
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $lessonLang =  $lesson->lang_query->where(['lang' => $lang->slug,'lession_id' => $lesson->id])->first();?>
                                    <div class="tab-pane fade <?php if($lang->slug == $default_lang): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($lang->slug); ?>" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" class="form-control" name="title[<?php echo e($lang->slug); ?>]" placeholder="<?php echo e(__('Title')); ?>" value="<?php echo e($lessonLang->title ?? ''); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Description')); ?></label>
                                            <input type="hidden" name="description[<?php echo e($lang->slug); ?>]" value="<?php echo e($lessonLang->description ?? ''); ?>">
                                            <div class="summernote" data-content='<?php echo e($lessonLang->description ?? ''); ?>'></div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="video_embed_code"><?php echo e(__('Video Embed Code')); ?></label>
                                <textarea name="video_embed_code" class="form-control" cols="30" rows="10"><?php echo e($lesson->video_embed_code); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="duration"><?php echo e(__('Duration')); ?></label>
                                <input type="text" class="form-control" name="duration" value="<?php echo e($lesson->duration); ?>">
                            </div>
                            <div class="form-group">
                                <label for="duration_type"><?php echo e(__('Duration Type')); ?></label>
                                <select name="duration_type" class="form-control">
                                    <option <?php if($lesson->duration_type === 'min'): ?> selected <?php endif; ?> value="min"><?php echo e(__('Minute')); ?></option>
                                    <option <?php if($lesson->duration_type === 'hr'): ?> selected <?php endif; ?> value="hr"><?php echo e(__('Hours')); ?></option>
                                    <option <?php if($lesson->duration_type === 'days'): ?> selected <?php endif; ?> value="days"><?php echo e(__('Days')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control">
                                    <option <?php if($lesson->status === 'draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?></option>
                                    <option <?php if($lesson->status === 'publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="preview"><strong><?php echo e(__('Preview')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="preview" <?php if($lesson->preview === 'yes'): ?> checked <?php endif; ?>>
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="duration"><?php echo e(__('File')); ?></label>
                                <input type="file" class="form-control" name="file" >
                                <small class="info-text"><?php echo e(__('jpg,jpeg,png,pdf,doc,docx,txt,zip file are allowed, maximum 20mb')); ?></small>
                            </div>
                            <div class="old-file-wrapper">
                                <?php if(file_exists('assets/uploads/course-lesson/'.$lesson->file)): ?>
                                    <a href="<?php echo e(asset('assets/uploads/course-lesson/'.$lesson->file)); ?>" download=""><?php echo e($lesson->file); ?></a>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Save Changes')); ?></button>
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
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function ($){
            "use strict";

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

            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/courses/lesson/lesson-edit.blade.php ENDPATH**/ ?>