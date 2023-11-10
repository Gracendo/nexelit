    <?php if(!empty($product->variant)): ?>
        <?php $__currentLoopData = json_decode($product->variant); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $variant = get_product_variant_list_by_id($id);
            ?>
            <?php if(!empty($variant)): ?>
                <div class="product-variant-list-wrapper">
                    <h5 class="title"><?php echo e($variant->title); ?></h5>
                    <ul class="product-variant-list">
                        <?php
                            $prices = json_decode($variant->price);
                        ?>
                        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $v_term_index  = array_search($term,json_decode($variant->terms,true));
                            ?>
                            <li
                                    data-variantid="<?php echo e($id); ?>"
                                    data-variantname="<?php echo e($variant->title); ?>"
                                    data-term="<?php echo e($term); ?>"
                                    <?php if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index])): ?>
                                        data-price="<?php echo e($prices[$v_term_index]); ?>"
                                        data-termprice="<?php echo e(amount_with_currency_symbol($prices[$v_term_index] + $product->sale_price )); ?>"
                                    <?php else: ?>
                                        data-termprice="<?php echo e(amount_with_currency_symbol($product->sale_price)); ?>"
                                    <?php endif; ?>
                            >
                                <?php echo e($term); ?>

                                <?php if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index])): ?>
                                    <small>+ <?php echo e(amount_with_currency_symbol($prices[$v_term_index])); ?> </small>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/products/product-attribute-passing.blade.php ENDPATH**/ ?>