<?php


namespace App\PageBuilder\Addons\HeaderSlider;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class HeaderAreaStyleEleven extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'header-area-style-11.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'header_eleven',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'subtitle',
                    'label' => __('Subtitle')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Description')
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
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'button_icon',
                    'label' => __('Button Icon')
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'right_image',
                    'label' => __('Right Image'),
                    'dimensions' => '990x690px'
                ],
            ]
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 90,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 200,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
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

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Header Slider: 02');
    }

    private function render_slider_markup(int $index = null): string
    {
        $settings = $this->get_settings();
        $subtitle = $this->get_repeater_field_value('subtitle', $index, LanguageHelper::user_lang_slug());
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $description = $this->get_repeater_field_value('description', $index, LanguageHelper::user_lang_slug());
        $button_text = $this->get_repeater_field_value('button_text', $index, LanguageHelper::user_lang_slug());
        $button_url = $this->get_repeater_field_value('button_url', $index, LanguageHelper::user_lang_slug());
        $button_icon = $this->get_repeater_field_value('button_icon', $index, LanguageHelper::user_lang_slug());
        $background_image = render_image_markup_by_attachment_id($this->get_repeater_field_value('right_image', $index, LanguageHelper::user_lang_slug()));
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $button_markup = '';
        if (!empty($button_text) && !empty($button_url)){
            $icon_markup = !empty($button_icon) ? '<i class="'.$button_icon.'"></i>' : '';
            $button_markup = '<div class="btn-wrapper margin-top-30">  <a href="'.$button_url.'" class="btn-charity">'.$button_text.' '.$icon_markup.'</a> </div>';
        }
        return <<<HTML
 <div class="header-area charity-home"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="right-image-wrap">
       {$background_image}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-inner">
                    <span class="subtitle">{$subtitle}</span>
                    <h1 class="title">{$title}</h1>
                    <p class="description">{$description}</p>
                    {$button_markup}
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-image-shape">
        <img src="https://xgenious.com/laravel/nexelit/assets/frontend/img/shape/charity-header-bottom-shape.svg"
             alt="header bottom image shape">
    </div>
</div>
HTML;

    }


}