<?php

namespace App\WidgetsBuilder\Widgets;


use App\Language;
use App\Widgets;
use App\WidgetsBuilder\WidgetBase;

class ServiceQuoteWidget extends WidgetBase
{
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $image_val = $widget_saved_values['quote_bg'] ?? '';
        $image_preview = '';
        $image_field_label = __('Upload Image');
        if (!empty($widget_saved_values)) {
            $image_markup = render_image_markup_by_attachment_id($widget_saved_values['quote_bg']);
            $image_preview = '<div class="attachment-preview"><div class="thumbnail"><div class="centered">' . $image_markup . '</div></div></div>';
            $image_field_label = __('Change Image');
        }
        $output .= '<div class="form-group"><label for="quote_bg"><strong>' . __('Logo') . '</strong></label>';
        $output .= '<div class="media-upload-btn-wrapper"><div class="img-wrap">' . $image_preview . '</div><input type="hidden" name="quote_bg" value="' . $image_val . '">';
        $output .= '<button type="button" class="btn btn-info btn-xs media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">';
        $output .= $image_field_label . '</button></div>';
        $output .= '<small class="form-text text-muted">' . __('allowed image format: jpg,jpeg,png. Recommended image size 360x80 px') . '</small></div>';
        //start multi langual tab option

        //render language tab
        $title = $widget_saved_values['title'] ?? '';
        $output .= '<div class="form-group"><input name="title"  class="form-control" placeholder="' . __('Title') . '" value="' . purify_html($title) . '"></div>';
        $btn_text = $widget_saved_values['btn_text'] ?? '';
        $output .= '<div class="form-group"><input name="btn_text"  class="form-control" placeholder="' . __('Button Title') . '" value="' . purify_html($btn_text) . '"></div>';
        //end multi langual tab option

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();
        $title = $widget_saved_values['title'] ?? '';
        $btn_text = $widget_saved_values['btn_text'] ?? '';
        $image_val = $widget_saved_values['quote_bg'] ?? '';

        $output = '<div class="widget-nav-form">';
        $output .= '<div class="request-page-form-wrap bg-image-02"'.render_background_image_markup_by_attachment_id($image_val).'>';
        $output .= '<div class="section-title">';
        $output .= '<h4 class="title">'.purify_html($title).'</h4>';
        $output .= '</div>';
        $output .= '<form action="'.route('frontend.quote.message').'" method="POST" class="request-page-form style-02" enctype="multipart/form-data" id="quote_form">';
        $output .= '<input type="hidden" name="_token" value="'.csrf_token().'"/>';
        $output .= render_form_field_for_frontend(get_static_option('quote_page_form_fields'));
        $output .= '<input type="hidden" name="captcha_token" id="gcaptcha_token">';
        $output .= '<div class="form-group">';
        $output .= '<input type="submit" id="quote_submit_btn" value="'.purify_html($btn_text).'" class="submit-btn">';
        $output .= '</div>';
        $output .= '</form>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    public function widget_title(){
        return __('Service Page Quote');
    }

}