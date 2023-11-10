<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Applicant')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <h4 class="header-title"><?php echo e(__('All Applicant')); ?></h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                                <option value="delete"><?php echo e(__('Delete')); ?></option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th><?php echo e(__('ID')); ?></th>
                                                <th><?php echo e(__('Job Title')); ?></th>
                                                <th><?php echo e(__('Job Position')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $all_applicant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($data->id); ?></td>
                                                    <td><?php echo e(!empty($data->job) ? optional($data->job)->title : __('This job is not available or delete')); ?></td>
                                                    <td><?php echo e(!empty($data->job) ? optional($data->job)->position : __('This job is not available or delete')); ?></td>
                                                    <td><?php echo e(date_format($data->created_at,'d M Y h:i:sA')); ?></td>
                                                    <?php
                                                        $all_data = [
                                                                'job_title' => !empty($data->job) ? $data->job->title : __('This job is not available or delete'),
                                                                'applicant_name' => $data->name,
                                                                'applicant_email' => $data->email,
                                                            ];
                                                        $all_data['form_content'] = unserialize($data->form_content);
                                                        //if application fee applicable
                                                        if($data->application_fee > 0){
                                                            $all_data['application_fee'] = amount_with_currency_symbol($data->application_fee);
                                                            $all_data['payment_gateway'] = $data->payment_gateway;
                                                            $all_data['payment_status'] = $data->payment_status;
                                                            $all_data['transaction_id'] = $data->transaction_id;
                                                        }
                                                        $all_data['attachment'] = unserialize($data->attachment);
                                                    ?>

                                                    <td>
                                                         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.jobs.applicant.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.jobs.applicant.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#view_order_details_modal"
                                                           data-alldata="<?php echo e(json_encode($all_data)); ?>"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 view_order_details_btn"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#send_mail_modal"
                                                           data-id="<?php echo e($data->id); ?>"
                                                           data-name="<?php echo e($data->email); ?>"
                                                           data-email="<?php echo e($data->name); ?>"
                                                           class="btn btn-xs btn-info btn-sm mb-3 mr-1 send_mail_btn"
                                                        >
                                                            <i class="ti-email"></i>
                                                        </a>

                                                        <?php if(!empty($data->manual_payment_attachment)): ?>
                                                            <a class="btn btn-success btn-xs mb-3" href="<?php echo e(url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''); ?>" target="_blank">
                                                                <?php echo e(__('View Attachment')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_order_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="view-order-details-info">
                   <h4 class="title"><?php echo e(__('View Applicant Information')); ?></h4>
                   <div class="view-order-top-wrap">
                       <div class="data-wrap">
                           <?php echo e(__('Apply Date')); ?>: <span class="order-date-span"></span>
                       </div>
                   </div>
                   <div class="table-responsive">
                       <table class="order-all-custom-fields table-striped table-bordered"></table>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send_mail_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Send Mail To Applicant')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>

                <form action="<?php echo e(route('admin.jobs.applicant.mail')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="applicant_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form-control" readonly name="name">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo e(__('Email')); ?></label>
                            <input type="email" class="form-control" readonly name="email">
                        </div>
                        <div class="form-group">
                            <label for="Subject"><?php echo e(__('Subject')); ?></label>
                            <input type="text" class="form-control" name="subject" >
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Message')); ?></label>
                            <input type="hidden" name="message">
                            <div class="summernote"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Send Mail')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- Start datatable js -->
    <script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>


    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('<?php echo e(__('Deleting...')); ?>');
                    $.ajax({
                        'type' : "POST",
                        'url' : "<?php echo e(route('admin.jobs.applicant.bulk.delete')); ?>",
                        'data' : {
                            _token: "<?php echo e(csrf_token()); ?>",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.view_order_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data('alldata');
                var parent = $('#view_order_details_modal');

                    console.log(allData);

                parent.find('.order-date-span').text(allData.date);
                parent.find('.order-all-custom-fields').html('');
                $.each(allData,function (index,value) {
                    if (index != 'form_content' && index != 'attachment'){
                    parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('_',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                    }
                });
                if(allData.form_content){
                    $.each(allData.form_content,function (index,value) {
                        parent.find('.order-all-custom-fields').append('<tr><td class="fname">'+index.replace('-',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                    });
                }
                if(allData.attachment){
                    $.each(allData.attachment,function (index,value) {
                        var attname = value.substr(36);
                        parent.find('.order-all-custom-fields').append('<tr class="attachment_list"><td class="fname">'+index.replace('-',' ')+'</td><td class="fvalue"><a href="<?php echo e(url('/')); ?>'+'/'+value+'" download>'+attname+'</a></td></tr>');
                    });
                }
            })

            $('#all_user_table').DataTable( {
                "order": [[1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
            $('.summernote').summernote({
                height: 250,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            $(document).on('click','.send_mail_btn',function(){
                var el = $(this);
                var email = el.data('email');
                var name = el.data('name');
                var id = el.data('id');
                var modalContainerId = $('#send_mail_modal form');

                modalContainerId.find('input[name="name"]').val(name);
                modalContainerId.find('input[name="email"]').val(email);
                modalContainerId.find('input[name="applicant_id"]').val(id);
            });

        } );
    </script>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/jobs/all-applicant.blade.php ENDPATH**/ ?>