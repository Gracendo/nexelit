<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('course_module_status'))): ?>
        <?php if(count($all_enrolls) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"> <?php echo e(__('Enroll Info')); ?></th>
                        <th scope="col"><?php echo e(__('Enroll & Payment Status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $all_enrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        <?php if(!empty($data->course)): ?>
                                            <a href="<?php echo e(route('frontend.course.single',[optional(optional($data->course)->lang_front)->slug,optional($data->course)->id])); ?>"><?php echo e(optional(optional($data->course)->lang_front)->title); ?></a>
                                        <?php else: ?>
                                            <div class="text-warning"><?php echo e(__('This item is not available or removed')); ?></div>
                                        <?php endif; ?>
                                    </h5>
                                    <small class="d-block"><strong> <?php echo e(__('Enroll ID:')); ?></strong> #<?php echo e($data->id); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Amount:')); ?></strong>
                                        <?php echo e(amount_with_currency_symbol(course_discounted_amount($data->total,$data->coupon))); ?>

                                        <?php if(!empty($data->coupon)): ?>
                                            <del> <?php echo e(amount_with_currency_symbol($data->total)); ?></del>
                                        <?php endif; ?>
                                    </small>
                                    <small class="d-block"><strong><?php echo e(__('Payment Gateway:')); ?></strong> <?php echo e(str_replace('_',' ',__($data->payment_gateway))); ?></small>
                                    <small class="d-block"><strong><?php echo e(__('Enroll Status:')); ?></strong> <?php echo e($data->status); ?></small>

                                    <?php if(!empty($data->coupon)): ?>
                                        <small class="d-block"><strong><?php echo e(__('Coupon:')); ?></strong> <?php echo e($data->coupon); ?></small>
                                    <?php endif; ?>
                                    <?php if(!empty($data->coupon)): ?>
                                        <small class="d-block"><strong><?php echo e(__('Discount:')); ?></strong> <?php echo e(amount_with_currency_symbol($data->coupon_discounted)); ?></small>
                                    <?php endif; ?>
                                    <?php if($data->payment_status === 'complete'): ?>
                                    <small class="d-block"><strong><?php echo e(__('Transaction Id:')); ?></strong> <?php echo e($data->transaction_id); ?></small>
                                    <?php endif; ?>
                                    <small class="d-block"><strong><?php echo e(__('Date:')); ?></strong> <?php echo e(date_format($data->created_at,'d M Y')); ?></small>
                                </div>
                            </td>
                            <td>
                                <?php if($data->status == 'pending'): ?>
                                    <span class="alert alert-warning text-capitalize alert-sm alert-small"><?php echo e(__($data->status)); ?></span>
                                    <?php if( $data->payment_gateway != 'manual_payment'): ?>
                                        <form action="<?php echo e(route('frontend.course.enroll.submit')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="enroll_id" value="<?php echo e($data->id); ?>" >
                                            <input type="hidden" name="name" value="<?php echo e($data->name); ?>" >
                                            <input type="hidden" name="email" value="<?php echo e($data->email); ?>" >
                                            <input type="hidden" name="course_id" value="<?php echo e($data->course_id); ?>">
                                            <input type="hidden" name="selected_payment_gateway" value="<?php echo e($data->payment_gateway); ?>">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20"><?php echo e(__('Pay Now')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('user.dashboard.course.order.cancel')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="order_id" value="<?php echo e($data->id); ?>">
                                        <button type="submit" class="small-btn btn-danger margin-top-10 "><?php echo e(__('Cancel')); ?></button>
                                    </form>
                                <?php elseif($data->status == 'cancel'): ?>
                                    <span class="alert alert-danger text-capitalize alert-sm alert-small d-inline-block"><?php echo e(__($data->status)); ?></span>
                                <?php else: ?>
                                    <span class="alert alert-success text-capitalize alert-sm alert-small d-inline-block"><?php echo e(__($data->status)); ?></span>
                                    <br>
                                    <a href="<?php echo e(route('frontend.course.lesson.start',[$data->course_id,$data->id])); ?>" class="btn-success btn"><?php echo e(__('Start Learning')); ?></a>

                                    <?php if(!is_null($data->certificate)): ?>
                                        <?php if(optional($data->certificate)->status === 0): ?>
                                        <a class="btn btn-warning margin-top-10"><?php echo e(__('Waiting For Approval')); ?></a>
                                        <?php else: ?>
                                        <a href="<?php echo e(route('user.dashboard.course.certificate.download',optional($data->certificate)->id)); ?>" class="btn btn-info  margin-top-10"><?php echo e(__('Download Certificate')); ?></a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('user.dashboard.course.certificate')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="course_id" value="<?php echo e($data->course_id); ?>">
                                            <button type="submit" class="small-btn btn-info margin-top-10 "><?php echo e(__('Request For Certificate')); ?></button>
                                        </form>
                                    <?php endif; ?>

                                <?php endif; ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                <?php echo e($all_enrolls->links()); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('Nothing Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/course-order.blade.php ENDPATH**/ ?>