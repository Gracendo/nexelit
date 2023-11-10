<?php echo $__env->make('frontend.partials.homesupportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
?>
<div class="header-style-03  header-variant-<?php echo e($home_page_variant); ?>">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>
                </div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart-mobile','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-cart-mobile'); ?>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-search','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('navbar-search'); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product-cart'); ?>
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
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="header-slider-wrapper global-carousel-init grocery-home"
     data-loop="true"
     data-desktopitem="1"
     data-mobileitem="1"
     data-tabletitem="1"
     data-dots="true"
     data-autoplay="true"
     data-stagepadding="0"
     data-margin="0"
>
    <?php
        $all_bg_image_fields =  filter_static_option_value('grocery_home_page_header_section_bg_image',$static_field_data);
        $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields,['class' => false]) : [];
        $all_button_one_icon_fields =  filter_static_option_value('grocery_home_page_header_section_button_one_icon',$static_field_data);
        $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields,['class' => false]) : [];
        $all_button_one_url_fields =  filter_static_option_value('grocery_home_page_header_section_button_one_url',$static_field_data);
        $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields,['class' => false]) : [];
        $all_description_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
        $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
        $all_btn_one_text_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
        $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : [];
        $all_title_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
        $all_subtitle_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_subtitle',$static_field_data);
        $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
    ?>
    <?php $__currentLoopData = $all_bg_image_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="header-area grocery-home" <?php echo render_background_image_markup_by_attachment_id($image); ?>>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <span class="subtitle"><?php echo e($all_subtitle_fields[$loop->index] ?? ''); ?></span>
                            <h1 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h1>
                            <p class="description"><?php echo e($all_description_fields[$loop->index] ?? ''); ?></p>
                            <div class="btn-wrapper margin-top-30">
                                <?php if(isset($all_btn_one_text_fields[$loop->index])): ?>
                                    <a href="<?php echo e($all_button_one_url_fields[$loop->index] ?? ''); ?>"
                                       class="btn-dagency"><?php echo e($all_btn_one_text_fields[$loop->index] ?? ''); ?> <i
                                                class="<?php echo e($all_button_one_icon_fields[$loop->index] ?? ''); ?>"></i></a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(!empty(filter_static_option_value('home_page_product_category_section_status',$static_field_data))): ?>
<div class="categories-area-wrap padding-top-115 padding-bottom-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center grocery-home margin-bottom-50">
                    <h2 class="title"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_category_area_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-categories logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="4"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-product-cat-item">
                            <div class="thumb">
                                <a href="<?php echo e(route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title) ])); ?>">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                </a>
                            </div>
                            <h3 class="title"><a href="<?php echo e(route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title) ])); ?>"><?php echo e($data->title); ?></a></h3>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_offer_section_status',$static_field_data))): ?>
    <?php
        $all_icon_fields =  get_static_option('grocery_home_page_offer_item_button_url');
        $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false] ) : ['#'];
        $offer_item_image =  get_static_option('grocery_home_page_offer_item_image');
        $offer_item_image = !empty($offer_item_image) ? unserialize($offer_item_image,['class' => false] ) : ['#'];
    ?>
    <div class="offer-area-wrap padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-6">
                    <div class="offer-item-wrap">
                        <a href="<?php echo e($icon_field); ?>"><?php echo render_image_markup_by_attachment_id($offer_item_image[$loop->index] ?? ''); ?></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_featured_fruit_section_status',$static_field_data))): ?>
