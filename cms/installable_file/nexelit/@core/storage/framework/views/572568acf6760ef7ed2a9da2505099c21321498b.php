<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('backend.partials.datatable.style-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Product Orders')); ?>

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
                                   <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                   <div class="header-wrap d-flex justify-content-between">
                                      <div class="left-wrap">
                                          <h4 class="header-title"><?php echo e(__('All Product Orders')); ?></h4>
                                          <div class="bulk-delete-wrapper">
                                              <div class="select-box-wrap">
                                                  <select name="bulk_option" id="bulk_option">
                                                      <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                                      <option value="delete"><?php echo e(__('Delete')); ?></option>
                                                  </select>
                                                  <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
                                              </div>
                                          </div>
                                      </div>
                                       <div class="righ-wrap">
                                           <a href="<?php echo e(route('admin.product.order.new')); ?>" class="btn btn-primary"><?php echo e(__('Create An Order')); ?></a>
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
                                                <th><?php echo e(__('Order ID')); ?></th>
                                                <th><?php echo e(__('Billing Name')); ?></th>
                                                <th><?php echo e(__('Billing Email')); ?></th>
                                                <th><?php echo e(__('Total Amount')); ?></th>
                                                <th><?php echo e(__('Payment Gateway')); ?></th>
                                                <th><?php echo e(__('Payment Status')); ?></th>
                                                <th><?php echo e(__('Status')); ?></th>
                                                <th><?php echo e(__('Date')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $all_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($data->id); ?></td>
                                                    <td><?php echo e($data->billing_name); ?></td>
                                                    <td><?php echo e($data->billing_email); ?></td>
                                                    <td><?php echo e(amount_with_currency_symbol($data->total)); ?></td>
                                                    <td><strong><?php echo e(ucwords(str_replace('_',' ',$data->payment_gateway))); ?></strong></td>
                                                    <td>
                                                        <?php if($data->payment_status == 'pending'): ?>
                                                            <span class="alert alert-warning text-capitalize"><?php echo e(__($data->payment_status)); ?></span>
                                                        <?php else: ?>
                                                            <span class="alert alert-success text-capitalize"><?php echo e(__($data->payment_status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($data->status == 'pending'): ?>
                                                            <span class="alert alert-warning text-capitalize"><?php echo e(__($data->status)); ?></span>
                                                        <?php elseif($data->status == 'in_progress'): ?>
                                                            <span class="alert alert-info text-capitalize"><?php echo e(ucwords(str_replace('_',' ',__($data->status)))); ?></span>
                                                        <?php elseif($data->status == 'shipped'): ?>
                                                            <span class="alert alert-info text-capitalize"><?php echo e(__($data->status)); ?></span>
                                                        <?php elseif($data->status == 'complete'): ?>
                                                            <span class="alert alert-success text-capitalize"><?php echo e(__($data->status)); ?></span>
                                                        <?php elseif($data->status == 'cancel'): ?>
                                                            <span class="alert alert-danger text-capitalize"><?php echo e(__($data->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(date_format($data->created_at,'d M Y')); ?></td>
                                                    <td>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.product.payment.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.product.payment.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <?php $shipping_method = !empty($data->shipping_details->title) ? $data->shipping_details->title : 'not selected'; ?>
                                                        <a href="<?php echo e(route('admin.product.order.view',$data->id)); ?>" target="_blank" class="btn btn-xs btn-primary btn-sm mb-3 mr-1">
                                                        <i class="ti-eye"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-id="<?php echo e($data->id); ?>"
                                                           data-status="<?php echo e($data->status); ?>"
                                                           data-toggle="modal"
                                                           data-target="#order_status_change_modal"
                                                           class="btn btn-xs btn-info btn-sm mb-3 mr-1 order_status_change_btn"
                                                        >
                                                            <?php echo e(__("Update Status")); ?>

                                                        </a>
                                                        <?php if(($data->payment_gateway == 'cash_on_delivery' || $data->payment_gateway == 'manual_payment') && $data->payment_status == 'pending'): ?>
                                                            <a tabindex="0" class="btn btn-xs btn-success btn-sm mb-3 mr-1" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="" data-content="
                                                       <h6><?php echo e(__('Are you sure to approve this order?')); ?></h6>
                                                       <form method='post' action='<?php echo e(route('admin.products.order.payment.approve',$data->id)); ?>'>
                                                       <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                                       <br>
                                                        <input type='submit' class='btn btn-success btn-sm' value='<?php echo e(__('Yes,Please')); ?>'>
                                                        </form>
                                                        " data-original-title="">
                                                                <?php echo e(__('Approve Payment')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if(!empty($data->user_id) && $data->payment_status == 'pending'): ?>
                                                            <form action="<?php echo e(route('admin.product.order.reminder')); ?>"  method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                                                                <button class="btn btn-secondary mb-2" type="submit"><i class="fas fa-bell"></i></button>
                                                            </form>
                                                        <?php endif; ?>
                                                        <form action="<?php echo e(route('frontend.product.invoice.generate')); ?>"  method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="order_id" id="invoice_generate_order_field" value="<?php echo e($data->id); ?>">
                                                            <button class="btn btn-secondary" type="submit"><?php echo e(__('Invoice')); ?></button>
                                                        </form>

                                                        <?php if(!empty($data->manual_payment_attachment)): ?>
                                                            <a class="btn btn-warning mt-2 btn-xs mb-3" href="<?php echo e(url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''); ?>" target="_blank">
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

    <div class="modal fade" id="view_quote_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="view-quote-details-info" id="view-quote-details-info">
                    <h4 class="title"><?php echo e(__('View Order Details Information')); ?></h4>
                    <div class="view-quote-top-wrap">
                        <div class="status-wrap">
                            <?php echo e(__('Status:')); ?> <span class="quote-status-span"></span>
                        </div>
                        <div class="data-wrap">
                           <?php echo e(__(' Date:')); ?> <span class="quote-date-span"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="quote-all-custom-fields table-striped table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order_status_change_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Order Status Change')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.product.order.status.change')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="form-group">
                            <label for="order_status"><?php echo e(__('order Status')); ?></label>
                            <select name="order_status" class="form-control" id="order_status">
                                <option value="pending"><?php echo e(__('Pending')); ?></option>
                                <option value="in_progress"><?php echo e(__('In Progress')); ?></option>
                                <option value="shipped"><?php echo e(__('Shipped')); ?></option>
                                <option value="cancel"><?php echo e(__('Cancel')); ?></option>
                                <option value="complete"><?php echo e(__('Complete')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Change Status')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function($) {

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
                        'url' : "<?php echo e(route('admin.product.order.bulk.action')); ?>",
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

            $(document).on('click','#genarate_invoice',function (e) {
                e.preventDefault();

                var doc = new jsPDF();
                var elementHTML = $('#pdf_content_wrapper').html();
                var specialElementHandlers = {
                    '#elementH': function (element, renderer) {
                        return true;
                    }
                };
                doc.fromHTML(elementHTML, 15, 15, {
                    'width': 170,
                    'elementHandlers': specialElementHandlers
                });

                // Save the PDF
                doc.save('sample-document.pdf');

            })

            $(document).on('click','.view_quote_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_quote_details_modal');
                var statusClass = allData.status == 'pending' ? 'alert alert-warning' : 'alert alert-success';
                var allProducts = allData.cart_items;
                parent.find('.quote-status-span').text(allData.status).addClass(statusClass);
                parent.find('.quote-date-span').text(allData.date);
                parent.find('.quote-all-custom-fields').html('');
                $('#invoice_generate_order_field').val(el.data('order_id'));
                delete allData.date;
                delete allData.status;
                delete allData.target;
                delete allData.toggle;
                delete allData.order_id;
                delete allData.cart_items;
                $.each(allData,function (index,value) {
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">'+index.replace('_',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                });
                $.each(allProducts,function (index,value) {
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">Product Name</td> <td class="fvalue">'+value.title+'</td></tr>');
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">Quantity</td> <td class="fvalue">'+value.quantity+'</td></tr>');
                });
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
            $(document).on('click','.order_status_change_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#order_status_change_modal');
                form.find('#order_id').val(el.data('id'));
                form.find('#order_status option[value="'+el.data('status')+'"]').attr('selected',true);
            });

        } );
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/products/product-orders-all.blade.php ENDPATH**/ ?>