<?php $__env->startSection('section'); ?>
    <?php if(count($package_orders) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col"><?php echo e(__('Package Order Info')); ?></th>
                    <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $package_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="user-dahsboard-order-info-wrap">
                                <h5 class="title"><?php echo e($data->package_name); ?></h5>
                                <div class="div">
                                    <small class="d-block"><strong><?php echo e(__('Order ID:')); ?></strong> #<?php echo e($data->id); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Package Price:')); ?></strong> <?php echo e(amount_with_currency_symbol($data->package_price)); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Order Status:')); ?></strong>
                                        <?php if($data->status == 'pending'): ?>
                                            <span class="alert alert-warning text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                                        <?php elseif($data->status == 'cancel'): ?>
                                            <span class="alert alert-danger text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                                        <?php elseif($data->status == 'in_progress'): ?>
                                            <span class="alert alert-info text-capitalize alert-sm alert-small"><?php echo e(str_replace('_',' ',__($data->status))); ?></span>
                                        <?php else: ?>
                                            <span class="alert alert-success text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                                        <?php endif; ?>
                                    </small>

                                    <small class="d-block"><strong><?php echo e(__('Date:')); ?></strong> <?php echo e(date_format($data->created_at,'D m Y')); ?></small>
                                    <?php if($data->payment_status == 'complete'): ?>
                                        <form action="<?php echo e(route('frontend.package.invoice.generate')); ?>"  method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="<?php echo e($data->id); ?>">
                                            <button class="btn btn-secondary btn-xs btn-small margin-top-10" type="submit"><?php echo e(__('Invoice')); ?></button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if(!empty(optional($data->paymentLog)->manual_payment_attachment)): ?>
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="<?php echo e(url('assets/uploads/attachment/'.optional($data->paymentLog)->manual_payment_attachment) ?? ''); ?>" target="_blank">
                                            <?php echo e(__('View Bank Attachment')); ?>

                                        </a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if($data->payment_status == 'pending' && $data->status != 'cancel'): ?>
                                <span class="alert alert-warning text-capitalize alert-sm"><?php echo e($data->payment_status); ?></span>
                                <a href="<?php echo e(route('frontend.order.confirm',$data->id)); ?>" class="small-btn btn-boxed"><?php echo e(__('Pay Now')); ?></a>
                                <form action="<?php echo e(route('user.dashboard.package.order.cancel')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                    <button type="submit" class="small-btn btn-danger margin-top-10"><?php echo e(__('Cancel')); ?></button>
                                </form>
                            <?php else: ?>
                                <span class="alert alert-success text-capitalize alert-sm" style="display: inline-block"><?php echo e($data->payment_status); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="blog-pagination">
            <?php echo e($package_orders->links()); ?>

        </div>
    <?php else: ?>
        <div class="alert alert-warning"><?php echo e(__('No Order Found')); ?></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/package-order.blade.php ENDPATH**/ ?>