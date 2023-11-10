<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
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
use App\Works;
use App\WorksCategory;
use Illuminate\Support\Str;

class ProductMasornyOne extends PageBuilderBase
{
    public function preview_image()
    {
       return 'product/masorny-01.png';
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
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'button_url_'.$lang->slug,
                'label' => __('Button URL'),
                'value' => $widget_saved_values['button_url_'.$lang->slug] ?? null,
            ]);

            $categories = ProductCategory::where(['lang' => $lang->slug,'status' => 'publish'])->get()->pluck('title','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' =>  __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_' . $lang->slug] ?? null,
                'info' => __('you can select category for product, if you want to show all case study leave it empty')
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
            'info' => __('set order')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all'),
        ]);

        $output .= Number::get([
            'name' => 'category_items',
            'label' => __('Category Items'),
            'value' => $widget_saved_values['category_items'] ?? null,
            'info' => __('enter how many category item you want to show in frontend, leave it empty if you want to show all'),
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
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_url = SanitizeInput::esc_html($settings['button_url_'.$current_lang]);

        $categories = $settings['categories_'.$current_lang] ?? [];

        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $category_items = SanitizeInput::esc_html($settings['category_items']);

        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $all_store_area_categories = ProductCategory::where(['status' => 'publish','lang' => get_user_lang()]);

        if(!empty($category_items)){
           $all_store_area_categories = $all_store_area_categories->take($category_items)->get();
        }else{
            $all_store_area_categories = $all_store_area_categories->take(5)->get();
        }

        $category_markup = '';
        foreach($all_store_area_categories as $key => $cat){
            $active = $key == 0 ? 'active' : '';
            $category_markup.='<li data-catid="'.$cat->id.'" class="'.$active.' list" >'.$cat->title.'</li>';
        }


$masorny_js = view('frontend.partials.custom-js-for-page-builder-addon.product-masorny')->render();
$quick_view_js = view('components.frontend.product.quick-view-js')->render();
return <<<HTML
<section class="store-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> {$section_title} </h2>
                    </div>
                    <div class="product-list isootope-list mt-3">
                        <ul class="product-button isootope-button hover-color-three" id="store_area_category_item_section_by_ajax">
                            {$category_markup}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="imageloaded">
            <div class="row grid mt-4" id="store-area-append-container">
                <div class="col-lg-12 popular-category-preloader-wrap d-none">
                    <div class="preloader-wrap">
                        <i class="fas fa-spinner fa-spin fa-5x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="see_all_product_btn center-text mt-4 mt-lg-5">
                    <div class="btn-wrapper">
                        <a href="{$button_url}" class="cmn-btn btn-outline-three color-three"> {$button_text}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{$masorny_js}
$quick_view_js
HTML;


}

    private function quick_view_modal()
    {
        return <<<MODAL
    <div class="modal fade home-variant-19 quick_view_modal" id="quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="quick-view-close-btn-wrapper">
                <button class="quick-view-close-btn close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-view-wrap product-img">
                                    <ul class="other-content">
                                        <li>
                                            <span class="badge-tag image_category"></span>
                                        </li>
                                    </ul>
                                    <img src="" alt="" class="img_con">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="product-summery">
                                    <span class="product-meta pricing">
                                         <span id="unit">1</span> <span id="uom">Piece</span>
                                    </span>
                                    <h3 class="product-title title"></h3>
                                    <div>
                                        <span class="availability is_available text-success"></span>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price sale_price font-weight-bold"></span>
                                        <del class="del-price del_price regular_price"></del>
                                    </div>
                                    <div class="rating-wrap ratings" style="display: none">
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                    </div>
                                    <div class="short-description">
                                        <p class="info short_description"></p>
                                    </div>
                                    <div class="cart-option"><div class="user-select-option">
                                        </div>
                                        <div class="d-flex">
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" min="1" max="10000000" value="1" id="quantity_single_quick_view_btn">
                                            </div>
                                            <div class="btn-wrapper">
                                                <a href="#" data-attributes="[]"
                                                   class="btn-default rounded-btn add-cart-style-02 add_cart_from_quick_view ajax_add_to_cart"
                                                   data-product_id=""
                                                   data-product_title=""
                                                   data-product_quantity=""
                                                >
                                                   Add to cart
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <p class="name">Category: </p>
                                        <a href="" class="product_category"></a>
                                    </div>
                                    <div class="product-details-tag-and-social-link">
                                        <div class="tag d-flex">
                                            <p class="name">Subcategory :  </p>
                                            <div class="subcategory_container">
                                                <a href="" class="tag-btn product_subcategory" rel="tag"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

MODAL;
    }


    public function addon_title()
    {
        return __('Product Masonry: 01');
    }
}