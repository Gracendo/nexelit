<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Order View')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <div class="product-orders-summery-warp">
                            <div class="extra-data">
                                <ul>
                                    <li><strong><?php echo e(__('Order ID: ')); ?></strong> <?php echo e('#'.$order_details->id); ?></li>
                                    <li><strong><?php echo e(__('Shipping Method:')); ?></strong> <?php echo e(get_shipping_name_by_id($order_details->product_shippings_id)); ?></li>
                                    <li><strong><?php echo e(__('Payment Method:')); ?></strong> <?php echo e(str_replace('_',' ', ucfirst($order_details->payment_gateway))); ?></li>
                                    <li><strong><?php echo e(__('Payment Status:')); ?></strong> <?php echo e(__($order_details->payment_status)); ?></li>
                                    <li><strong><?php echo e(__('Order Status:')); ?></strong> <?php echo e(__($order_details->status)); ?></li>
                                </ul>
                            </div>
                            <div class="billing-and-shipping-details">
                                <div class="billing-wrap">
                                    <h4 class="title"><?php echo e(__('Billing Details')); ?></h4>
                                    <ul>
                                        <li><strong><?php echo e(__('Name')); ?></strong> <?php echo e($order_details->billing_name); ?></li>
                                        <li><strong><?php echo e(__('Email')); ?></strong> <?php echo e($order_details->billing_email); ?></li>
                                        <li><strong><?php echo e(__('Phone')); ?></strong> <?php echo e($order_details->billing_phone); ?></li>
                                        <li><strong><?php echo e(__('Country')); ?></strong> <?php echo e($order_details->billing_country); ?></li>
                                        <li><strong><?php echo e(__('Street Address')); ?></strong> <?php echo e($order_details->billing_street_address); ?></li>
                                        <li><strong><?php echo e(__('District')); ?></strong> <?php echo e($order_details->billing_district); ?></li>
                                        <li><strong><?php echo e(__('Town')); ?></strong> <?php echo e($order_details->billing_town); ?></li>
                                    </ul>
                                </div>
                                <?php if($order_details->different_shipping_address == 'yes'): ?>
                                    <div class="billing-wrap">
                                        <h4 class="title"><?php echo e(__('Shipping Details')); ?></h4>
                                        <ul>
                                            <li><strong><?php echo e(__('Name')); ?></strong> <?php echo e($order_details->shipping_name); ?></li>
                                            <li><strong><?php echo e(__('Email')); ?></strong> <?php echo e($order_details->shipping_email); ?></li>
                                            <li><strong><?php echo e(__('Phone')); ?></strong> <?php echo e($order_details->shipping_phone); ?></li>
                                            <li><strong><?php echo e(__('Country')); ?></strong> <?php echo e($order_details->shipping_country); ?></li>
                                            <li><strong><?php echo e(__('Street Address')); ?></strong> <?php echo e($order_details->shipping_street_address); ?></li>
                                            <li><strong><?php echo e(__('District')); ?></strong> <?php echo e($order_details->shipping_district); ?></li>
                                            <li><strong><?php echo e(__('Town')); ?></strong> <?php echo e($order_details->shipping_town); ?></li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php $cart_items = unserialize($order_details->cart_items); ?>
                            <h4 class="title"><?php echo e(__('Order Summery')); ?></h4>
                            <div class="cart-total-table-wrap">
                                <div class="cart-total-table table-responsive text-left">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong><?php echo e(__('Subtotal')); ?></strong></td>
                                            <td><?php echo e(amount_with_currency_symbol($order_details->subtotal)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo e(__('Coupon Discount')); ?></strong></td>
                                            <td>- <?php echo e(amount_with_currency_symbol($order_details->coupon_discount)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo e(__('Shipping Cost')); ?></strong></td>
                                            <td>+ <?php echo e(amount_with_currency_symbol($order_details->shipping_cost)); ?></td>
                                        </tr>
                                        <?php if(\App\Facades\Cart::is_tax_enable() && get_static_option('product_tax_type') === 'individual'): ?>
                                            <?php $tax_percentage = get_static_option('product_tax_type') === 'total' ? '('.get_static_option('product_tax_percentage').')' : '';  ?>
                                            <tr>
                                                <td><strong><?php echo e(__('Tax')); ?> <?php echo e($tax_percentage); ?></strong></td>
                                                <td>+ <?php echo e(amount_with_currency_symbol(\App\Facades\Cart::cart_tax_for_mail_template($cart_items,$order_details))); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td><strong><?php echo e(__('Total')); ?></strong></td>
                                            <td><?php echo e(amount_with_currency_symbol($order_details->total)); ?></td>
                                        </tr>
                                    </table>
                                    <?php if(get_static_option('product_tax') && get_static_option('product_tax_system') == 'inclusive'): ?>
                                        <p class="tax-info"><?php echo e(__('Inclusive of custom duties and taxes where applicable')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="ordered-product-summery margin-top-30">
                            <h4 class="title"><?php echo e(__('Ordered Products')); ?></h4>
                            <table class="table table-bordered order-view-table">
                                <thead>
                                <th><?php echo e(__('Thumbnail')); ?></th>
                                <th><?php echo e(__('Product Info')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $product_info = \App\Products::find($item['id']);?>
                                    <tr>
                                        <td>
                                            <div class="product-thumbnail">
                                                <?php echo render_image_markup_by_attachment_id($product_info->image,'','thumb'); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info-wrap">
                                                <h4 class="product-title">
                                                    <a href="<?php echo e(route('frontend.products.single',$product_info->slug)); ?>"><?php echo e($product_info->title); ?></a>
                                                <?php if(!empty($item['variant'])): ?>
                                                    <?php $__currentLoopData = json_decode($item['variant']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <?php
                                                            $variant = get_product_variant_list_by_id($variants->variantID);
                                                       ?>
                                                        <?php if(!empty($variant)): ?>
                                                        <?php
                                                          $index = array_search($variants->term, json_decode($variant->terms,true));
                                                           $prices = json_decode($variant->price) ?? [];
                                                           $terms = json_decode($variant->terms) ?? [];
                                                       ?>
                                                        <ul class="product-variant-list">
                                                            <li>
                                                                <?php echo e($terms[$index] ?? ''); ?>

                                                                <?php if(isset($prices[$index]) && !empty($prices[$index])): ?>
                                                                <small> +<?php echo e(amount_with_currency_symbol($prices[$index])); ?></small>
                                                                <?php endif; ?>
                                                               </li>
                                                            </ul>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </h4>


                                                <span class="pdetails"><strong><?php echo e(__('Price :')); ?></strong> <?php echo e(amount_with_currency_symbol($product_info->sale_price)); ?></span>
                                                <span class="pdetails"><strong><?php echo e(__('Quantity :')); ?></strong> <?php echo e($item['quantity']); ?></span>
                                                <?php $tax_amount = 0; ?>
                                                <?php if(get_static_option('product_tax_type') === 'individual' && is_tax_enable()): ?>
                                                    <?php
                                                        $percentage = !empty($product_info->tax_percentage) ? $product_info->tax_percentage : 0;
                                                        $tax_amount = ($product_info->sale_price * $item['quantity']) / 100 * $product_info->tax_percentage;
                                                    ?>
                                                    <span class="pdetails" style="color: red"><strong><?php echo e(__('Tax')); ?> <?php echo e('('.$percentage.'%) :'); ?></strong> +<?php echo e(amount_with_currency_symbol($tax_amount)); ?></span>
                                                <?php endif; ?>
                                                <span class="pdetails"><strong><?php echo e(__('Subtotal :')); ?></strong> <?php echo e(amount_with_currency_symbol($product_info->sale_price * $item['quantity'] + $tax_amount )); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-wrapper">
                            <?php if(auth()->guard('web')->check()): ?>
                                <a href="<?php echo e(route('user.home')); ?>" class="boxed-btn"><?php echo e(__('Go To Dashboard')); ?></a>
                            <?php else: ?>
                                <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/user/dashboard/product-order-view.blade.php ENDPATH**/ ?>