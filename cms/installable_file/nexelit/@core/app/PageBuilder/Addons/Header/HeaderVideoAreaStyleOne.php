<?php


namespace App\PageBuilder\Addons\Header;


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

class HeaderVideoAreaStyleOne extends PageBuilderBase
{
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'common/header-video-style-01.png';
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
                'label' => __('SubTitle'),
                'value' => $widget_saved_values['subtitle_' . $lang->slug] ?? null,
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
                'name' => 'button_one_text_'.$lang->slug,
                'label' => __('Button One Text'),
                'value' => $widget_saved_values['button_one_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_one_url_'.$lang->slug,
                'label' => __('Button One URL'),
                'value' => $widget_saved_values['button_one_url_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_two_text_'.$lang->slug,
                'label' => __('Button Two Text'),
                'value' => $widget_saved_values['button_two_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_two_url_'.$lang->slug,
                'label' => __('Button Two URL'),
                'value' => $widget_saved_values['button_two_url_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Text::get([
            'name' => 'video_url',
            'label' => __('Video URL'),
            'value' => $widget_saved_values['video_url'] ?? null,
            'placeholder' => 'https://www.youtube.com/watch?v=BsekcY04xvQ',
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 225,
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
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $subtitle = SanitizeInput::esc_html($all_settings['subtitle_'.$current_lang]);
        $title = SanitizeInput::esc_html($all_settings['title_'.$current_lang]);
        $description = SanitizeInput::esc_html($all_settings['description_'.$current_lang]);
        $button_one_text = SanitizeInput::esc_html($all_settings['button_one_text_'.$current_lang]);
        $button_two_text = SanitizeInput::esc_html($all_settings['button_two_text_'.$current_lang]);
        $button_one_url = $all_settings['button_one_url_'.$current_lang] ?? '';
        $button_two_url = $all_settings['button_two_url_'.$current_lang] ?? '';
        $video_url = SanitizeInput::esc_url($all_settings['video_url']);

        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);

        $button_markup = '';
        if (!empty($button_one_text) && !empty($button_one_url)){
            $button_markup .= ' <a href="'.$button_one_url.'" class="boxed-btn laywer">'.$button_one_text.'</a> ';
        }
        if (!empty($button_two_text) && !empty($button_two_url)){
            $button_markup .= ' <a href="'.$button_two_url.'" class="boxed-btn laywer blank">'.$button_two_text.'</a> ';
        }
        $random = random_int(9999,666666);
        return <<<HTML
<div class="header-slider-wrapper video-bg-area" id="section{$random}">
    <div class="header-area lawyer-home" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div  class="player bgvdoplayer" data-property="{videoURL:'{$video_url}',containment:'#section{$random}',autoPlay:true, mute:true,quality:'large', startAt:0, opacity:1}"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="header-inner">
                        <span class="subtitle">{$subtitle}</span>
                        <h1 class="title">{$title}</h1>
                        <p class="description">{$description}</p>
                        <div class="btn-wrapper margint-top-30">
                           {$button_markup}
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
        return __('Header Video Area: 01');
    }



}