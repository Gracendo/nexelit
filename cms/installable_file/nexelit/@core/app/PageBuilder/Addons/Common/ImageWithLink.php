<?php


namespace App\PageBuilder\Addons\Common;
use App\Brand;
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

class ImageWithLink extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'common/brand-logo-01.png';
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

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
            'info' => __('set title for button')
        ]);
        $output .= Text::get([
            'name' => 'link',
            'label' => __('Link'),
            'value' => $widget_saved_values['link'] ?? null,
            'info' => __('enter link'),
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
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';

        $brand_logos = Brand::query()->orderBy($order_by,$order)->get();

        if(!empty($items)){
            $brand_logos = $brand_logos->take($items);
        }
        $category_markup = '';

        foreach ($brand_logos as $logo){
            $image = render_image_markup_by_attachment_id($logo->image);
            $link_open = '';
            $link_close = '';
            if (!empty($logo->url)){
                $link_open .= '<a href="'.$logo->url.'">';
                $link_close .= '</a>';
            }
            $category_markup .= <<<HTML
 <div class="single-brand">
    <div class="img-wrapper">
        {$link_open}
        {$image}
        {$link_close}
    </div>
</div>
HTML;
        }


        return <<<HTML
<div class="brand-logo-carousel-area-wrapper" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}"  {$background_color}>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init logistic-dots"
                 data-loop="true"
                 data-desktopitem="{$slider_items}"
                 data-mobileitem="1"
                 data-tabletitem="2"
                 data-autoplay="true"
                 data-margin="80"
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
        return __('Image With Link: 01');
    }
}