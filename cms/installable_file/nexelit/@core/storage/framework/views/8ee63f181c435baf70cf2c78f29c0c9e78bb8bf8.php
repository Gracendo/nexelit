<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('product_module_status'))): ?>
        <?php if(count($product_orders) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?>  <?php echo e(__('Order Info')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $product_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <small class="d-block"><strong><?php echo e(__('Order ID:')); ?></strong> #<?php echo e($data->id); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Total Amount:')); ?></strong><?php echo e(amount_with_currency_symbol($data->total)); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Payment Gateway:')); ?></strong><?php echo e(ucwords(str_replace('_',' ',$data->payment_gateway))); ?></small>
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
                                    <small class="d-block"><strong><?php echo e(__('Order Date:')); ?></strong> <?php echo e(date_format($data->created_at,'d M Y')); ?></small>
                                    <?php if($data->payment_status == 'complete'): ?>
                                        <form action="<?php echo e(route('frontend.product.invoice.generate')); ?>"  method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="order_id" id="invoice_generate_order_field" value="<?php echo e($data->id); ?>">
                                            <button class="btn btn-secondary btn-small" type="submit"><?php echo e(__('Invoice')); ?></button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if(!empty($data->manual_payment_attachment)): ?>
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="<?php echo e(url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''); ?>" target="_blank">
                                            <?php echo e(__('View Bank Attachment')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </th>
                            <td>
                                <?php if($data->payment_status == 'pending' && $data->status != 'cancel'): ?>
                                    <span class="alert alert-warning text-capitalize alert-sm margin-bottom-20"><?php echo e($data->payment_status); ?></span>
                                    <?php if( $data->payment_gateway != 'cash_on_delivery' &&  $data->payment_gateway != 'manual_payment'): ?>
                                        <form action="<?php echo e(route('frontend.products.checkout')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                            <input type="hidden" name="selected_payment_gateway" value="<?php echo e($data->payment_gateway); ?>">
                                            <input type="hidden" name="subtotal" value="<?php echo e($data->subtotal); ?>">
                                            <input type="hidden" name="total" value="<?php echo e($data->total); ?>">
                                            <input type="hidden" name="billing_name" value="<?php echo e($data->billing_name); ?>">
                                            <input type="hidden" name="billing_email" value="<?php echo e($data->billing_email); ?>">
                                            <input type="hidden" name="billing_phone" value="<?php echo e($data->billing_phone); ?>">
                                            <input type="hidden" name="billing_country" value="<?php echo e($data->billing_country); ?>">
                                            <input type="hidden" name="billing_street_address" value="<?php echo e($data->billing_street_address); ?>">
                                            <input type="hidden" name="billing_town" value="<?php echo e($data->billing_town); ?>">
                                            <input type="hidden" name="billing_district" value="<?php echo e($data->billing_district); ?>">
                                            <input type="hidden" name="billing_district" value="<?php echo e($data->billing_district); ?>">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20"><?php echo e(__('Pay Now')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('user.dashboard.product.order.cancel')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                        <button type="submit" class="small-btn btn-danger margin-top-10"><?php echo e(__('Cancel')); ?></button>
                                    </form>
                                <?php else: ?>
                                    <span class="alert alert-success text-capitalize alert-sm" style="display: inline-block"><?php echo e($data->payment_status); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo e(route('user.dashboard.product.order.view',$data->id)); ?>" target="_blank" class="small-btn btn-boxed margin-top-20"><?php echo e(__('View Order')); ?></a>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                <?php echo e($product_orders->links()); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('No Product Order Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/product-order.blade.php ENDPATH**/ ?>