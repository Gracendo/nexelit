<?php


namespace App\PageBuilder\Addons\Testimonial;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\Testimonial;

class TestimonialStyleThirteen extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'testimonial/style-13.png';
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
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Item'),
            'value' => $widget_saved_values['slider_items'] ?? 1,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 500,
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
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';

        $testimonial = Testimonial::query()->where(['lang' => $current_lang,'status' => 'publish'])->orderBy($order_by,$order)->get();

        if(!empty($items)){
            $testimonial = $testimonial->take($items);
        }
        $category_markup = '';

        foreach ($testimonial as $testi){
            $image = render_image_markup_by_attachment_id($testi->image);
            $name = $testi->name;
            $designation = $testi->designation;
            $description = $testi->description;

            $category_markup .= <<<HTML
<div class="single-testimonial-item-03">
    <div class="content">
        <p class="description"> {$description}</p>
        <div class="author-details">
            <div class="author-meta">
                <h4 class="title">{$name}</h4>
                <span class="designation">{$designation}</span>
            </div>
        </div>
    </div>
    <div class="author-img">
        <div class="thumb">
            {$image}
        </div>
    </div>
</div>
HTML;
        }


        return <<<HTML
<div class="testimonial-area bg-blue-deep" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
<div class="icon-03">
    <i class="flaticon-right-quote-1"></i>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel-area margin-top-10">
                    <div class="global-carousel-init logistic-dots "
                         data-loop="true"
                         data-desktopitem="{$slider_items}"
                         data-mobileitem="1"
                         data-tabletitem="1"
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
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __('Testimonial: 13');
    }
}