<?php if(!empty(get_static_option('product_module_status'))): ?>
    <div class="mobile-cart">
        <a href="<?php echo e(route('frontend.products.cart')); ?>">
            <i class="flaticon-shopping-cart"></i>
            <span class="pcount"><?php echo e(\App\Facades\Cart::count()); ?></span>
        </a>
    </div>

<?php endif; ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/beta/@core/resources/views/components/product-cart-mobile.blade.php ENDPATH**/ ?>