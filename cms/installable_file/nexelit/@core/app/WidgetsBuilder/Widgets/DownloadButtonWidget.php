<?php

namespace App\WidgetsBuilder\Widgets;

use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\ProductCategory;
use App\Testimonial;
use App\WidgetsBuilder\WidgetBase;

class DownloadButtonWidget extends WidgetBase
{


    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'button_title',
            'label' => __('Button Title'),
            'value' => $widget_saved_values['button_title'] ?? null,
            'info' => __('enter button title'),
        ]);
        $output .= Text::get([
            'name' => 'button_link',
            'label' => __('Button Link'),
            'value' => $widget_saved_values['button_link'] ?? null,
            'info' => __('enter button link'),
        ]);
        
        // add padding option

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
        $button_title = SanitizeInput::esc_html($settings['button_title']);
        $button_link = SanitizeInput::esc_html($settings['button_link']);



        return <<<HTML
<div class="download-button-area-wrap">
    <div class="btn-wrapper">
        <a href="{$button_link}" download class="boxed-btn">{$button_title}</a>
    </div>
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        return __('Download Widgets: 01');
    }
}