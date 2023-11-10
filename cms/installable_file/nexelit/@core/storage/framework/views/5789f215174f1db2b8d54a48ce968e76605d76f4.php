<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Courses Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-datepicker.min.css')); ?>">
    <?php echo $__env->make('backend.partials.datatable.style-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('All Courses Coupon')); ?></h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value=""><?php echo e(__('Bulk Action')); ?></option>
                                    <option value="delete"><?php echo e(__('Delete')); ?></option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
                            </div>
                        </div>
                          <div class="table-wrap table-responsive">
                                <table class="table table-default">
                                    <thead>
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Code')); ?></th>
                                    <th><?php echo e(__('Discount')); ?></th>
                                    <th><?php echo e(__('Expire Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $all_coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="<?php echo e($data->id); ?>">
                                                </div>
                                            </td>
                                            <td><?php echo e($data->id); ?></td>
                                            <td><?php echo e($data->code); ?></td>
                                            <td><?php if($data->discount_type == 'percentage'): ?> <?php echo e($data->discount); ?>% <?php else: ?> <?php echo e(amount_with_currency_symbol($data->discount)); ?> <?php endif; ?></td>
                                            <td><?php echo e(date('d M Y',strtotime($data->expire_date))); ?></td>
                                            <td>
                                                <?php if('publish' == $data->status): ?>
                                                    <span class="btn btn-success btn-xs"><?php echo e(ucfirst($data->status)); ?></span>
                                                <?php else: ?>
                                                    <span class="btn btn-warning btn-xs"><?php echo e(ucfirst($data->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <!-- -->
                                            <td>
                                               <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-popover','data' => ['url' => route('admin.courses.coupon.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.courses.coupon.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#category_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 category_edit_btn"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-code="<?php echo e($data->code); ?>"
                                                   data-discount="<?php echo e($data->discount); ?>"
                                                   data-discount_type="<?php echo e($data->discount_type); ?>"
                                                   data-expire_date="<?php echo e($data->expire_date); ?>"
                                                   data-status="<?php echo e($data->status); ?>"
                                                >
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Add New Coupon')); ?></h4>
                        <form action="<?php echo e(route('admin.courses.coupon.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="code"><?php echo e(__('Coupon Code')); ?></label>
                                <input type="text" class="form-control"  id="code" name="code" placeholder="<?php echo e(__('Code')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="discount"><?php echo e(__('Discount')); ?></label>
                                <input type="text" class="form-control"  id="discount" name="discount" placeholder="<?php echo e(__('Discount')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="discount_type"><?php echo e(__('Coupon Type')); ?></label>
                                <select name="discount_type" class="form-control" id="discount_type">
                                    <option value="percentage"><?php echo e(__("Percentage")); ?></option>
                                    <option value="amount"><?php echo e(__("Amount")); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expire_date"><?php echo e(__('Expire Date')); ?></label>
                                <input type="date" class="form-control datepicker"  id="expire_date" name="expire_date" placeholder="<?php echo e(__('Expire Date')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish"><?php echo e(__("Publish")); ?></option>
                                    <option value="draft"><?php echo e(__("Draft")); ?></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Coupon')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Update Coupon')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="<?php echo e(route('admin.courses.coupon.update')); ?>"  method="post">
                    <input type="hidden" name="id" >
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="edit_code"><?php echo e(__('Coupon Code')); ?></label>
                            <input type="text" class="form-control"   name="code" placeholder="<?php echo e(__('Code')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount"><?php echo e(__('Discount')); ?></label>
                            <input type="text" class="form-control"   name="discount" placeholder="<?php echo e(__('Discount')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_discount_type"><?php echo e(__('Coupon Type')); ?></label>
                            <select name="discount_type" class="form-control" >
                                <option value="percentage"><?php echo e(__("Percentage")); ?></option>
                                <option value="amount"><?php echo e(__("Amount")); ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_expire_date"><?php echo e(__('Expire Date')); ?></label>
                            <input type="date" class="form-control datepicker" name="expire_date" placeholder="<?php echo e(__('Expire Date')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_status"><?php echo e(__('Status')); ?></label>
                            <select name="status" class="form-control" >
                                <option value="draft"><?php echo e(__("Draft")); ?></option>
                                <option value="publish"><?php echo e(__("Publish")); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Change')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.bulk-action',['action' => route('admin.courses.coupon.bulk.action')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.partials.datatable.script-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {

            $(document).on('click','.category_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('input[name="id"]').val(id);
                modal.find('select[name="status"] option[value="'+status+'"]').prop('selected',true);
                modal.find('input[name="code"]').val(el.data('code'));
                modal.find('input[name="discount"]').val(el.data('discount'));
                modal.find('input[name="expire_date"]').val(el.data('expire_date'));
                modal.find('select[name="discount_type"] option[value="'+el.data('discount_type')+'"]').prop('selected',true);
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/courses/course-coupon.blade.php ENDPATH**/ ?>