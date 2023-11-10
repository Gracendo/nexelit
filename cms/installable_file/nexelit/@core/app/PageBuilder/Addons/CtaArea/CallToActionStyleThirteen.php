<?php


namespace App\PageBuilder\Addons\CtaArea;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class CallToActionStyleThirteen extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'cta-area/13.png';
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
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'signature_'.$lang->slug,
                'label' => __('Signature Image'),
                'value' => $widget_saved_values['signature_' . $lang->slug] ?? null,
            ]);
            $output .= Textarea::get([
                'name' => 'quote_text_'.$lang->slug,
                'label' => __('Quote Text'),
                'value' => $widget_saved_values['quote_text_' . $lang->slug] ?? null,
            ]);
           $output .= Image::get([
                'name' => 'left_image_'.$lang->slug,
                'label' => __('Left Image'),
                'value' => $widget_saved_values['left_image_' . $lang->slug] ?? null,
               'dimensions' => '960x760px'
            ]);
            $output .= Text::get([
                'name' => 'video_url_'.$lang->slug,
                'label' => __('Video URL'),
                'value' => $widget_saved_values['video_url_' . $lang->slug] ?? null,
                'placeholder' => 'https://www.youtube.com/watch?v=NfIlMOukA90'
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
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
            'value' => $widget_saved_values['padding_bottom'] ?? 120,
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
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.'"' : '';
        $left_image = render_background_image_markup_by_attachment_id($settings['left_image_'.$current_lang]);
        $signature = render_image_markup_by_attachment_id($settings['signature_'.$current_lang]);
        $video_url = SanitizeInput::esc_url($settings['video_url_'.$current_lang]);
        $quote_text = SanitizeInput::esc_html($settings['quote_text_'.$current_lang]);

        $video_button_markup = '';
        if (!empty($video_url)){
            $video_button_markup = <<<HTML
    <div class="vdo-btn">
        <a class="video-play-btn mfp-iframe" href="{$video_url}"><i class="fas fa-play"></i></a>
    </div>
HTML;

        }
        return <<<HTML
<div class="top-experience-area bg-blue" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-6">
               <div class="experience-right style-01" {$left_image}>
                    {$video_button_markup}
                </div>
            </div>
            <div class="col-lg-6">
               <div class="experience-content-02">
                    <h2 class="title">{$title}</h2>
                    <div class="description">{$description}</div>
                    <div class="sign-area">
                        <p>{$quote_text}</p>
                        <div class="sing-img padding-top-10">
                            {$signature}
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
        return __('CTA Area: 13');
    }

}