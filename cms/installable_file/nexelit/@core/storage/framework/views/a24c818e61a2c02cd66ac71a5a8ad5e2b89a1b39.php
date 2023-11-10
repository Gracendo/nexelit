<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Appointments Booking Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title"><?php echo e(__('Appointments Booking Details')); ?></h4>
                           <a href="<?php echo e(route('admin.appointment.booking.all')); ?>" class="btn btn-info"><?php echo e(__('All Appointment Booking')); ?></a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong><?php echo e(__('ID')); ?></strong> : #<?php echo e($booking_details->id); ?></li>
                                <li><strong><?php echo e(__('Name')); ?></strong> : <?php echo e($booking_details->name); ?></li>
                                <li><strong><?php echo e(__('Email')); ?></strong> : <?php echo e($booking_details->email); ?></li>
                                <li><strong><?php echo e(__('Appointment Title')); ?></strong> : <?php echo e($booking_details->appointment->title ?? __('Untitled')); ?></li>
                                <li><strong><?php echo e(__('Appointment Fee')); ?></strong> : <?php echo e($booking_details->total); ?></li>
                                <li><strong><?php echo e(__('Appointment Date')); ?></strong> : <?php echo e(date('D,d F Y',strtotime($booking_details->booking_date))); ?></li>
                                <li><strong><?php echo e(__('Appointment Time')); ?></strong> : <?php echo e($booking_details->booking_time->time ?? __('Not Set')); ?></li>
                                <li><strong><?php echo e(__('Payment Gateway')); ?></strong> : <?php echo e($booking_details->payment_gateway); ?></li>
                                <li><strong><?php echo e(__('Payment Status')); ?></strong> : <?php echo e($booking_details->payment_status); ?></li>
                                <?php if($booking_details->payment_status === 'complete'): ?>
                                <li><strong><?php echo e(__('Transaction ID')); ?></strong> : <?php echo e($booking_details->transaction_id); ?></li>
                                <?php endif; ?>
                                <li><strong><?php echo e(__('Booking Status')); ?></strong> : <?php echo e($booking_details->status); ?></li>
                                <?php if(count($booking_details->custom_fields) > 0): ?>
                                <li><strong><?php echo e(__('Custom Fields')); ?></strong> :
                                    <ul>
                                        <?php $__currentLoopData = $booking_details->custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($key,['name','email','appointment_id','selected_payment_gateway','booking_time','booking_date'])): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <li><string><?php echo e(str_replace(['_','-'],[' ',' '],$key)); ?></string> : <?php echo e($item); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if(count($booking_details->all_attachment) > 0): ?>
                                    <li><strong><?php echo e(__('Attachments')); ?></strong> :
                                        <ul>
                                            <?php $__currentLoopData = $booking_details->all_attachment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><string><?php echo e(str_replace(['_','-'],[' ',' '],$key)); ?></string> :
                                                    <a href="<?php echo e(asset($item)); ?>"><?php echo e($item); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/appointment/appointment-booking-view.blade.php ENDPATH**/ ?>