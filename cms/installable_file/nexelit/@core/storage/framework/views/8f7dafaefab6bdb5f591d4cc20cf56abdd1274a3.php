<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Advertisement')); ?>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Edit Advertisement')); ?>   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.advertisement')); ?>"><?php echo e(__('All Advertisements')); ?></a>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.advertisement.update',$add->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="tab-content margin-top-40">
                                <div class="row">

                                    <div class="form-group col-md-12" id="title">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" name="title" value="<?php echo e($add->title); ?>">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="title"><?php echo e(__('Advertisement Type')); ?></label>
                                        <select class="form-control" name="type" id="type">
                                            <option selected disabled><?php echo e(__('Select a Type')); ?></option>
                                            <option <?php if($add->type === 'image'): ?> selected <?php endif; ?> value="image"><?php echo e(__('Image')); ?></option>
                                            <option <?php if($add->type === 'google_adsense'): ?> selected  <?php endif; ?> value="google_adsense"><?php echo e(__('Google Adsense')); ?></option>
                                            <option <?php if($add->type === 'scripts'): ?> selected  <?php endif; ?> value="scripts"><?php echo e(__('Scripts')); ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="title"><?php echo e(__('Advertisement Size')); ?></label>
                                        <select class="form-control" name="size" id="size">
                                            <option selected disabled><?php echo e(__('Select a Size')); ?></option>
                                            <option <?php if($add->size === '350*250'): ?> selected <?php endif; ?> value="350*250"><?php echo e(__('350 x 250')); ?></option>
                                            <option <?php if($add->size === '320*50'): ?> selected <?php endif; ?> value="320*50"><?php echo e(__('320 x 50')); ?></option>
                                            <option <?php if($add->size === '160*600'): ?> selected <?php endif; ?> value="160*600"><?php echo e(__('160 x 600')); ?></option>
                                            <option <?php if($add->size === '300*600'): ?> selected <?php endif; ?> value="300*600"><?php echo e(__('300 x 600')); ?></option>
                                            <option <?php if($add->size === '336*280'): ?> selected <?php endif; ?> value="336*280"><?php echo e(__('336 x 280')); ?></option>
                                            <option <?php if($add->size === '728*90'): ?> selected <?php endif; ?> value="728*90"><?php echo e(__('728 x 90')); ?></option>
                                            <option <?php if($add->size === '730*180'): ?> selected <?php endif; ?> value="730*180"><?php echo e(__('730 x 180')); ?></option>
                                            <option <?php if($add->size === '730*210'): ?> selected <?php endif; ?> value="730*210"><?php echo e(__('730 x 210')); ?></option>
                                            <option <?php if($add->size === '300*1050'): ?> selected <?php endif; ?> value="300*1050"><?php echo e(__('300 X 1050')); ?></option>
                                            <option <?php if($add->size === '950*160'): ?> selected <?php endif; ?> value="950*160"><?php echo e(__('950 X 160')); ?></option>
                                            <option <?php if($add->size === '950*200'): ?> selected <?php endif; ?> value="950*200"><?php echo e(__('950 X 200')); ?></option>
                                            <option <?php if($add->size === '250*1110'): ?> selected <?php endif; ?> value="250*1110"><?php echo e(__('250 X 1110')); ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12" id="slot" style="display: none">
                                        <label for="title"><?php echo e(__('Advertisement Slot')); ?></label>
                                        <input type="text" class="form-control" name="slot" value="<?php echo e($add->slot); ?>">
                                    </div>

                                    <div class="form-group col-md-12" style="display: none" id="embed_code">
                                        <label for="title"><?php echo e(__('Embed Code')); ?></label>
                                        <textarea class="form-control" name="embed_code"><?php echo e($add->embed_code); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-12" style="display: none" id="redirect_url">
                                        <label for="title"><?php echo e(__('Redirect URL')); ?></label>
                                        <input type="text" class="form-control" name="redirect_url" value="<?php echo e($add->redirect_url); ?>">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="title"><?php echo e(__('Status')); ?></label>
                                        <select class="form-control" name="status">
                                            <option <?php if($add->status === 0): ?> selected <?php endif; ?> value="0"><?php echo e(__('Inactive')); ?></option>
                                            <option <?php if($add->status === 1): ?> selected <?php endif; ?> value="1"><?php echo e(__('Active')); ?></option>
                                        </select>
                                    </div>

                                </div>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['title' => 'Advertisement Image','name' => 'image','id' => $add->image,'value' => $add->image,'class' => 'image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Advertisement Image'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($add->image),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($add->image),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                <button id="submit" type="submit" class="btn btn-primary mt-5 submit_btn"><?php echo e(__('Submit Advertise ')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
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
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.submit','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.submit'); ?>
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

                if($('#type').val() === 'image') {
                    $('.image').show();
                    $('#redirect_url').show();
                 }else if($('#type').val() === 'google_adsense') {
                    $('#slot').show();
                    $('.image').hide();

                }else if($('#type').val() === 'scripts'){
                    $('#embed_code').show();
                    $('.image').hide();
                }else{
                    $('.image').hide();
                    $('#slot').hide();
                    $('#embed_code').hide();
                }

                $(document).on('change','#type',function(e){
                    e.preventDefault();
                    let el = $(this).val();
                    if(el === 'image'){
                        $('.image').show();
                        $('#redirect_url').show();
                        $('#slot').hide();
                        $('#embed_code').hide();

                    }else if(el === 'google_adsense'){
                        $('#slot').show();
                        $('#redirect_url').hide();
                        $('#embed_code').hide();
                        $('.image').hide();

                    }else if(el === 'scripts'){
                        $('#embed_code').show();
                        $('#slot').hide();
                        $('#redirect_url').hide();
                        $('.image').hide();

                    }else{
                        $('#redirect_url').hide();
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/advertisement/edit.blade.php ENDPATH**/ ?>