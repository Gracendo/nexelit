<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('product_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-archive-top-content-area">
                                <div class="search-form">
                                    <input type="text" class="form-control" id="search_term" placeholder="<?php echo e(__('Search..')); ?>" value="<?php echo e($search_term); ?>">
                                    <button type="button" id="product_search_btn"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="product-sorting">
                                    <select id="product_sorting_select">
                                        <option value="default" <?php if($selected_order == '' || $selected_order == 'default'): ?> selected <?php endif; ?> ><?php echo e(__('Newest Product')); ?></option>
                                        <option value="old" <?php if($selected_order == 'old'): ?> selected <?php endif; ?> ><?php echo e(__('Oldest Product')); ?></option>
                                        <option value="high_low" <?php if($selected_order == 'high_low'): ?> selected <?php endif; ?> ><?php echo e(__('Highest To Lowest')); ?></option>
                                        <option value="low_high" <?php if($selected_order == 'low_high'): ?> selected <?php endif; ?> ><?php echo e(__('Lowest To Highest')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php if(count($all_products) > 0): ?>
                        <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6">
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
                        <?php else: ?>
                            <div class="col-lg-12">
                                <div class="alert alert-warning"><?php echo e(__('No Products Found')); ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12 text-center">
                            <nav class="pagination-wrapper product-page-pagination" aria-label="Page navigation ">
                                <?php echo e($all_products->links()); ?>

                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-1">
                    <div class="product-widget-area">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title"><?php echo e(get_static_option('product_category_'.$user_select_lang_slug.'_text')); ?></h4>
                            <ul class="product_category_list">
                                <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a  data-catid="<?php echo e($data->id); ?>" href="<?php echo e(route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title)])); ?>" <?php if($data->id == $selected_category): ?> class="active cat" <?php else: ?> class="cat" <?php endif; ?>><?php echo e($data->title); ?></a>
                                        <?php if(!empty($data->subcategory)): ?>
                                        <ul class="product_subcategory_list">
                                           <?php $__currentLoopData = $data->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <li>
                                                   <a data-catid="<?php echo e($sub_cat->id); ?>" href="<?php echo e(route('frontend.products.subcategory',['id' => $sub_cat->id,'any' => Str::slug($sub_cat->title)])); ?>" <?php if($sub_cat->id == $selected_subcategory): ?> class="active" <?php endif; ?>>  - <?php echo e($sub_cat->title); ?> </a>
                                               </li>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="widget widget_price_filter">
                            <h4 class="widget-title"><?php echo e(get_static_option('product_price_filter_'.$user_select_lang_slug.'_text')); ?></h4>
                            <div id="slider-range"></div>
                            <p><span class="min_filter_price"><?php echo e(amount_with_currency_symbol($min_price)); ?></span> <span class="max_filter_price"><?php echo e(amount_with_currency_symbol($max_price)); ?></span></p>
                            <button type="button" class="btn-boxed style-01" id="submit_price_filter_btn"><?php echo e(__("Apply Filter")); ?></button>
                        </div>
                        <div class="widget widget_rating_filter">
                            <h4 class="widget-title"><?php echo e(get_static_option('product_rating_filter_'.$user_select_lang_slug.'_text')); ?></h4>
                            <ul class="ratings_filter_list">
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_all" <?php if(empty($selected_rating)): ?> checked <?php endif; ?>  name="ratings_val" value="">
                                        <label class="filter-text" for="rating_bal_all"><?php echo e(__('Show All')); ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_04" <?php if($selected_rating == '4'): ?> checked <?php endif; ?> name="ratings_val" value="4">
                                        <label class="filter-text" for="rating_bal_04"><?php echo e(__('Upto 4 star')); ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_03" <?php if($selected_rating == '3'): ?> checked <?php endif; ?> name="ratings_val" value="3">
                                        <label class="filter-text" for="rating_bal_03"><?php echo e(__('Upto 3 star')); ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" name="ratings_val" <?php if($selected_rating == '2'): ?> checked <?php endif; ?> id="rating_bal_02" value="2">
                                        <label for="rating_bal_02" class="filter-text"><?php echo e(__('Upto 2 star')); ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" name="ratings_val" <?php if($selected_rating == '1'): ?> checked <?php endif; ?> id="rating_bal_01" value="1">
                                        <label class="filter-text" for="rating_bal_01"><?php echo e(__('Upto 1star')); ?></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="product_search_form" class="d-none"  action="<?php echo e(route('frontend.products')); ?>" method="get">
        <input type="hidden" id="search_query" name="q" value="<?php echo e($search_term); ?>">
        <input type="hidden" id="min_price" name="min_price" value="<?php echo e($min_price); ?>">
        <input type="hidden" id="max_price" name="max_price" value="<?php echo e($max_price); ?>">
        <input type="hidden" name="cat_id" id="category_id" value="<?php echo e($selected_category); ?>">
        <input type="hidden" name="subcat_id" id="subcategory_id" value="<?php echo e($selected_subcategory); ?>">
        <input type="hidden" name="orderby" id="orderby" value="<?php echo e($selected_order ? $selected_order : 'default'); ?>">
        <input type="hidden" name="rating" id="review" value="<?php echo e($selected_rating); ?>">
        <input type="hidden" name="page" value="<?php echo e($pages ?? 1); ?>">
        <button id="product_hidden_form_submit_button" type="submit"></button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function () {
            "use strict";

            //search form trigger
            $(document).on('click','#product_search_btn',function (e) {
                e.preventDefault();
                var searchTerms = $('#search_term').val();
                $('#search_query').val(searchTerms)
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('change','#product_sorting_select',function (e) {
                var sortVal = $('#product_sorting_select').val();
                $('#orderby').val(sortVal);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','.product_category_list > li a.cat',function (e) {
                e.preventDefault();
                var catID = $(this).data('catid');
                $('#category_id').val(catID);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','ul.product_subcategory_list > li a',function (e) {
                e.preventDefault();
                var catID = $(this).data('catid');
                $('#subcategory_id').val(catID);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('change','input[name="ratings_val"]',function (e) {
                e.preventDefault();
                $('#review').val($(this).val());
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','#submit_price_filter_btn',function (e) {
                e.preventDefault();
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: "<?php echo e($maximum_available_price); ?>",
                values: [ "<?php echo e($min_price); ?>", "<?php echo e($max_price); ?>" ],
                slide: function( event, ui ) {
                    var min_price = ui.values[ 0 ];
                    var max_price = ui.values[ 1 ];
                    var siteGlobalCurrency = "<?php echo e(site_currency_symbol()); ?>";
                    $('.min_filter_price').text(siteGlobalCurrency+min_price);
                    $('.max_filter_price').text(siteGlobalCurrency+max_price);
                    $('#min_price').val(min_price);
                    $('#max_price').val(max_price);
                }
            });
            /* product page pagination */
            $(document).on('click','.product-page-pagination .page-link',function (e){
                e.preventDefault();
                $('input[name="page"]').val($(this).text());
                $('#product_hidden_form_submit_button').trigger('click');
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/products/products.blade.php ENDPATH**/ ?>