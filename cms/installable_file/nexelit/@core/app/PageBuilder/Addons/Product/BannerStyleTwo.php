<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;

class BannerStyleTwo extends PageBuilderBase
{

    public function preview_image()
    {
       return 'product/banner-02.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'product_banner_two_repeater',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'subtitle',
                    'label' => __('Subtitle')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'button_text',
                    'label' => __('Button Text')
                ],

                [
                'type' => RepeaterField::TEXT,
                'name' => 'button_url',
                'label' => __('Button URL')
                 ],

               [
                'type' => RepeaterField::IMAGE,
                'name' => 'image',
                'label' => __('Image')
               ]
            ]
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
            'max' => 200,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $repeater_data = $settings['product_banner_two_repeater'] ?? [];

        $markup = '';
        foreach ($repeater_data['title_'] as $key=> $ti){
            $title = $ti ?? '';
            $subtitle = $repeater_data['subtitle_'][$key] ?? '';
            $button_text = $repeater_data['button_text_'][$key] ?? '';
            $button_url = $repeater_data['button_url_'][$key] ?? '';
            $image = render_image_markup_by_attachment_id($repeater_data['image_'][$key])  ?? null;


 $markup.= <<<ITEM
  <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
        <div class="single-updated radius-10">
            <div class="updated-image-contents">
                <div class="updated-flex-contents">
                    <div class="updated-img">
                      {$image}
                    </div>
                    <div class="updated-contents">
                        <span class="updated-top color-three fw-500"> {$title} </span>
                        <h2 class="updated-title"> <a href="javascript:void(0)">{$subtitle}</a> </h2>
                        <a href="{$button_url}" class="btn-buy icon btn-color-three"> {$button_text} </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
ITEM;
}

 return <<<HTML
   <section class="updated-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="$padding_bottom">
        <div class="container container-one">
            <div class="row mt-4 pt-1">
                {$markup}
            </div>
        </div>
    </section>
HTML;

}

    public function addon_title()
    {
        return __('Banner: 02');
    }
}