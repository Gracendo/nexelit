<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Single Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Product Single Page Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.products.single.page.settings')); ?>" method="POST" enctype="multipart/form-data">
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
                                            <label for="product_single_<?php echo e($lang->slug); ?>_add_to_cart_text"><?php echo e(__('Add To Cart Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_add_to_cart_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_add_to_cart_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_add_to_cart_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_category_text"><?php echo e(__('Category Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_category_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_category_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_category_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_subcategory_text"><?php echo e(__('Sub Category Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_subcategory_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_subcategory_text')); ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_sku_text"><?php echo e(__('Sku Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_sku_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_sku_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_sku_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_description_text"><?php echo e(__('Description Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_description_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_description_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_description_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_attributes_text"><?php echo e(__('Attributes Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_attributes_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_attributes_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_attributes_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_ratings_text"><?php echo e(__('Ratings Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_ratings_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_ratings_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_ratings_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="product_single_<?php echo e($lang->slug); ?>_related_product_text"><?php echo e(__('Related Product Text')); ?></label>
                                            <input type="text" name="product_single_<?php echo e($lang->slug); ?>_related_product_text"  class="form-control" value="<?php echo e(get_static_option('product_single_'.$lang->slug.'_related_product_text')); ?>" id="product_single_<?php echo e($lang->slug); ?>_related_product_text">
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="product_single_related_products_status"><strong><?php echo e(__('Related Products Show/Hide')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="product_single_related_products_status"  <?php if(!empty(get_static_option('product_single_related_products_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="product_single_products_review_status"><strong><?php echo e(__('Review Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="product_single_products_review_status"  <?php if(!empty(get_static_option('product_single_products_review_status'))): ?> checked <?php endif; ?> >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/products/product-single-page-settings.blade.php ENDPATH**/ ?>