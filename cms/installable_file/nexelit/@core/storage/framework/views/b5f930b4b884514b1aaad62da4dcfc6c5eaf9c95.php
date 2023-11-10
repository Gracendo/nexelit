<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Popup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('Edit Popup')); ?></h4>
                            <a href="<?php echo e(route('admin.popup.builder.all')); ?>" class="btn btn-primary"><?php echo e(__('All Popup')); ?></a>
                        </div>


                        <form action="<?php echo e(route('admin.popup.builder.update',$popup->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong><?php echo e(__('Language')); ?></strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option  <?php if($popup->lang == $lang->slug ): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('Name ( It will not show in frontend )')); ?></label>
                                        <input type="text" class="form-control"  id="name" name="name" value="<?php echo e($popup->name); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control"  id="title" name="title" value="<?php echo e($popup->title); ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="type"><strong><?php echo e(__('Type')); ?></strong></label>
                                        <select name="type" id="popup_type" class="form-control">
                                            <option <?php if($popup->type == 'notice'): ?> selected <?php endif; ?> value="notice"><?php echo e(__('Notice')); ?></option>
                                            <option <?php if($popup->type == 'only_image'): ?> selected <?php endif; ?> value="only_image"><?php echo e(__('Only Image')); ?></option>
                                            <option <?php if($popup->type == 'promotion'): ?> selected <?php endif; ?> value="promotion"><?php echo e(__('Promotion')); ?></option>
                                            <option <?php if($popup->type == 'discount'): ?> selected <?php endif; ?> value="discount"><?php echo e(__('Discount')); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><?php echo e(__('Description')); ?></label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?php echo e($popup->description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="offer_time_end"><?php echo e(__('Offer End Date')); ?></label>
                                        <input type="date" class="form-control datepicker"  id="offer_time_end" name="offer_time_end" value="<?php echo e($popup->offer_time_end); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_status"><strong><?php echo e(__('Button Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" <?php if($popup->btn_status): ?> checked <?php endif; ?> name="btn_status" id="btn_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="button_text"><?php echo e(__('Button Text')); ?></label>
                                        <input type="text" class="form-control"  id="button_text" name="button_text" value="<?php echo e($popup->button_text); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="button_link"><?php echo e(__('Button Link')); ?></label>
                                        <input type="text" class="form-control"  id="button_link" name="button_link" value="<?php echo e($popup->button_link); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="background_image"><?php echo e(__('Background Image')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $pop_bg_img = get_attachment_image_by_id($popup->background_image,'thumbnail',true);
                                                ?>
                                                <?php if(!empty($pop_bg_img)): ?>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="<?php echo e($pop_bg_img['img_url']); ?>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="background_image" value="<?php echo e($popup->background_image); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e(__('Upload Image')); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('Recommended image size 700x400')); ?></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="image"><?php echo e(__('Image')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $pop_img = get_attachment_image_by_id($popup->only_image,'thumbnail',true);
                                                ?>
                                                <?php if(!empty($pop_img)): ?>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="<?php echo e($pop_img['img_url']); ?>" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <input type="hidden" name="image" value="<?php echo e($popup->only_image); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e(__('Upload Image')); ?>

                                            </button>
                                        </div>
                                        <small><?php echo e(__('Recommended image size 350x350')); ?></small>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Popup')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            showHideFields($('#popup_type').val());
            $(document).on('change','#popup_type',function (e) {
                e.preventDefault();
                var el = $(this);
                var type = el.val();
                showHideFields(type);
            });

            function showHideFields(type) {
                console.log(type);
                if(type == 'notice'){
                    $('label[for="image"]').parent().hide();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                    $('label[for="background_image"]').parent().hide();
                    $('label[for="button_text"]').parent().hide();
                    $('label[for="button_link"]').parent().hide();
                    $('label[for="btn_status"]').parent().hide();
                    $('label[for="offer_time_end"]').parent().hide();

                }else if(type == 'only_image'){
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().hide();
                    $('label[for="button_text"]').parent().hide();
                    $('label[for="button_link"]').parent().hide();
                    $('label[for="btn_status"]').parent().hide();
                    $('label[for="offer_time_end"]').parent().hide();
                    $('label[for="description"]').parent().hide();
                    $('label[for="title"]').parent().hide();
                }else if(type == 'promotion'){
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().show();
                    $('label[for="button_text"]').parent().show();
                    $('label[for="button_link"]').parent().show();
                    $('label[for="btn_status"]').parent().show();
                    $('label[for="offer_time_end"]').parent().hide();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                }else{
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().show();
                    $('label[for="button_text"]').parent().show();
                    $('label[for="button_link"]').parent().show();
                    $('label[for="btn_status"]').parent().show();
                    $('label[for="offer_time_end"]').parent().show();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                }
            }
        });
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/popup-builder/popup-edit.blade.php ENDPATH**/ ?>