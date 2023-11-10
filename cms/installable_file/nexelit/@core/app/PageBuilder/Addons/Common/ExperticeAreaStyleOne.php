<?php


namespace App\PageBuilder\Addons\Common;


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

class ExperticeAreaStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'experties/style-01.png';
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

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['subtitle_' . $lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'experties_area_repeater_01',
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
                    'type' => RepeaterField::NUMBER,
                    'name' => 'percentage',
                    'label' => __('Percentage')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'percentage_text',
                    'label' => __('Percentage Text')
                ],
            ]
        ]);
        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'text-left' => __('left'),
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set section title alignment')
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
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
        $current_lang = LanguageHelper::user_lang_slug();
        $title = SanitizeInput::esc_html($all_settings['title_'.$current_lang]);
        $subtitle = SanitizeInput::esc_html($all_settings['subtitle_'.$current_lang]);
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $background_color = SanitizeInput::esc_html($all_settings['background_color']);
        $section_title_alignment = SanitizeInput::esc_html($all_settings['section_title_alignment']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';

        $output = '<div class="expertice-area dark-section-bg-three" data-padding-top="'.$padding_top.'" data-padding-bottom="'.$padding_bottom.'" '.$background_color.'>';

        $output .='<div class="container">';
        $output .= <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="section-title white text-center margin-bottom-60 {$section_title_alignment}">
            <span class="subtitle">{$subtitle}</span>
            <h2 class="title">{$title}</h2>
        </div>
    </div>
</div>
HTML;


        $output .= ' <div class="row">';
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
        return __('Experties Area: 01');
    }

    private function render_slider_markup(int $index = null): string
    {
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $subtitle = $this->get_repeater_field_value('subtitle', $index, LanguageHelper::user_lang_slug());
        $percentage_text = $this->get_repeater_field_value('percentage_text', $index, LanguageHelper::user_lang_slug());
        $percentage = $this->get_repeater_field_value('percentage', $index, LanguageHelper::user_lang_slug());
        return <<<HTML
 <div class="col-lg-4 col-md-6">
 
    <div class="single-expertice-area">
        <span class="number">{$percentage}{$percentage_text}</span>
        <h4 class="title">{$title}</h4>
        <span class="category">{$subtitle}</span>
    </div>
   
</div>
HTML;

    }


}