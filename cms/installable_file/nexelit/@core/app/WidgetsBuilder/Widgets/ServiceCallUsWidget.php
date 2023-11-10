<?php

namespace App\WidgetsBuilder\Widgets;


use App\Language;
use App\Widgets;
use App\WidgetsBuilder\WidgetBase;

class ServiceCallUsWidget extends WidgetBase
{
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $image_val = $widget_saved_values['call_us_bg'] ?? '';
        $image_preview = '';
        $image_field_label = __('Upload Image');
        if (!empty($widget_saved_values)) {
            $image_markup = render_image_markup_by_attachment_id($widget_saved_values['call_us_bg']);
            $image_preview = '<div class="attachment-preview"><div class="thumbnail"><div class="centered">' . $image_markup . '</div></div></div>';
            $image_field_label = __('Change Image');
        }

        $output .= '<div class="form-group"><label for="call_us_bg"><strong>' . __('Logo') . '</strong></label>';
        $output .= '<div class="media-upload-btn-wrapper"><div class="img-wrap">' . $image_preview . '</div><input type="hidden" name="call_us_bg" value="' . $image_val . '">';
        $output .= '<button type="button" class="btn btn-info btn-xs media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">';
        $output .= $image_field_label . '</button></div>';
        $output .= '<small class="form-text text-muted">' . __('allowed image format: jpg,jpeg,png. Recommended image size 360 X 83') . '</small></div>';
        //start multi langual tab option

        //render language tab
        $title = $widget_saved_values['title'] ?? '';
        $output .= '<div class="form-group"><input name="title"  class="form-control" placeholder="' . __('Title') . '" value="' . purify_html($title) . '"></div>';
        $details = $widget_saved_values['details'] ?? '';
        $output .= '<div class="form-group"><textarea name="details"  class="form-control" cols="30" rows="5" placeholder="' . __('Description') . '">' . purify_html($details) . '</textarea></div>';
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
        $details = $widget_saved_values['details'] ?? '';
        $image_val = $widget_saved_values['call_us_bg'] ?? '';
        $output = '<div class="widget-nav-contact margin-bottom-30">';
        $output .= '<div class="info-bar-item style-01 bg-green bg-image"'.render_background_image_markup_by_attachment_id($image_val).'>';
        $output .= '<div class="icon">';
        $output .= '<i class="flaticon-call"></i>';
        $output .= '</div>';
        $output .= '<div class="content">';
        $output .= '<span class="title">' . purify_html($title)  . '</span>';
        $output .= '<p class="details">' . purify_html($details)  . '</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    public function widget_title(){
        return __('Call Us Info');
    }

}