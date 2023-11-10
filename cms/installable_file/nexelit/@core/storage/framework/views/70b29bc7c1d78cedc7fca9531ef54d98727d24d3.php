<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('events_module_status'))): ?>
        <?php if(count($event_attendances) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo e(get_static_option('events_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Booking Info')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $event_attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        <?php if(!empty($data->event)): ?>
                                            <a href="<?php echo e(route('frontend.events.single',$data->event->slug)); ?>"><?php echo e($data->event_name); ?></a>
                                        <?php else: ?>
                                            <div class="alert alert-warning"><?php echo e(__('This item is not available or removed')); ?></div>
                                        <?php endif; ?>
                                    </h5>
                                    <small class="d-block"><strong><?php echo e(__('Attendance ID:')); ?></strong> #<?php echo e($data->id); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Ticket Price:')); ?></strong> <?php echo e(amount_with_currency_symbol($data->event_cost)); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Quantity:')); ?></strong> <?php echo e($data->quantity); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Payment Gateway:')); ?></strong>
                                        <?php
                                            $custom_fields = unserialize($data->custom_fields);
                                            $selected_payment_gateway = isset($custom_fields['selected_payment_gateway']) ? str_replace('_',' ',__($custom_fields['selected_payment_gateway'])) : '';
                                        ?>
                                        <?php echo e($selected_payment_gateway); ?>

                                    </small>
                                    <small class="d-block"><strong><?php echo e(__('Booking Status:')); ?></strong>
                                        <?php if($data->status == 'pending'): ?>
                                            <span class="alert alert-warning text-capitalize alert-sm alert-small" style="display: inline-block"><?php echo e(__($data->status)); ?></span>
                                        <?php elseif($data->status == 'cancel'): ?>
                                            <span class="alert alert-danger text-capitalize alert-sm alert-small" style="display: inline-block"><?php echo e(__($data->status)); ?></span>
                                        <?php else: ?>
                                            <span class="alert alert-success text-capitalize alert-sm alert-small" style="display: inline-block"><?php echo e(__($data->status)); ?></span>
                                        <?php endif; ?>
                                    </small>
                                    <small class="d-block"><strong><?php echo e(__('Date:')); ?></strong> <?php echo e(date_format($data->created_at,'d M Y')); ?></small>
                                    <?php if(!empty($data->event) && $data->payment_status == 'complete'): ?>
                                        <form action="<?php echo e(route('frontend.event.invoice.generate')); ?>"  method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="<?php echo e($data->id); ?>">
                                            <button class="btn btn-secondary" type="submit"><?php echo e(__('Invoice')); ?></button>
                                        </form>
                                        <form action="<?php echo e(route('user.dashboard.event.ticket.generate')); ?>"  method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                                            <button class="btn btn-primary margin-top-20" type="submit"><?php echo e(__('Ticket')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if($data->payment_status == 'pending' && $data->status != 'cancel'): ?>
                                    <span class="alert alert-warning text-capitalize alert-sm" style="display: inline-block"><?php echo e($data->payment_status); ?></span>
                                    <a href="<?php echo e(route('frontend.event.booking.confirm',$data->id)); ?>" class="btn-boxed btn-small"><?php echo e(__('Pay Now')); ?></a>
                                    <form action="<?php echo e(route('user.dashboard.event.order.cancel')); ?>" method="post">
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
                <?php echo e($event_attendances->links()); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('No Event Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/event-booking.blade.php ENDPATH**/ ?>