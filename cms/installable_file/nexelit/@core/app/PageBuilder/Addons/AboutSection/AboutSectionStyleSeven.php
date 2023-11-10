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

class AboutSectionStyleSeven extends PageBuilderBase
{
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'about-section/07.png';
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
                'name' => 'left_image_'.$lang->slug,
                'label' => __('Left Image'),
                'value' => $widget_saved_values['left_image_' . $lang->slug] ?? null,
                'dimensions' => '450x380px'
            ]);
            $output .= Text::get([
                'name' => 'video_url_'.$lang->slug,
                'label' => __('Video URL'),
                'value' => $widget_saved_values['video_url_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'year_'.$lang->slug,
                'label' => __('Year Text'),
                'value' => $widget_saved_values['year_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'year_title_'.$lang->slug,
                'label' => __('Year Title'),
                'value' => $widget_saved_values['year_title_' . $lang->slug] ?? null,
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
        $video_url = SanitizeInput::esc_url($settings['video_url_'.$current_lang]);
        $year = SanitizeInput::esc_html($settings['year_'.$current_lang]);
        $year_title = SanitizeInput::esc_html($settings['year_title_'.$current_lang]);
        $left_image = render_image_markup_by_attachment_id($settings['left_image_'.$current_lang],'','full');

        $button_markup = '';
        if (!empty($button_url) && !empty($button_text)){
            $button_icon = $button_icon ? '<i class="'.$button_icon.'"></i>' : '';
            $button_markup .= ' <div class="btn-wrapper"><a href="'.$button_url.'" class="industry-btn const-home-color">'.$button_text.$button_icon.'</a></div>';
        }

        $left_content_markup = '';
        if (!empty($left_image)){
            $shape_url = asset('assets/frontend/img/shape/12.png');
            $vdo_image_btn = '';
            if (!empty($video_url)){
                $vdo_image_btn = '<a class="video-play mfp-iframe" href="'.$video_url.'"><i class="fas fa-play"></i></a>';
            }
            $experience_markup = '';
            if (!empty($year) && !empty($year_title)){
                $experience_markup = <<<HTML
 <div class="experience-wrap">
    <span class="year">{$year}</span>
    <h5 class="title">{$year_title}</h5>
</div>
HTML;
            }

            $left_content_markup = <<<HTML
<div class="left-content-area">
    <div class="shape">
        <img src="{$shape_url}" alt="">
    </div>
    <div class="construction-video-wrap">
        {$left_image}
        {$vdo_image_btn}
       {$experience_markup}
    </div>
</div>
HTML;
        }

        return <<<HTML
<div class="construction-about-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
       <div class="container">
        <div class="row">
            <div class="col-lg-6">
               {$left_content_markup}
            </div>
            <div class="col-lg-6">
                <div class="right-content-area">
                    <span class="subtitle">{$subtitle}</span>
                    <h2 class="title">{$title}</h2>
                    <div class="description">$description</div>
                   {$button_markup}
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
        return __('About Area: 07');
    }

}