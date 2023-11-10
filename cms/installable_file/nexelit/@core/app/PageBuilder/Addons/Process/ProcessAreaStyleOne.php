<?php


namespace App\PageBuilder\Addons\Process;


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

class ProcessAreaStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'process/style-01.png';
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
            'id' => 'process_area_style_01',
            'fields' => [
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
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? '',
            'dimensions' => '1920x610px'
        ]);
        $output .= Image::get([
            'name' => 'left_bottom_image',
            'label' => __('Left Bottom Image'),
            'value' => $widget_saved_values['left_bottom_image'] ?? '',
        ]);
        $output .= Image::get([
            'name' => 'right_bottom_image',
            'label' => __('Right Bottom Image'),
            'value' => $widget_saved_values['right_bottom_image'] ?? '',
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 120,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 150,
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
        $all_settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $background_image = SanitizeInput::esc_html($all_settings['background_image']);
        $left_bottom_image = SanitizeInput::esc_html($all_settings['left_bottom_image']);
        $right_bottom_image = SanitizeInput::esc_html($all_settings['right_bottom_image']);

        $output = '<div class="process-area-wrap" data-padding-top="'.$padding_top.'" data-padding-bottom="'.$padding_bottom.'" '.render_background_image_markup_by_attachment_id($background_image).'>';
        $output .= '<div class="right-image shape">'.render_image_markup_by_attachment_id($right_bottom_image).'</div>';
        $output .= '<div class="left-image shape">'.render_image_markup_by_attachment_id($left_bottom_image).'</div>';
        $output .='<div class="container"> <div class="row">';

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

        $output .= ' </div> </div></div>';
        return $output;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Process Area: 01');
    }

    private function render_slider_markup(int $index = null): string
    {
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $icon = $this->get_repeater_field_value('icon', $index, LanguageHelper::user_lang_slug());
        $description = $this->get_repeater_field_value('description', $index, LanguageHelper::user_lang_slug());
        $number = $index+1;
        return <<<HTML
 <div class="col-lg-4 col-md-6">
    <div class="single-process-item-fruit-home">
        <div class="icon">
            <i class="{$icon}"></i>
            <span class="number">{$number}</span>
        </div>
        <div class="content">
            <h4 class="title">{$title}</h4>
            <p>{$description}</p>
        </div>
    </div>
</div>
HTML;

    }


}