<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Products Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Products Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.products.page.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="product_category_<?php echo e($lang->slug); ?>_text"><?php echo e(__('Category Title')); ?></label>
                                            <input type="text" name="product_category_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_category_'.$lang->slug.'_text')); ?>" id="product_category_<?php echo e($lang->slug); ?>_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_price_filter_<?php echo e($lang->slug); ?>_text"><?php echo e(__('Price Filter Title')); ?></label>
                                            <input type="text" name="product_price_filter_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_price_filter_'.$lang->slug.'_text')); ?>" id="product_price_filter_<?php echo e($lang->slug); ?>_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_rating_filter_<?php echo e($lang->slug); ?>_text"><?php echo e(__('Rating Filter Title')); ?></label>
                                            <input type="text" name="product_rating_filter_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_rating_filter_'.$lang->slug.'_text')); ?>" id="product_rating_filter_<?php echo e($lang->slug); ?>_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_add_to_cart_button_<?php echo e($lang->slug); ?>_text"><?php echo e(__('Add To Cart Button Text')); ?></label>
                                            <input type="text" name="product_add_to_cart_button_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_add_to_cart_button_'.$lang->slug.'_text')); ?>" id="product_add_to_cart_button_<?php echo e($lang->slug); ?>_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_view_option_button_<?php echo e($lang->slug); ?>_text"><?php echo e(__('View Options Button Text')); ?></label>
                                            <input type="text" name="product_view_option_button_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_view_option_button_'.$lang->slug.'_text')); ?>" id="product_view_option_button_<?php echo e($lang->slug); ?>_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_download_now_button_<?php echo e($lang->slug); ?>_text"><?php echo e(__('Download Now Button Text')); ?></label>
                                            <input type="text" name="product_download_now_button_<?php echo e($lang->slug); ?>_text"  class="form-control" value="<?php echo e(get_static_option('product_download_now_button_'.$lang->slug.'_text')); ?>" >
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="product_post_items"><?php echo e(__('Products Items')); ?></label>
                                <input type="text" name="product_post_items"  class="form-control" value="<?php echo e(get_static_option('product_post_items')); ?>" id="product_post_items">
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/products/product-page-settings.blade.php ENDPATH**/ ?>