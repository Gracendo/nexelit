<?php


namespace App\PageBuilder\Addons\Common;


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

class VideoAreaStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'common/video-area-01.png';
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

        $output .= Text::get([
            'name' => 'video_url',
            'label' => __('Video URL'),
            'value' => $widget_saved_values['video_url'] ?? '',
            'placeholder' => 'https://www.youtube.com/watch?v=wernkluer',
        ]);
        $output .= Image::get([
            'name' => 'video_background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['video_background_image'] ?? '',
            'dimensions' => '1067×586px'
        ]);
        $output .= Image::get([
            'name' => 'video_bottom_shape_image',
            'label' => __('Bottom Shape Image'),
            'value' => $widget_saved_values['video_bottom_shape_image'] ?? '',
            'dimensions' => '150×250px'
        ]);
        $output .= Slider::get([
            'name' => 'margin_minus_bottom',
            'label' => __('margin Bottom Minus'),
            'value' => $widget_saved_values['margin_minus_bottom'] ?? 0,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
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
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $margin_minus_bottom = SanitizeInput::esc_html($settings['margin_minus_bottom']);
        $video_url = SanitizeInput::esc_html($settings['video_url']);
        $video_background_image = SanitizeInput::esc_html($settings['video_background_image']);
        $video_bottom_shape_image = SanitizeInput::esc_html($settings['video_bottom_shape_image']);

        $output = '<div class="logistic-video-area-wrap" data-padding-top="'.$padding_top.'" data-padding-bottom="'.$padding_bottom.'" data-margin-minus-bottom="'.$margin_minus_bottom.'"> <div class="container">';
        $output .= '<div class="row"><div class="col-lg-12">';
        $output .= '<div class="logistic-video-wrap">';
        $output .= render_image_markup_by_attachment_id($video_background_image,null,'full');
        $output .= '<a href="'.$video_url.'" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>';
        $output .= '<div class="shape">';
        $output .= render_image_markup_by_attachment_id($video_bottom_shape_image);
        $output .= '</div></div></div>';

        $output .= '</div></div></div>';
        return $output;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Video Area: 01');
    }

}