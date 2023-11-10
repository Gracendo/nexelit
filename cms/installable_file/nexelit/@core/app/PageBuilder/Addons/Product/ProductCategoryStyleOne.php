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

class ProductCategoryStyleOne extends PageBuilderBase
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
       return 'product/category-01.png';
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
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set category order by')
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
            'info' => __('enter how many item you want to show in frontend'),
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
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);


        $product_category = ProductCategory::query()->where(['lang' => $current_lang,'status' => 'publish'])->orderBy($order_by,$order)->get();

        if(!empty($items)){
            $product_category = $product_category->take($items);
        }
        $category_markup = '';

        foreach ($product_category as $category){
            $route = route('frontend.products.category',['id' => $category->id,'any' => \Str::slug($category->title) ]);
            $image_markup = render_image_markup_by_attachment_id($category->image) ;
            $title = $category->title ;
            $category_markup .= <<<HTML
 <div class="single-product-cat-item">
    <div class="thumb">
        <a href="{$route}">
        {$image_markup}
        </a>
    </div>
    <h3 class="title"><a href="{$route}">{$title}</a></h3>
</div>
HTML;
        }

        $section_title_markup = '';
        if (!empty($section_title)){
            $section_title_markup .= <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="section-title desktop-center grocery-home margin-bottom-50">
            <h2 class="title">{$section_title}</h2>
        </div>
    </div>
</div>
HTML;

        }

        return <<<HTML
<div class="categories-area-wrap" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
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
        return __('Product Category: 01');
    }
}