<?php


namespace App\PageBuilder\Addons\Header;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;

class HeaderAreaStyleFour extends \App\PageBuilder\PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
        return 'header-area-style-04.png';
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


        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'title_' . $lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= Textarea::get([
                'name' => 'description_' . $lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_' . $lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button Url'),
            'value' => $widget_saved_values['button_url'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '19200x1080'
        ]);
        $output .= Image::get([
            'name' => 'left_image',
            'label' => __('Left Image'),
            'value' => $widget_saved_values['left_image'] ?? null,
            'dimensions' => '830x1040'
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 325,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 320,
            'max' => 500,
        ]);
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

        $background_image = render_background_image_markup_by_attachment_id($settings['background_image']);
        $left_image = render_image_markup_by_attachment_id($settings['left_image']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_url = SanitizeInput::esc_url($settings['button_url']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        return <<<HTML
<div class="header-slider-wrapper">
<div class="header-area political-home" {$background_image} data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
            <div class="left-image-wrap">
               {$left_image}
            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title">{$title}</h1>
                            <p class="description">{$description}</p>
                            <div class="btn-wrapper margin-top-30">
                                <a href="{$button_url}" class="boxed-btn political">{$button_text}</a>
                            </div>
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
        return __('Header: 04');
    }
}