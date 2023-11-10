<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('donations_module_status'))): ?>
        <?php if(count($donation) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Info')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $donation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        <?php if(!empty($data->donation)): ?>
                                            <a href="<?php echo e(route('frontend.donations.single',$data->donation->slug)); ?>"><?php echo e($data->donation->title); ?></a>
                                        <?php else: ?>
                                            <div class="text-warning"><?php echo e(__('This item is not available or removed')); ?></div>
                                        <?php endif; ?>
                                    </h5>
                                    <small class="d-block"><strong><?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('ID:')); ?></strong> #<?php echo e($data->id); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Amount:')); ?></strong> <?php echo e(amount_with_currency_symbol($data->amount)); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Payment Gateway:')); ?></strong> <?php echo e(str_replace('_',' ',__($data->payment_gateway))); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Date:')); ?></strong> <?php echo e(date_format($data->created_at,'d M Y')); ?></small>
                                    <?php if(!empty($data->donation) && $data->status == 'complete'): ?>
                                        <form action="<?php echo e(route('frontend.donation.invoice.generate')); ?>"  method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="<?php echo e($data->id); ?>">
                                            <button class="btn btn-secondary btn-small" type="submit"><?php echo e(__('Invoice')); ?></button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if(!empty($data->manual_payment_attachment)): ?>
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="<?php echo e(url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''); ?>" target="_blank">
                                            <?php echo e(__('View Bank Attachment')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if($data->status == 'pending'): ?>
                                    <span class="alert alert-warning text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                                    <?php if( $data->payment_gateway != 'manual_payment'): ?>
                                        <form action="<?php echo e(route('frontend.donations.log.store')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>" >
                                            <input type="hidden" name="donation_id" value="<?php echo e($data->donation_id); ?>" >
                                            <input type="hidden" name="amount" value="<?php echo e($data->amount); ?>">
                                            <input type="hidden" name="name" value="<?php echo e($data->name); ?>" >
                                            <input type="hidden" name="email" value="<?php echo e($data->email); ?>" >
                                            <input type="hidden" name="selected_payment_gateway" value="<?php echo e($data->payment_gateway); ?>">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20"><?php echo e(__('Pay Now')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('user.dashboard.donation.order.cancel')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                        <button type="submit" class="small-btn btn-danger margin-top-10"><?php echo e(__('Cancel')); ?></button>
                                    </form>
                                <?php elseif($data->status == 'cancel'): ?>
                                    <span class="alert alert-danger text-capitalize alert-sm alert-small" style="display: inline-block"><?php echo e(__($data->status)); ?></span>
                                <?php else: ?>
                                    <span class="alert alert-success text-capitalize alert-sm alert-small" style="display: inline-block"><?php echo e(__($data->status)); ?></span>
                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <div class="blog-pagination">
            <?php echo e($donation->links()); ?>

        </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('No Donation Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/donations.blade.php ENDPATH**/ ?>