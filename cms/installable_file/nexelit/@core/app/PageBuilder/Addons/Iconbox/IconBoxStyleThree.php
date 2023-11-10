<?php


namespace App\PageBuilder\Addons\Iconbox;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class IconBoxStyleThree extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'icon-box/03.png';
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
            'id' => 'icon_style_three',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('Url')
                ],
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);
        $output .= Slider::get([
            'name' => 'margin_top_minus',
            'label' => __('Margin Top Minus'),
            'value' => $widget_saved_values['margin_top_minus'] ?? 0,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
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

        $settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $margin_top_minus = SanitizeInput::esc_html($settings['margin_top_minus']);


        $output = '<div class="logistics-key-feature-area" 
        data-padding-top="'.$padding_top.'" 
        data-padding-bottom="'.$padding_bottom.'" > 
        <div class="container">';

        $all_settings = $this->get_settings();
        $output .= '<div class="row">';
        $output .= '<div class="col-lg-12">';
        $output .= '<div class="lkey-feature-outer-warpp" data-margin-minus-top="'.$margin_top_minus.'"><ul class="lkey-features-list">';

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
        $output .= '</ul></div></div></div></div></div>';
        return $output;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Icon Box: 03');
    }

    private function render_slider_markup(int $index = null): string
    {
        $url = $this->get_repeater_field_value('url', $index, LanguageHelper::user_lang_slug());
        $icon = $this->get_repeater_field_value('icon', $index, LanguageHelper::user_lang_slug());
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());

        return <<<HTML
<li class="single-logistic-key-feature-one">
    <div class="icon">
        <i class="{$icon}"></i>
    </div>
    <div class="content">
        <h3 class="title"><a href="{$url}">{$title}</a></h3>
    </div>
</li>
HTML;

    }


}