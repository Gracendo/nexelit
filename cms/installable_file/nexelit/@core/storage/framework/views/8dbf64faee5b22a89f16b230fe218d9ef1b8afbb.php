<?php $__env->startSection('style'); ?>
    <style>
        button.low,
        button.status-open{
            display: inline-block;
            background-color: #6bb17b;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }
        button.high,
        button.status-close{
            display: inline-block;
            background-color: #c66060;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }
        button.medium {
            display: inline-block;
            background-color: #70b9ae;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }
        button.urgent {
            display: inline-block;
            background-color: #bfb55a;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <?php if(!empty(get_static_option('support_ticket_module_status'))): ?>
        <a href="<?php echo e(route('frontend.support.ticket')); ?>" class="btn btn-info margin-bottom-30"><?php echo e(__('New Ticket')); ?></a>
        <?php if(count($all_tickets) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th><?php echo e(__('ID')); ?></th>
                        <th><?php echo e(__('Title')); ?></th>
                        <th><?php echo e(__('Priority')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $all_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($data->id); ?></td>
                            <td><?php echo e($data->title); ?>

                            <p><?php echo e(__('created at:')); ?> <small><?php echo e($data->created_at->format('D, d M Y')); ?></small></p>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="<?php echo e($data->priority); ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e($data->priority); ?>

                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item change_priority" data-id="<?php echo e($data->id); ?>" data-val="low" href="#"><?php echo e(__('Low')); ?></a>
                                        <a class="dropdown-item change_priority" data-id="<?php echo e($data->id); ?>" data-val="high" href="#"><?php echo e(__('High')); ?></a>
                                        <a class="dropdown-item change_priority" data-id="<?php echo e($data->id); ?>" data-val="medium" href="#"><?php echo e(__('Medium')); ?></a>
                                        <a class="dropdown-item change_priority" data-id="<?php echo e($data->id); ?>" data-val="urgent" href="#"><?php echo e(__('Urgent')); ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="status-<?php echo e($data->status); ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e($data->status); ?>

                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item status_change" data-id="<?php echo e($data->id); ?>" data-val="open" href="#"><?php echo e(__('Open')); ?></a>
                                        <a class="dropdown-item status_change" data-id="<?php echo e($data->id); ?>" data-val="close" href="#"><?php echo e(__('Close')); ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('user.dashboard.support.ticket.view',$data->id)); ?>"  class="btn btn-info btn-xs" target="_blank"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                <?php echo e($all_tickets->links()); ?>

            </div>
        <?php else: ?>
            <div class="alert alert-warning"><?php echo e(__('Nothing Found')); ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function (){
            "use strict";

            $(document).on('click','.change_priority',function (e){
                e.preventDefault();
                //get value
                var priority = $(this).data('val');
                var id = $(this).data('id');
                var currentPriority =  $(this).parent().prev('button').text();
                currentPriority = currentPriority.trim();
                $(this).parent().prev('button').removeClass(currentPriority).addClass(priority).text(priority);
                //ajax call
                $.ajax({
                    'type': 'post',
                    'url' : "<?php echo e(route('user.dashboard.support.ticket.priority.change')); ?>",
                    'data' : {
                        _token : "<?php echo e(csrf_token()); ?>",
                        priority : priority,
                        id : id,
                    },
                    success: function (data){
                        $(this).parent().find('button.'+currentPriority).removeClass(currentPriority).addClass(priority).text(priority);
                    }
                })
            });
            $(document).on('click','.status_change',function (e){
                e.preventDefault();
                //get value
                var status = $(this).data('val');
                var id = $(this).data('id');
                var currentStatus =  $(this).parent().prev('button').text();
                currentStatus = currentStatus.trim();
                $(this).parent().prev('button').removeClass('status-'+currentStatus).addClass('status-'+status).text(status);
                //ajax call
                $.ajax({
                    'type': 'post',
                    'url' : "<?php echo e(route('user.dashboard.support.ticket.status.change')); ?>",
                    'data' : {
                        _token : "<?php echo e(csrf_token()); ?>",
                        status : status,
                        id : id,
                    },
                    success: function (data){
                        $(this).parent().prev('button').removeClass(currentStatus).addClass(status).text(status);
                    }
                })
            });


        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/support-tickets.blade.php ENDPATH**/ ?>