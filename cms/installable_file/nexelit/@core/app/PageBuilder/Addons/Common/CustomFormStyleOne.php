<?php


namespace App\PageBuilder\Addons\Common;


use App\FormBuilder;
use App\Helpers\FormBuilderCustom;
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

class CustomFormStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'common/custom-form-01.png';
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
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Select::get([
           'name' => 'custom_form_id',
           'label' => __('Custom Form'),
           'placeholder' => __('Select form'),
           'options' => FormBuilder::all()->pluck('title','id')->toArray(),
           'value' =>   $widget_saved_values['custom_form_id'] ?? []
        ]);
        $output .= Select::get([
            'name' => 'column',
            'label' => __('Column'),
            'options' => [
                'col-lg-6' => __('6 Column'),
                'col-lg-8' => __('8 Column'),
                'col-lg-10' => __('10 Column'),
                'col-lg-12' => __('12 Column'),
            ],
            'value' => $widget_saved_values['column'] ?? 'col-lg-8',
        ]);
        $output .= Select::get([
            'name' => 'title_alignment',
            'label' => __('Title Alignment'),
            'options' => [
                'text-left' => __('Left Align'),
                'text-center' => __('Center Align'),
                'text-right' => __('Right Align'),
            ],
            'value' => $widget_saved_values['title_alignment'] ?? null,
        ]);
        $output .= Select::get([
            'name' => 'button_alignment',
            'label' => __('Button Alignment'),
            'options' => [
                'button-left' => __('Left Align'),
                'button-center' => __('Center Align'),
                'button-right' => __('Right Align'),
            ],
            'value' => $widget_saved_values['button_alignment'] ?? null,
        ]);
        $output .= Select::get([
            'name' => 'button_width',
            'label' => __('Button Width'),
            'options' => [
                '' => __('Auto Width'),
                'd-block' => __('Full Width'),
            ],
            'value' => $widget_saved_values['button_width'] ?? null,
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 50,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 50,
            'max' => 200,
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
        $custom_form_id = SanitizeInput::esc_html($all_settings['custom_form_id']);
        $button_width = SanitizeInput::esc_html($all_settings['button_width']);
        $button_alignment = SanitizeInput::esc_html($all_settings['button_alignment']);
        $title_alignment = SanitizeInput::esc_html($all_settings['title_alignment']);
        $title = SanitizeInput::esc_html($all_settings['title_'.$current_lang]);
        $custom_form_markup = FormBuilderCustom::render_form($custom_form_id,null,null,'boxed-btn reverse-color '.$button_width,'contact-page-form');
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $column = SanitizeInput::esc_html($all_settings['column']);

        return <<<HTML
<div class="custom-form-builder-wrapper {$button_alignment}" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="{$column}">
                <div class="contact-info">
                    <div class="section-title {$title_alignment} margin-bottom-40">
                        <h4 class="title">{$title}</h4>
                    </div>
                    {$custom_form_markup}
               </div>
            </div>
        </div>
    </div>
</div>
HTML;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Custom Form: 01');
    }
}