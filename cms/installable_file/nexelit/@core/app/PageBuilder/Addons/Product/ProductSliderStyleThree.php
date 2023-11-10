<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\ProductRatings;
use App\Products;

class ProductSliderStyleThree extends PageBuilderBase
{


    public function enable() : bool
    {
        return (boolean) get_static_option('product_module_status');
    }

    public function preview_image()
    {
       return 'product/slider-03.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'section_subtitle_'.$lang->slug,
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['section_subtitle_' . $lang->slug] ?? null,
            ]);

            $products = Products::where(['lang' => $lang->slug,'status' => 'publish'])->get()->pluck('title','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'items_'.$lang->slug,
                'multiple' => true,
                'label' => __('Products'),
                'placeholder' =>  __('Select Products'),
                'options' => $products,
                'value' => $widget_saved_values['items_' . $lang->slug] ?? null,
                'info' => __('you can select item for products, if you want to show all product leave it empty')
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
                'sale_price' => __('Price'),
                'sales' => __('Sales'),
                'rating' => __('Ratings'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set category order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);
        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Items'),
            'value' => $widget_saved_values['slider_items'] ?? 4,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);

        $output .= Select::get([
            'name' => 'subtitle_status',
            'label' => __('Order By'),
            'options' => [
                '' => __('No'),
                'yes' => __('Yes'),
            ],
            'value' => $widget_saved_values['subtitle_status'] ?? null,
            'info' => __('You can set subtitle from this section')
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        // add padding option

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($settings['section_title_'.$current_lang]);
        $section_subtitle = SanitizeInput::esc_html($settings['section_subtitle_'.$current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $subtitle_status = SanitizeInput::esc_html($settings['subtitle_status']) ?? '';
        $product_items = $settings['items_'.$current_lang] ?? [];

        $sub = '<span class="hot-deal bg-color-three radius-5"> '.$section_subtitle.' </span>';
        $sub_con = $subtitle_status == 'yes' ? $sub : '';


        $products = Products::query();
        if (!empty($product_items)){
            $products->whereIn('id',$product_items);
        }
        $products->where(['lang' => $current_lang,'status' => 'publish']);

        if ($order_by === 'rating'){
            $products = $products->with('ratings')->get();
            $all_products = $products->sortByDesc(function ($products,$key){
                return $products->ratings()->avg('ratings');
            });
        }else{
            $products->orderBy($order_by,$order);
            $all_products =  $products->get();
        }

        if(!empty($items)){
            $all_products = $all_products->take($items);
        }
        $category_markup = '';
        $colors = ['bg-color-stock','bg-color-three'];
        foreach ($all_products as $key => $item){
            $route = route('frontend.products.single',$item->slug);
            $image_markup = render_image_markup_by_attachment_id($item->image,'','grid') ;
            $title = $item->title ;
            $badge_markup = !empty($item->badge) ? '<span class="percent-box '.$colors[$key % count($colors)].' radius-5">'.$item->badge.'</span>' : '';
            $rating_markup = '';

            $product_img = get_attachment_image_by_id($item->image,null,true);
            $img_url = $product_img['img_url'];

            if(count($item->ratings) > 0){
                $rating_markup .=' <div class="rating-wrap">
                    <div class="ratings">
                        <span class="hide-rating"></span>
                        <span class="show-rating" style="width: '. get_product_ratings_avg_by_id($item->id) / 5 * 100 .'%"></span>
                    </div>
                    <p><span class="total-ratings">('.count($item->ratings).')</span></p>
                </div>';
            }
            $price_markup = '<div class="price-update-through"><span class="fs-24 fw-500 ff-rubik flash-prices color-three">'. amount_with_currency_symbol($item->sale_price).'</span>';
            if(!empty($item->regular_price) && !empty(!get_static_option('display_price_only_for_logged_user'))){
                $price_markup .= '<del class="fs-18 flash-old-prices ff-rubik">'.amount_with_currency_symbol($item->regular_price).'</del>';
            }
            $price_markup .= '</div>';
            if ($item->stock_status === 'out_stock'){
                $cart_markup = '<div class="out_of_stock">'.__('Out Of Stock').'</div>';
            }else{
                if(!empty($item->variant) && count(json_decode($item->variant,true)) > 0) {
                  $cart_markup = ' <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top" title="Product Details">
                    <a class="icon today_deal_quick_view"
                       data-toggle="modal"
                       data-target="#quick_view"
                       data-id="'.$item->id.'"
                       data-title="'.$item->title.'"
                       data-short_description="'.$item->short_description.'"
                       data-regular_price="'.amount_with_currency_symbol($item->regular_price).'"
                       data-sale_price="'.amount_with_currency_symbol($item->sale_price).'"
                       data-in_stock="'.__(str_replace('_',' ', ucfirst($item->stock_status))).'"
                       data-category="'.optional($item->category)->title.'"
                       data-subcategory="'.optional($item->subcategory)->title.'"
                       data-image="'.$img_url.'"
                    >
                         <i class="fas fa-eye"></i>
                      </a>
                  </li>';


                }elseif($item->is_downloadable === 'on' && $item->direct_download === 1){
                    $cart_markup = '<a href="'.route('frontend.products.single',$item->slug).'" class="addtocart" data-product_id="'.$item->id.'" data-product_title="'.$item->title.'" data-product_quantity="1">
                    <i class="fas fa-download"></i>'.get_static_option('product_download_now_button_'.get_user_lang().'_text').'</a>';
                }else{
                    $cart_markup = ' <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top" title="Product Details">
                    <a class="icon addon_product_slider_quick_view"
                       data-toggle="modal"
                       data-target="#quick_view"
                       data-id="'.$item->id.'"
                       data-title="'.$item->title.'"
                       data-short_description="'.$item->short_description.'"
                       data-regular_price="'.amount_with_currency_symbol($item->regular_price).'"
                       data-sale_price="'.amount_with_currency_symbol($item->sale_price).'"
                       data-in_stock="'.str_replace('_',' ', ucfirst($item->stock_status)).'"
                       data-category="'.optional($item->category)->title.'"
                       data-subcategory="'.optional($item->subcategory)->title.'"
                       data-image="'.$img_url.'"
                    >
                         <i class="fas fa-eye"></i>
                      </a>
                  </li>
                  
                     <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="add to wishlist">
                        <a class="icon cart-loading ajax_add_to_wishlist_with_icon_addon_product_slider"
                           data-product_id="'.$item->id.'"
                           href="javascript:void(0)"> <i class="fas fa-heart"></i> </a>
                    </li>
                  
                   <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top" title="add to cart">
                        <a class="icon cart-loading ajax_add_to_cart_with_icon_product_slider_addon"
                           data-product_id="'.$item->id.'"
                           data-product_title="'.$item->title.'"
                           data-product_quantity="1"
                           href="javascript:void(0)">
                            <i class="fas fa-shopping-cart"></i> </a>
                    </li>
                  
                  
                  ';

                }
            }

 $category_markup .= <<<HTML
 <div class="slick-slider-items wow fadeInDown" data-wow-delay=".1s">
    <div class="global-card-item center-text border-1 no-shadow radius-10">
        <div class="global-card-thumb radius-10">
            <a href="{$route}">
                 {$image_markup}
             </a>
            <div class="thumb-top-contents">
               {$badge_markup}
            </div>
            <ul class="global-thumb-icons">
                {$cart_markup}
            </ul>
        </div>
        <div class="global-card-contents">
            <h4 class="common-title hover-color-three"> 
                  <a href="{$route}">{$title}</a>
             </h4>
            <div class="global-card-flex-contents">
                <div class="single-global-card">
                    <div class="global-card-right">
                         {$rating_markup}
                    </div>
                </div>
                <div class="single-global-card mt-2">
                    <div class="global-card-left">
                         $price_markup
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
        }

        $section_title_markup = '';
        if (!empty($section_title)){

            $subtitle_markup = '';
            if (!empty($section_subtitle)){
                $subtitle_markup = '<span class="subtitle">'.$section_subtitle.'</span>';
            }

$section_title_markup .= <<<HTML
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title-19 section-border-bottom">
                <div class="title-left">
                    <h2 class="title"> $section_title </h2>
                       {$sub_con}
                </div>
            </div>
        </div>
    </div>
HTML;

}

 return <<<HTML
    <section class="deal-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container container-one">
            {$section_title_markup}
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="global-slick-init deal-slider nav-style-one nav-color-three dot-style-one dot-color-three slider-inner-margin"
                        data-infinite="false" data-arrows="true" data-dots="false" data-slidesToShow="4"
                         data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
                        data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' 
                        data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' 
                        data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"arrows":false, "dots": true, "slidesToShow": 1}}]'>
                       {$category_markup}
                    </div>
                </div>
            </div>
        </div>
    </section>


HTML;

 }

    public function addon_title()
    {
        return __('Product Slider: 03');
    }

}