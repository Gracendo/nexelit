<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\ProductRatings;
use App\Products;

class ProductSliderStyleOne extends PageBuilderBase
{


    public function enable() : bool
    {
        return (boolean) get_static_option('product_module_status');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'product/slider-01.png';
    }

    /**
     * @inheritDoc
     */
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
                'name' => 'section_subtitle_'.$lang->slug,
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['section_subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
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
            'value' => $widget_saved_values['slider_items'] ?? null,
            'info' => __('enter how many item you want to show in a row of slider'),
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

    /**
     * @inheritDoc
     */
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


        $products = Products::query()->where(['lang' => $current_lang,'status' => 'publish']);

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

        foreach ($all_products as $item){
            $route = route('frontend.products.single',$item->slug);
            $image_markup = render_image_markup_by_attachment_id($item->image,'','grid') ;
            $title = $item->title ;
            $badge_markup = !empty($item->badge) ? '<span class="tag">'.$item->badge.'</span>' : '';
            $rating_markup = '';
            if(count($item->ratings) > 0){
                $rating_markup .=' <div class="rating-wrap">
                    <div class="ratings">
                        <span class="hide-rating"></span>
                        <span class="show-rating" style="width: '. get_product_ratings_avg_by_id($item->id) / 5 * 100 .'%"></span>
                    </div>
                    <p><span class="total-ratings">('.count($item->ratings).')</span></p>
                </div>';
            }
            $price_markup = '<div class="price-wrap"><span class="price">'. amount_with_currency_symbol($item->sale_price).'</span>';
            if(!empty($item->regular_price) && !empty(!get_static_option('display_price_only_for_logged_user'))){
                $price_markup .= '<del class="del-price">'.amount_with_currency_symbol($item->regular_price).'</del>';
            }
            $price_markup .= '</div>';
            if ($item->stock_status === 'out_stock'){
                $cart_markup = '<div class="out_of_stock">'.__('Out Of Stock').'</div>';
            }else{
                if(!empty($item->variant) && count(json_decode($item->variant,true)) > 0) {
                    $cart_markup = '<a href="' . route('frontend.products.single', $item->slug) . '" class="addtocart" data-product_id="' . $item->id . '" data-product_title="' . $item->title . '" data-product_quantity="1">
                    <i class="fa fa-eye" aria-hidden="true"></i>' . get_static_option('product_view_option_button_' . get_user_lang() . '_text', __('View Options')) . '</a>';
                }elseif($item->is_downloadable === 'on' && $item->direct_download === 1){
                    $cart_markup = '<a href="'.route('frontend.products.single',$item->slug).'" class="addtocart" data-product_id="'.$item->id.'" data-product_title="'.$item->title.'" data-product_quantity="1">
                    <i class="fas fa-download"></i>'.get_static_option('product_download_now_button_'.get_user_lang().'_text').'</a>';
                }else{
                    $cart_markup = '<a href="'.route('frontend.products.add.to.cart').'" class="addtocart ajax_add_to_cart" data-product_id="'.$item->id.'" data-product_title="'.$item->title.'" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    '.get_static_option('product_add_to_cart_button_'.get_user_lang().'_text').'</a>';
                }
            }

            $category_markup .= <<<HTML
<div class="single-grocery-product-item">
    <div class="thumb">
        <a href="{$route}">
            <div class="img-wrapper">
                {$image_markup}
            </div>
        </a>
       {$badge_markup}
    </div>
    <div class="content">
        {$rating_markup}
        <a href="{$route}">
            <h4 class="title">{$title}</h4>
        </a>
       {$price_markup}
        {$cart_markup}
    </div>
</div>
HTML;
        }

        $section_title_markup = '';
        if (!empty($section_title)){
            $section_title_markup .= <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="section-title desktop-center margin-bottom-60 grocery-home">
            <span class="subtitle">{$section_subtitle}</span>
            <h2 class="title">{$section_title}</h2>
        </div>
    </div>
</div>
HTML;

        }

        return <<<HTML
<div class="feature-products-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-slider logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="{$slider_items}"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                {$category_markup}
                </div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __('Product Slider: 01');
    }
}