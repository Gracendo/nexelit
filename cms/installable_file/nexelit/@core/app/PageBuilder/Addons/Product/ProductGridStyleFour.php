<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\ProductRatings;
use App\Products;

class ProductGridStyleFour extends PageBuilderBase
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
       return 'product/grid-04.png';
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
               'name' => 'button_text_' .$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);
            $categories = Products::where(['lang' => $lang->slug,'status' => 'publish'])->get()->pluck('title','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'product_items_'.$lang->slug,
                'multiple' => true,
                'label' => __('Products'),
                'placeholder' =>  __('Select Product'),
                'options' => $categories,
                'value' => $widget_saved_values['product_items_' . $lang->slug] ?? null,
                'info' => __('you can select item for product, if you want to show all product leave it empty')
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
        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-4' => __('03 Column'),
                'col-lg-3' => __('04 Column'),
                'col-lg-6' => __('02 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);

        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Pagination Settings')
        ]);
        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Enable/Disable Pagination'),
            'value' => $widget_saved_values['pagination_status'] ?? null,
            'info' => __('your can show/hide pagination'),
        ]);
        $output .= Select::get([
            'name' => 'pagination_alignment',
            'label' => __('Pagination Alignment'),
            'options' => [
                'text-left' => __('Left'),
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
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
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $product_items = $settings['product_items_'.$current_lang] ?? [];
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $columns = SanitizeInput::esc_html($settings['columns']);


        $products = Products::query()->where(['lang' => $current_lang,'status' => 'publish']);
        /* category query */
        if (!empty($product_items)){
            $products->whereIn('id',$product_items);
        }
        if(!empty($items)){
            $all_products = $products->paginate($items);
        }else{
            $all_products =  $products->get();
        }
        if ($order_by === 'rating'){
            $products = $products->with('ratings')->get();
            $all_products = $products->sortByDesc(function ($products,$key){
                return $products->ratings()->avg('ratings');
            });
        }else{
            $products->orderBy($order_by,$order);
        }



        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$all_products->links().'</div></div>';
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

            $cart_icon_markup = '';


            if($item->stock_status == 'out_stock'){
                $cart_icon_markup = ' <div class="out_of_stock">'.__('Out Of Stock').'</div>';
            }else{
                if(!empty($item->variant) && count(json_decode($item->variant,true)) > 0) {
                    $cart_icon_markup = '<a href="' . route('frontend.products.single', $item->slug) . '" class="addtocart" data-product_id="' . $item->id . '" data-product_title="' . $item->title . '" data-product_quantity="1">
                    <i class="fa fa-eye" aria-hidden="true"></i>' . get_static_option('product_view_option_button_' . get_user_lang() . '_text', __('View Options')) . '</a>';
                }elseif($item->is_downloadable === 'on' && $item->direct_download === 1){
                    $cart_icon_markup = '<a href="'.route('frontend.products.single',$item->slug).'" class="addtocart" data-product_id="'.$item->id.'" data-product_title="'.$item->title.'" data-product_quantity="1">
                    <i class="fas fa-download"></i>'.get_static_option('product_download_now_button_'.get_user_lang().'_text').'</a>';
                }else{
                    $cart_icon_markup = '<a href="'.route('frontend.products.add.to.cart').'" class="addtocart ajax_add_to_cart" data-product_id="'.$item->id.'" data-product_title="'.$item->title.'" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    '.get_static_option('product_add_to_cart_button_'.get_user_lang().'_text').'</a>';
                }
            }
               
            $price_markup .= '</div>';

            $category_markup .= <<<HTML
<div class="{$columns} col-md-6">
    <div class="single-product-item-3 margin-bottom-30">
        <div class="thumb">
            <a href="{$route}">
                <div class="img-wrapper">
                    {$image_markup}
                </div>
            </a>
           {$badge_markup}
        </div>
        <div class="content">
            <a href="{$route}">
                <h4 class="title">{$title}</h4>
            </a>
            {$rating_markup}
            {$price_markup}
            {$cart_icon_markup}
        </div>
    </div>
</div>
HTML;
        }



        return <<<HTML
<div class="top-selling-product-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        <div class="row">
              {$category_markup}
              {$pagination_markup}
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
        return __('Product Grid: 04');
    }
}