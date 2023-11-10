<?php


namespace App\PageBuilder\Addons\HeaderSlider;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class HeaderAreaStyleEighteen extends PageBuilderBase
{
    use RepeaterHelper;

    public function preview_image()
    {
        return 'header-area-style-18.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id'=> 'header-seventeen',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],[
                    'type' => RepeaterField::TEXT,
                    'name' => 'subtitle',
                    'label' => __('Subtitle'),
                    'info' => __(' use your desired color text like this {h}text{/h} ')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'button_text',
                    'label' => __('Button Text')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'button_url',
                    'label' => __('Button Url')
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image'),
                    'dimensions' => '1920x1080px'
                ],
            ]
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 225,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 220,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $output = '<div class="header-slider-wrapper global-carousel-init grocery-home" data-loop="true" data-desktopitem="1" data-mobileitem="1" data-tabletitem="1" data-dots="false" data-nav="true"  data-autoplay="true" data-stagepadding="0" data-margin="0">';
        $all_settings = $this->get_settings();

        $this->args['settings'] = RepeaterField::remove_default_fields($all_settings);
        foreach ($this->args['settings'] as $key => $setting){
            if (is_array($setting)){
                $this->args['repeater'] = $setting;
                $array_lang_item = $setting[array_key_last($setting)];
                if (!empty($array_lang_item) && is_array($array_lang_item) && count($array_lang_item) > 0) {
                    foreach ($array_lang_item as $index => $value) {

                        $output .= $this->render_slider_markup($index); // for multiple array index
                    }
                } else {
                    $output .= $this->render_slider_markup(); // for only one index of array
                }
            }
        }
        $output .= '</div>';
        return $output;
    }

    public function addon_title()
    {
        return __('Header Slider: 08');
    }

    private function render_slider_markup(int $index = null): string
    {
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $subtitle = $this->get_repeater_field_value('subtitle', $index, LanguageHelper::user_lang_slug());
        $subtitle_color_replace_text = str_replace('{',' ',$subtitle);

        $final_subtitle = '';
        if (str_contains($subtitle, '{h}') && str_contains($subtitle, '{/h}'))
        {
            $text = explode('{h}',$subtitle);
            $highlighted_word = explode('{/h}', $text[1])[0];

            $highlighted_text = '<span class="color-three">'. $highlighted_word .'</span>';
            $final_subtitle = '<a href="javascript:void(0)">'.str_replace('{h}'.$highlighted_word.'{/h}', $highlighted_text, $subtitle).'</a>';
        } else {
            $final_subtitle = '<a href="javascript:void(0)">'. $subtitle .'</h2>';
        }

        $button_text = $this->get_repeater_field_value('button_text', $index, LanguageHelper::user_lang_slug());
        $button_url = $this->get_repeater_field_value('button_url', $index, LanguageHelper::user_lang_slug());
        $image = render_image_markup_by_attachment_id($this->get_repeater_field_value('image', $index, LanguageHelper::user_lang_slug()));
        $button_markup = '';
        if (!empty($button_text) && !empty($button_url)) {
            $button_markup = '<div class="btn-wrapper mt-4 mt-lg-5"> <a href="' . $button_url . '" class="cmn-btn btn-bg-3">' . $button_text . '</a>  </div>';
        }
        $settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        return <<<HTML

    <div class="banner-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container container-one">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="banner-middle-content bg-item-one radius-10">
                        <div class="global-slick-init dot-style-one banner-dots dot-color-three dot-absolute" data-infinite="true" data-arrows="true" data-dots="true" data-autoplaySpeed="3000" data-autoplay="true">
                            <div class="banner-middle-image">
                                <div class="banner-single-thumb">
                                   {$image}
                                </div>
                                <div class="middle-content">
                                    <span class="middle-span fw-500 color-light"> {$title} </span>
                                    <h2 class="banner-middle-title fw-500 mt-3">
                                       {$final_subtitle}
                                    </h2>
                                       {$button_markup}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;

    }

}