<div class="feature-products-area padding-bottom-120 padding-top-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 grocery-home">
                    <span class="subtitle"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_featured_product_area_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_featured_product_area_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-slider logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="4"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    <?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-grocery-product-item">
                            <div class="thumb">
                                <a href="<?php echo e(route('frontend.products.single',$data->slug)); ?>">
                                    <div class="img-wrapper">
                                        <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                    </div>
                                </a>
                                <?php if(!empty($data->badge)): ?>
                                    <span class="tag"><?php echo e($data->badge); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <?php if(count($data->ratings) > 0): ?>
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating" style="width: <?php echo e(get_product_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                        </div>
                                        <p><span class="total-ratings">(<?php echo e(count($data->ratings)); ?>)</span></p>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo e(route('frontend.products.single',$data->slug)); ?>">
                                    <h4 class="title"><?php echo e($data->title); ?></h4>
                                </a>
                                <div class="price-wrap">
                                    <span class="price"><?php echo e(amount_with_currency_symbol($data->sale_price)); ?></span>
                                    <?php if(!empty($data->regular_price)): ?><del class="del-price"><?php echo e(amount_with_currency_symbol($data->regular_price)); ?></del><?php endif; ?>
                                </div>
                                <?php if($data->stock_status == 'out_stock'): ?>
                                    <div class="out_of_stock"><?php echo e(__('Out Of Stock')); ?></div>
                                <?php else: ?>
                                    <a href="<?php echo e(route('frontend.products.add.to.cart')); ?>" class="addtocart ajax_add_to_cart" data-product_id="<?php echo e($data->id); ?>" data-product_title="<?php echo e($data->title); ?>" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_process_section_status',$static_field_data))): ?>
<div class="process-area-wrap padding-bottom-150 padding-top-120"
<?php echo render_background_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_background_image',$static_field_data)); ?>

>
    <div class="right-image shape">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_right_image',$static_field_data)); ?>

    </div>
    <div class="left-image shape">
        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_left_image',$static_field_data)); ?>

    </div>
    <div class="container">
        <div class="row">
            <?php
                $all_number_fields =  filter_static_option_value('grocery_home_page_process_area_item_number',$static_field_data);
                $all_number_fields = !empty($all_number_fields) ? unserialize($all_number_fields,['class' => false]) : [];
                $all_title_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_process_area_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                $all_description_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_process_area_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $process_area_item_icon = filter_static_option_value('grocery_home_page_process_area_item_icon',$static_field_data);
                $process_area_item_icon = !empty($process_area_item_icon) ? unserialize($process_area_item_icon,['class' => false]) : [];
            ?>
            <?php $__currentLoopData = $all_number_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-process-item-fruit-home">
                    <div class="icon">
                        <i class="<?php echo e($process_area_item_icon[$loop->index] ?? ''); ?>"></i>
                        <span class="number"><?php echo e($number); ?></span>
                    </div>
                    <div class="content">
                        <h4 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h4>
                        <p><?php echo e($all_description_fields[$loop->index] ?? ''); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_online_store_section_status',$static_field_data))): ?>
<div class="product-area-wrap padding-top-150 padding-bottom-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 grocery-home">
                    <span class="subtitle"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_section_subtitle',$static_field_data)); ?></span>
                    <h2 class="title"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_section_title',$static_field_data)); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $latest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="single-grocery-product-item">
                        <div class="thumb">
                            <a href="<?php echo e(route('frontend.products.single',$data->slug)); ?>">
                                <div class="img-wrapper">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                </div>
                            </a>
                            <?php if(!empty($data->badge)): ?>
                                <span class="tag"><?php echo e($data->badge); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if(count($data->ratings) > 0): ?>
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: <?php echo e(get_product_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                    </div>
                                    <p><span class="total-ratings">(<?php echo e(count($data->ratings)); ?>)</span></p>
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo e(route('frontend.products.single',$data->slug)); ?>">
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                            </a>
                            <div class="price-wrap">
                                <span class="price"><?php echo e(amount_with_currency_symbol($data->sale_price)); ?></span>
                                <?php if(!empty($data->regular_price)): ?><del class="del-price"><?php echo e(amount_with_currency_symbol($data->regular_price)); ?></del><?php endif; ?>
                            </div>
                            <?php if($data->stock_status == 'out_stock'): ?>
                                <div class="out_of_stock"><?php echo e(__('Out Of Stock')); ?></div>
                            <?php else: ?>
                                <a href="<?php echo e(route('frontend.products.add.to.cart')); ?>" class="addtocart ajax_add_to_cart" data-product_id="<?php echo e($data->id); ?>" data-product_title="<?php echo e($data->title); ?>" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="<?php echo e(route('frontend.products')); ?>" class="btn-dagency grocery-home"> <?php echo e(get_static_option('grocery_home_page_'.$user_select_lang_slug.'_product_section_button_text')); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data))): ?>
    <div class="fruits-testimonial-area padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 grocery-home">
                        <span class="subtitle"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_testimonial_area_subtitle',$static_field_data)); ?></span>
                        <h2 class="title"><?php echo e(filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots grocery-home"
                             data-loop="true"
                             data-desktopitem="2"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="fruits-home-single-testimonial-item">
                                    <div class="author-details">
                                        <div class="thumb ">
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                        </div>
                                        <div class="content">
                                            <h4 class="title "><?php echo e($data->name); ?></h4>
                                            <span class="designation "><?php echo e($data->designation); ?></span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="description "><?php echo e($data->description); ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data))): ?>
    <div class="client-section padding-bottom-70 padding-top-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            <?php $__currentLoopData = $all_brand_logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        <?php if(!empty($data->url) ): ?><a href="<?php echo e($data->url); ?>" rel="canonical"><?php endif; ?>
                                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                            <?php if(!empty($data->url) ): ?>  </a><?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo e(asset('assets/frontend/js/toastr.min.js')); ?>"></script>
    <script>
        (function () {
            "use strict";

            $(document).on('click','.ajax_add_to_cart',function (e) {
                e.preventDefault();
                var allData = $(this).data();
                var el = $(this);
                $.ajax({
                    url : "<?php echo e(route('frontend.products.add.to.cart.ajax')); ?>",
                    type: "POST",
                    data: {
                        _token : "<?php echo e(csrf_token()); ?>",
                        'product_id' : allData.product_id,
                        'quantity' : allData.product_quantity,
                    },
                    beforeSend: function(){
                        el.text("<?php echo e(__('Adding')); ?>");
                    },
                    success: function (data) {
                        el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"<?php echo e(get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')); ?>");
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success(data.msg);
                        $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount,.mobile-cart a .pcount').text(data.total_cart_item);
                    }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/home-pages/home-18.blade.php ENDPATH**/ ?>