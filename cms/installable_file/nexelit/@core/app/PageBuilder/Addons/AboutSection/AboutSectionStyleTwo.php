<?php


namespace App\PageBuilder\Addons\AboutSection;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
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

class AboutSectionStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'about-section/02.png';
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
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'right_image_'.$lang->slug,
                'label' => __('Right Image'),
                'value' => $widget_saved_values['right_image_' . $lang->slug] ?? null,
                'dimensions' => '550x550px'
            ]);
            $output .= Text::get([
                'name' => 'video_icon_url_'.$lang->slug,
                'label' => __('Video URL'),
                'value' => $widget_saved_values['video_icon_url_' . $lang->slug] ?? null,
                'placeholder' => 'ex: https://www.youtube.com/watch?v=xud-u-HxFTo'
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


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
        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang]);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_url = SanitizeInput::esc_url($settings['button_url_'.$current_lang]);
        $button_icon = SanitizeInput::esc_html($settings['button_icon_'.$current_lang]);
        $description = SanitizeInput::kses_basic($settings['description_'.$current_lang]);
        $video_icon_url = SanitizeInput::esc_url($settings['video_icon_url_'.$current_lang]);
        $right_image = render_image_markup_by_attachment_id($settings['right_image_'.$current_lang],'','full');



        $button_markup = '';
        if (!empty($button_url) && !empty($button_text)){
            $button_icon = $button_icon ? ' <i class="'.$button_icon.'"></i>' : '';
            $button_markup .= ' <div class="btn-wrapper"><a href="'.$button_url.'" class="btn-charity reverse-color">'.$button_text.' '.$button_icon.'</a></div>';
        }
        $play_button = '';
        if (!empty($video_icon_url)){
            $play_button = ' <div class="vdo-btn"> <a href="'.$video_icon_url.'" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i> </a></div>';
        }

        $right_content_markup = '';
        if (!empty($right_image)){
            $right_content_markup = <<<HTML
 <div class="right-content-area">
    <div class="image-wrapper">
        {$right_image}
       {$play_button}
    </div>
</div>
HTML;
        }

        return <<<HTML
<div class="charity-about-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" >
       <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-area">
                    <span class="subtitle">{$subtitle}</span>
                    <h2 class="title">{$title}</h2>
                    <div class="description">$description</div>
                   {$button_markup}
                </div>
            </div>
            <div class="col-lg-6">
               {$right_content_markup}
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
        return __('About Area: 02');
    }

}