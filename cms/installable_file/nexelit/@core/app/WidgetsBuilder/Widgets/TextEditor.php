<?php

namespace App\WidgetsBuilder\Widgets;

use App\Helpers\LanguageHelper;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Summernote;

class TextEditor extends \App\WidgetsBuilder\WidgetBase
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


        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

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
        $widget_saved_values = $this->get_settings();
        $description = $widget_saved_values['description_'.LanguageHelper::user_lang_slug()] ?? '';

        $output = $this->widget_before(); //render widget before content
        $output .='<div class="text-editor-content'.LanguageHelper::user_lang_slug().'">';
        $output .= purify_html_raw($description)  ;
        $output .= '</div>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
       return __('Text Editor');
    }
}