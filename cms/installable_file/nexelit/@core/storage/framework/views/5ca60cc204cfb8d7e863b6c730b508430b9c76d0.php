<div class="single-product-item-3 <?php if(isset($margin)): ?> margin-bottom-30 <?php endif; ?>">
    <div class="thumb">
        <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>">
            <div class="img-wrapper">
                <?php echo render_image_markup_by_attachment_id($product->image,'','grid'); ?>

            </div>
        </a>
        <?php if(!empty($product->badge)): ?>
            <span class="tag"><?php echo e($product->badge); ?></span>
        <?php endif; ?>
    </div>
    <div class="content">
        <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>">
            <h4 class="title"><?php echo e($product->title); ?></h4>
        </a>
        <?php if(count($product->ratings) > 0): ?>
            <div class="rating-wrap">
                <div class="ratings">
                    <span class="hide-rating"></span>
                    <span class="show-rating" style="width: <?php echo e(get_product_ratings_avg_by_id($product->id) / 5 * 100); ?>%"></span>
                </div>
                <p><span class="total-ratings">(<?php echo e(count($product->ratings)); ?>)</span></p>
            </div>
        <?php endif; ?>
        <?php if(!get_static_option('display_price_only_for_logged_user')): ?>
            <div class="price-wrap">
                <span class="price"><?php echo e($product->sale_price == 0 ? __('Free') : amount_with_currency_symbol($product->sale_price)); ?></span>
                <?php if(!empty($product->regular_price)): ?>
                    <del class="del-price"><?php echo e(amount_with_currency_symbol($product->regular_price)); ?></del>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if($product->stock_status == 'out_stock'): ?>
            <div class="out_of_stock"><?php echo e(__('Out Of Stock')); ?></div>
        <?php else: ?>
            <?php if(!empty($product->variant) && count(json_decode($product->variant,true)) > 0): ?>
                <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="addtocart" data-product_id="<?php echo e($product->id); ?>" data-product_title="<?php echo e($product->title); ?>" data-product_quantity="1">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    <?php echo e(get_static_option('product_view_option_button_'.$user_select_lang_slug.'_text',__('View Options'))); ?></a>
            <?php elseif($product->is_downloadable === 'on' && $product->direct_download === 1): ?>
                <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="addtocart" data-product_id="<?php echo e($product->id); ?>" data-product_title="<?php echo e($product->title); ?>" data-product_quantity="1">
                    <i class="fas fa-download"></i>
                    <?php echo e(get_static_option('product_download_now_button_'.$user_select_lang_slug.'_text')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('frontend.products.add.to.cart')); ?>" class="addtocart ajax_add_to_cart" data-product_id="<?php echo e($product->id); ?>" data-product_title="<?php echo e($product->title); ?>" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/product/grid.blade.php ENDPATH**/ ?>