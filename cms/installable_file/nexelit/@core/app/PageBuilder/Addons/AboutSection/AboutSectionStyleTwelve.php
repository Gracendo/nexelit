<?php


namespace App\PageBuilder\Addons\AboutSection;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class AboutSectionStyleTwelve extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'about-section/12.png';
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
            $output .= Text::get([
                'name' => 'video_url_'.$lang->slug,
                'label' => __('Video URL'),
                'value' => $widget_saved_values['video_url_' . $lang->slug] ?? null,
                'placeholder' => 'https://www.youtube.com/watch?v=TYDRQ-JxBgE'
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
            'dimensions' => '8300x470px'
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings'),
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
        ]);
        $output .= ColorPicker::get([
            'name' => 'title_color',
            'label' => __('Title Color'),
            'value' => $widget_saved_values['title_color'] ?? null,
        ]);
        $output .= Slider::get([
            'name' => 'margin_bottom_minus',
            'label' => __('Margin Bottom Minus'),
            'value' => $widget_saved_values['margin_bottom_minus'] ?? 0,
            'max' => 500,
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
        $margin_bottom_minus = SanitizeInput::esc_html($settings['margin_bottom_minus']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $video_url = SanitizeInput::esc_html($settings['video_url_'.$current_lang]);
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.'"' : '';

        $title_color = SanitizeInput::esc_html($settings['title_color']);
        $title_color = !empty($title_color) ? 'style="color:'.$title_color.'"' : '';

        $right_image = render_image_markup_by_attachment_id($settings['right_image'],'','full');

        $video_button_markup = '';
        if (!empty($video_button_markup)){
            $video_button_markup = <<<HTML
<div class="vdo-btn">
    <a class="video-play-btn mfp-iframe" href="{$video_url}"><i class="fas fa-play"></i></a>
</div>
HTML;
        }


        return <<<HTML
<div class="top-experience-area bg-blue" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color} data-margin-minus-bottom="{$margin_bottom_minus}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="experience-content">
                    <div class="content">
                        <h2 class="title" {$title_color}>{$title}</h2>
                    </div>
                    <div class="col-lg-09 offset-lg-3">
                        <div class="experience-right">
                            <div class="experience-img">
                                {$right_image}
                            </div>
                           {$video_button_markup}
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
        return __('About Area: 12');
    }

}