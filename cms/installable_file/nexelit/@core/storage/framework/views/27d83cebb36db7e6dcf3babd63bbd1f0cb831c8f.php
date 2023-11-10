<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Price Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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
                    <div class="card-body ">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('New Price Plan')); ?></h4>
                            <a href="<?php echo e(route('admin.price.plan')); ?>" class="btn btn-primary"><?php echo e(__('All Price Plan')); ?></a>
                        </div>

                        <form action="<?php echo e(route('admin.price.plan')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="language"><?php echo e(__('Languages')); ?></label>
                                <select name="lang" id="language" class="form-control">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title"><?php echo e(__('Title')); ?></label>
                                <input type="text" class="form-control"  id="title"  name="title" placeholder="<?php echo e(__('Title')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="price"><?php echo e(__('Price')); ?></label>
                                <input type="text" class="form-control"  id="price"  name="price" placeholder="<?php echo e(__('Price')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="type"><?php echo e(__('Type')); ?></label>
                                <input type="text" class="form-control"  id="type"  name="type" placeholder="<?php echo e(__('Type')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="features"><?php echo e(__('Features')); ?></label>
                                <textarea class="form-control"  id="features"  name="features" placeholder="<?php echo e(__('Features')); ?>" cols="30" rows="10"></textarea>
                                <small class="info=text"><?php echo e(__('Separate feature by new line')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="btn_text"><?php echo e(__('Button Text')); ?></label>
                                <input type="text" class="form-control"  id="btn_text"  name="btn_text" placeholder="<?php echo e(__('Button Text')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="highlinght"><strong><?php echo e(__('Highlight')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="highlinght" id="highlinght">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="url_status"><strong><?php echo e(__('Plan Detail Page')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="url_status" id="url_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="btn_url"><?php echo e(__('Button URL')); ?></label>
                                <input type="text" class="form-control"  id="btn_url"  name="btn_url" placeholder="<?php echo e(__('Button URL')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="categories_id"><?php echo e(__('Category')); ?></label>
                                <select name="categories_id" class="form-control" id="category">
                                    <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option value="draft"><?php echo e(__('Draft')); ?></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Price Plan')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function () {
            $(document).on('click','.price_plan_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var action = el.data('action');
                var form = $('#price_plan_edit_modal_form');
                form.attr('action',action);
                form.find('#price_plan_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_price').val(el.data('price'));
                form.find('#edit_icon').val(el.data('icon'));
                form.find('#edit_type').val(el.data('type'));
                form.find('#edit_btn_text').val(el.data('btntext'));
                form.find('#edit_btn_url').val(el.data('btnurl'));
                form.find('#edit_features').val(el.data('features'));
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                if(el.data('urlstatus') != ''){
                    form.find('#edit_url_status').attr('checked',true);
                    form.find('#edit_url_status').parent().parent().next().hide();
                }
            });
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change','input[name="url_status"]',function (e) {
                e.preventDefault();
                if($('input[name="url_status"]').is(":checked")){
                    $(this).parent().parent().next().hide();
                }else{
                    $(this).parent().parent().next().show();
                }
            });

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('admin.price.plan.lang.cat')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>')
                        });
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/pages/price-plan/price-plan-new.blade.php ENDPATH**/ ?>