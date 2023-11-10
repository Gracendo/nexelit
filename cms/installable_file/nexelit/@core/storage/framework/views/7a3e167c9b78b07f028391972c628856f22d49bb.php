<?php $__env->startSection('site-title'); ?>
    <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($product->meta_tags); ?>">
    <meta name="tags" content="<?php echo e($product->meta_description); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('og-meta'); ?>
    <meta property="og:url" content="<?php echo e(route('frontend.products.single',$product->slug)); ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php echo e($product->title); ?>"/>
    <?php echo render_og_meta_image_by_attachment_id($product->image); ?>

    <?php
        $post_img = null;
        $blog_image = get_attachment_image_by_id($product->image,"full",false);
        $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="product-content-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="single-product-details">
                        <div class="top-content">
                            <?php if(!empty($product->gallery)): ?>
                                <?php
                                    $product_gllery_images = !empty( $product->gallery) ? explode('|', $product->gallery) : [];
                                ?>
                                <div class="product-gallery">
                                    <div class="slider-gallery-slider">
                                        <?php $__currentLoopData = $product_gllery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gl_img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="single-gallery-slider-item">
                                                <?php echo render_image_markup_by_attachment_id($gl_img,'','large'); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="slider-gallery-nav">
                                        <?php $__currentLoopData = $product_gllery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gl_img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="single-gallery-slider-nav-item">
                                                <?php echo render_image_markup_by_attachment_id($gl_img,'','thumb'); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($product->image,'','large'); ?>

                                </div>
                            <?php endif; ?>
                            <div class="product-summery">
                                <?php if(count($product->ratings) > 0): ?>
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating"
                                                  style="width: <?php echo e($average_ratings / 5 * 100); ?>%"></span>
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
                                <div class="short-description">
                                    <p><?php echo e($product->short_description); ?></p>
                                </div>
                                    <div class="product-variant-list-wrapper-outer">
                                        <?php if($product->stock_status == 'out_stock'): ?>
                                            <div class="out_of_stock"><?php echo e(__('Out Of Stock')); ?></div>
                                        <?php else: ?>
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
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <div class="single-add-to-card-wrapper">

                                    <?php if($product->is_downloadable === 'on' && $product->direct_download === 1): ?>
                                        <form action="<?php echo e(route('frontend.product.download',$product->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <button class="addtocart" type="submit"> <i class="fas fa-download"></i>
                                                <?php echo e(get_static_option('product_download_now_button_'.$user_select_lang_slug.'_text')); ?></button>
                                        </form>
                                   <?php elseif($product->stock_status === 'in_stock'): ?>
                                        <form action="<?php echo e(route('frontend.products.add.to.cart')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="product_variants" >
                                            <input type="number" class="quantity" name="quantity" min="1" value="1">
                                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                            <button type="submit" class="addtocart product_variant_add_to_cart"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_add_to_cart_text')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="cat-sku-content-wrapper">
                                    <div class="category-wrap">
                                        <span class="title"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_category_text')); ?></span>
                                        <?php echo get_product_category_by_id($product->category_id,'link'); ?>

                                    </div>
                                    <div class="category-wrap">
                                        <span class="title"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_subcategory_text')); ?></span>
                                        <?php echo get_product_subcategory_by_id($product->subcategory_id,'link'); ?>

                                    </div>
                                    <?php if(!empty($product->sku)): ?>
                                        <div class="sku-wrap">
                                            <span class="title"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_sku_text')); ?></span>
                                            <span class="sku_"><?php echo e($product->sku); ?></span></div>
                                    <?php endif; ?>
                                    <div class="share-wrap">
                                       <ul class="social-icons">
                                           <li class="title"><?php echo e(__('Share')); ?>:</li>
                                           <?php echo single_post_share(route('frontend.blog.single',$product->slug),$product->title,$post_img); ?>

                                       </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <div class="extra-content-wrap">
                                <nav>
                                    <div class="nav nav-tabs" role="tablist">
                                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-description"
                                           role="tab"
                                           aria-selected="true"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_description_text')); ?></a>
                                        <?php
                                        $product_attributes_title = unserialize($product->attributes_title);
                                        ?>
                                        <?php if(!empty($product_attributes_title[0]) ): ?>
                                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-attributes"
                                               role="tab"
                                               aria-selected="false"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_attributes_text')); ?></a>
                                        <?php endif; ?>
                                        <?php if(!empty(get_static_option('product_single_related_products_status'))): ?>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-ratings" role="tab"
                                           aria-selected="false"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_ratings_text')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </nav>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel">
                                        <div class="product-description">
                                            <?php echo $product->description; ?>

                                        </div>
                                    </div>
                                    <?php if(!empty($product_attributes_title[0])): ?>
                                        <div class="tab-pane fade" id="nav-attributes" role="tabpanel">
                                            <?php
                                                $att_title = unserialize($product->attributes_title);
                                                $att_descr = unserialize($product->attributes_description);
                                            ?>
                                            <?php if(!empty($att_title)): ?>
                                                <div class="table-wrap table-responsive">
                                                    <table class="table table-bordered">
                                                        <?php $__currentLoopData = $att_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $att_title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <th><?php echo e($att_title); ?></th>
                                                                <td><?php echo e($att_descr[$key]); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </table>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty(get_static_option('product_single_related_products_status'))): ?>
                                    <div class="tab-pane fade" id="nav-ratings" role="tabpanel">
                                        <div class="product-rating">
                                            <div class="rating-wrap">
                                                <div class="ratings">
                                                    <span class="hide-rating"></span>
                                                    <span class="show-rating"
                                                          style="width: <?php echo e($average_ratings / 5 * 100); ?>%"></span>
                                                </div>
                                                <p><span class="total-ratings">(<?php echo e(count($product->ratings)); ?>)</span></p>
                                            </div>
                                            <?php if(count($product->ratings) > 0): ?>
                                                <ul class="product-rating-list">
                                                    <?php $__currentLoopData = $product->ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <div class="single-product-rating-item">
                                                                <div class="content">
                                                                    <h4 class="title"><?php echo e(get_user_name_by_id($rating->user_id) ? get_user_name_by_id($rating->user_id)->name : __('anonymous')); ?></h4>
                                                                    <div class="ratings text-warning">
                                                                        <?php echo render_ratings($rating->ratings); ?>

                                                                    </div>
                                                                    <p><?php echo e($rating->message); ?></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                            <div class="product-ratings-form">
                                                <?php if(auth()->check()): ?>
                                                    <h4 class="title"><?php echo e(__('Leave A Review')); ?></h4>
                                                    <?php if($errors->any()): ?>
                                                        <ul class="alert alert-danger">
                                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><?php echo e($error); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <form action="<?php echo e(route('product.ratings.store')); ?>" method="post"
                                                          enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                        <div class="form-group">
                                                            <label
                                                                for="rating-empty-clearable2"><?php echo e(__('Ratings')); ?></label>
                                                            <input type="number" name="ratings"
                                                                   id="rating-empty-clearable2"
                                                                   class="rating text-warning"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ratings_message"><?php echo e(__('Message')); ?></label>
                                                            <textarea name="ratings_message" class="form-control"
                                                                      id="ratings_message" cols="30" rows="5"
                                                                      placeholder="<?php echo e(__('Message')); ?>"></textarea>
                                                        </div>
                                                        <div class="btn-wrapper">
                                                            <button type="submit"
                                                                    class="btn-boxed style-01"><?php echo e(__('Submit')); ?></button>
                                                        </div>
                                                    </form>
                                                <?php else: ?>
                                                  <?php echo $__env->make('frontend.partials.ajax-login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(count($related_products) > 0 && !empty(get_static_option('product_single_related_products_status'))): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="related-product-area">
                            <h3 class="title"><?php echo e(get_static_option('product_single_'.$user_select_lang_slug.'_related_product_text')); ?></h3>
                            <div class="related-product-wrapper">
                                <div class="row">
                                    <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-3">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.product.grid','data' => ['product' => $data,'margin' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.product.grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'margin' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/frontend/js/bootstrap4-rating-input.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/toastr.min.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.ajax-login-form-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        (function ($) {
            "use strict";

            var rtlEnable = $('html').attr('dir');
            var sliderRtlValue = typeof rtlEnable === 'undefined' ||  rtlEnable === 'ltr' ? false : true ;

            $(document).ready(function () {
                $(document).on('click','.product_variant_add_to_cart',function (e){
                    e.preventDefault();
                    var variants = $('.product-variant-list').length;
                    var variantSelected = $('.product-variant-list li.selected').length;
                    $(this).parent().parent().find('p.text-danger').remove();
                    if(variants != variantSelected){
                        $(this).parent().parent().append('<p class="text-danger"><?php echo e(__('Select Product Variants')); ?></p>');
                    }else {
                        $(this).parent().trigger('submit');
                    }
                });

                $(document).on('click','.product-variant-list li',function (){
                    $(this).addClass('selected').siblings().removeClass('selected');
                    var price = $(this).data('price');
                    var termprice = $(this).data('termprice');
                    $('.single-product-details .top-content .price-wrap .price').text(termprice);
                    var allSelectedValue = $('.product-variant-list li.selected');
                    var variantVal = [];
                    $.each(allSelectedValue,function (index,value){
                        var elData = $(this).data();
                        variantVal.push({
                            'variantID' : elData.variantid,
                            'variantName' : elData.variantname,
                            'term' : elData.term,
                            'price' :  elData.price =! 'undefined' ? elData.price : '',
                        })
                    });

                    $('input[name="product_variants"]').val(JSON.stringify(variantVal));
                });


                $('.slider-gallery-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-gallery-nav',
                    rtl: sliderRtlValue
                });
                $('.slider-gallery-nav').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slider-gallery-slider',
                    dots: false,
                    arrows: false,
                    centerMode: false,
                    focusOnSelect: true,
                    rtl: sliderRtlValue
                });

            
            });

        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/products/product-single.blade.php ENDPATH**/ ?>