<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Sitemap Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Sitemap Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.sitemap.settings')); ?>" id="sitemap_form" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                                <?php
                                    $url = url('/');
                                ?>
                                <div class="form-group">
                                    <input type="hidden" class="form-control site_url_data" name="site_url" value="<?php echo e($url); ?>">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary my-3 sitemap_button " id="custom"><?php echo e(__('Generate Now')); ?></button>
                                    <br>
                                   <small class="text-danger"><?php echo e(__('It will take time to generate sitemap..Please increase your server executing time over ( 300 seconds )')); ?></small>
                                </div>
                        </form>
                        <table class="table table-default">
                            <thead>
                            <th><?php echo e(__('Name')); ?></th>
                            <th><?php echo e(__('Date')); ?></th>
                            <th><?php echo e(__('Size')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $all_sitemap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(basename($data)); ?></td>
                                    <td><?php echo e(date('j F Y - h:m:s',filectime($data))); ?></td>
                                    <td><?php if(trim(formatBytes(filesize($data))) === 'NAN'): ?> <?php echo e(__('0 Byte')); ?> <?php else: ?> <?php echo e(formatBytes(filesize($data))); ?> <?php endif; ?></td>
                                    <td>
                                        <a class="btn btn-xs text-white btn-danger mb-3 mr-1 delete_sitemap_xml_file_btn">
                                            <i class="ti-trash"></i>
                                        </a>
                                        <form method='post' class="d-none delete_sitemap_file_form"  action='<?php echo e(route("admin.general.sitemap.settings.delete")); ?>'>
                                               <?php echo csrf_field(); ?>
                                            <input type='hidden' name='sitemap_name' value='<?php echo e($data); ?>'>
                                            <input type='submit' class='btn btn-danger btn-xs' value='<?php echo e(__('Yes, Please')); ?>'>
                                        </form>
                                        <a href="<?php echo e(asset('sitemap')); ?>/<?php echo e(basename($data)); ?>" download class="btn btn-primary btn-xs mb-3 mr-1"> <i class="fa fa-download"></i> </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.custom','data' => ['title' => 'Generating..']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.custom'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Generating..')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<script>
    (function($){
        "use strict";
        
        $(document).on('click','.delete_sitemap_xml_file_btn',function(e){
                e.preventDefault();
                Swal.fire({
                    title: '<?php echo e(__("Are you sure to delete it?")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete It!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next('.delete_sitemap_file_form').find('input[type="submit"]').trigger('click');
                    }
                });
            });
        
    })(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/general-settings/sitemap-settings.blade.php ENDPATH**/ ?>