<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('product_module_status'))): ?>
        <?php if(!empty($downloads)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo e(__('Thumbnail')); ?></th>
                        <th scope="col"><?php echo e(__('Product Info')); ?></th>
                        <th scope="col"><?php echo e(__('Download')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $downloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th>
                                <div class="thumb-wrap" style="max-width: 60px">
                                    <?php echo render_image_markup_by_attachment_id($data['image']); ?>

                                </div>
                            </th>
                            <td>
                                <a href="<?php echo e(route('frontend.products.single',$data['slug'])); ?>"><h4 style="font-weight: 600;"><?php echo e($data['title']); ?></h4></a>
                                <div>
                                    <small class="d-block"><strong><?php echo e(__('Order ID:')); ?></strong> <?php echo e($data['order_id']); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Quantity:')); ?></strong> <?php echo e($data['quantity']); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Purchased:')); ?></strong> <?php echo e(date_format($data['order_date'],'d M Y')); ?></small>
                                </div>
                            </td>
                            <td>
                                <a class="btn-boxed style-01 margin-bottom-10" href="<?php echo e(route('user.dashboard.download.file',$data['id'])); ?>"><?php echo e(__('Download File')); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('No Downloads Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/user/dashboard/product-downloads.blade.php ENDPATH**/ ?>