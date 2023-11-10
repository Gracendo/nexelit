<?php


namespace App\PageBuilder\Addons\CtaArea;


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

class CallToActionStyleThree extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'cta-area/03.png';
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
            $output .= Textarea::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_url_'.$lang->slug,
                'label' => __('Button URL'),
                'value' => $widget_saved_values['button_url_' . $lang->slug] ?? null,
            ]);
            $output .= IconPicker::get([
                'name' => 'button_icon_'.$lang->slug,
                'label' => __('Button Icon'),
                'value' => $widget_saved_values['button_icon_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'right_image_'.$lang->slug,
                'label' => __('Right Image'),
                'value' => $widget_saved_values['right_image_' . $lang->slug] ?? null,
                'dimensions' => '780x560px'
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 150,
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

        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $right_image = SanitizeInput::esc_html($settings['right_image_'.$current_lang]);
        $button_url = SanitizeInput::esc_html($settings['button_url_'.$current_lang]);
        $button_icon = SanitizeInput::esc_html($settings['button_icon_'.$current_lang]);

        $button_markup = '';
        if (!empty($button_icon)){
            $button_markup .= '<i class="'.$button_icon.'"></i>';
        }
        $right_image_markup = '';
        if (!empty($right_image)){
            $right_image_markup = '<div class="right-image-area">'.render_image_markup_by_attachment_id($right_image).'</div>';
        }

        return <<<HTML
<div class="dagency-cta-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" >
    {$right_image_markup}
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cta-area-inner">
                        <div class="left-content-wrap">
                            <h2 class="title">{$title}</h2>
                            <p>{$description}</p>
                        </div>
                        <div class="right-content-wrap">
                            <div class="btn-wrapper margin-top-40">
                                <a href="{$button_url}" class="btn-dagency">{$button_text} {$button_markup}</a>
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
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('CTA Area: 03');
    }

}