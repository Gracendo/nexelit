<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Tax Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Product Tax Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.products.tax.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="product_tax"><strong><?php echo e(__('Enable Tax Option')); ?></strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="product_tax"  <?php if(!empty(get_static_option('product_tax'))): ?> checked <?php endif; ?> >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_system"><?php echo e(__('Tax Type')); ?></label>
                                <select name="product_tax_system" class="form-control">
                                    <option <?php if(get_static_option('product_tax_system') == 'inclusive'): ?> selected <?php endif; ?> value="inclusive"><?php echo e(__('Inclusive')); ?></option>
                                    <option <?php if(get_static_option('product_tax_system') == 'exclusive'): ?> selected <?php endif; ?> value="exclusive"><?php echo e(__('Exclusive')); ?></option>
                                </select>
                                <small class="help-info"><?php echo e(__('if you select inclusive tax system, it will not show an in frontend. it just add a notice in order success mail.')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_type"><?php echo e(__('Tax Calculate Type')); ?></label>
                                <select name="product_tax_type" class="form-control">
                                    <option <?php if(get_static_option('product_tax_type') == 'individual'): ?> selected <?php endif; ?> value="individual"><?php echo e(__('Individual')); ?></option>
                                    <option <?php if(get_static_option('product_tax_type') == 'total'): ?> selected <?php endif; ?> value="total"><?php echo e(__('On Total Amount')); ?></option>
                                </select>
                                <small class="help-info"><?php echo e(__('if you select individual, you have to set tax percentage in every product. if you select total, then it will add tax on total amount of cart after coupon ( if coupon applied )')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="product_tax_percentage"><?php echo e(__('Tax Rate')); ?></label>
                                <input type="number" name="product_tax_percentage"  class="form-control" value="<?php echo e(get_static_option('product_tax_percentage')); ?>" >
                                <small class="help-info"><?php echo e(__('it will be counted as percentage')); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/products/product-tax-settings.blade.php ENDPATH**/ ?>