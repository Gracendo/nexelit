<?php


namespace App\PageBuilder\Addons\InfoBox;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
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

class InfoBoxStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'infobox/01.png';
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
            'id' => 'icon_style_four',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Description'),
                    'info' => __('it will be separate by new line')
                ],
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'column',
            'label' => __('Column'),
            'options' => [
                'col-lg-6' => __('2 Column'),
                'col-lg-4' => __('3 Column'),
                'col-lg-3' => __('4 Column')
            ],
            'value' => $widget_saved_values['column'] ?? null,
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


        $output = '<div class="contact-info-area-wrapper" 
        data-padding-top="'.$padding_top.'" 
        data-padding-bottom="'.$padding_bottom.'" >
        <div class="container">';

        $all_settings = $this->get_settings();
        $output .= '<div class="row">';

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
        $output .= '</div></div></div>';
        return $output;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Info Box: 01');
    }

    private function render_slider_markup(int $index = null): string
    {
        $settings = $this->get_settings();
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color: '.$background_color.'"' : '';
        $column = SanitizeInput::esc_html($settings['column']);


        $description = $this->get_repeater_field_value('description', $index, LanguageHelper::user_lang_slug());
        $icon = $this->get_repeater_field_value('icon', $index, LanguageHelper::user_lang_slug());
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $a = $index + 1;
        $description = explode("\n",$description);
        $desc_markup = '';
        foreach($description as $desc){
            $desc_markup .= '<p class="details">'.$desc.'</p>';
        }

        return <<<HTML
<div class="{$column} col-md-6 col-sm-6">
    <div class="single-contact-item margin-bottom-30" '.$background_color.'>
        <div class="icon style-0{$a}">
            <i class="{$icon}"></i>
        </div>
        <div class="content">
            <span class="title">{$title}</span>
            {$desc_markup}
        </div>
    </div>
</div>
HTML;

    }


}