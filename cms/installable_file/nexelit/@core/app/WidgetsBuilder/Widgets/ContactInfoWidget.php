<?php

namespace App\WidgetsBuilder\Widgets;
use App\Helpers\LanguageHelper;
use App\Language;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\WidgetsBuilder\WidgetBase;

class ContactInfoWidget extends WidgetBase
{

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
                'name' => 'widget_title_'.$lang->slug,
                'label' => __('Widget Title'),
                'value' => $widget_saved_values['widget_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Textarea::get([
            'name' => 'location',
            'label' => __('Location'),
            'value' => $widget_saved_values['location'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'phone',
            'label' => __('Phone'),
            'value' => $widget_saved_values['phone'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'email',
            'label' => __('Email'),
            'value' => $widget_saved_values['email'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        // TODO: Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();
        $widget_title =  $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';
        $location =  $widget_saved_values['location'] ?? '';
        $phone =  $widget_saved_values['phone'] ?? '';
        $email = $widget_saved_values['email'] ?? '';


        $output = $this->widget_before(); //render widget before content

        $output.= '<div class="sidebars-single-content">'; //render widget before content

        if (!empty($widget_title)){
            $output .= '<h4 class="widget-title">'.purify_html($widget_title).'</h4>';
        }
        $output .= '<ul class="contact_info_list">';
        if(!empty($location)){
            $output .= ' <li class="single-info-item">
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="details">
                        '.purify_html($location).'
                    </div>
                </li>';
        }
        if(!empty($phone)){
            $output .= '<li class="single-info-item">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="details">
                       '.purify_html($phone).'
                    </div>
                </li>';
        }
        if(!empty($email)){
            $output .= '<li class="single-info-item">
                    <div class="icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="details">
                       '.purify_html($email).'
                    </div>
                </li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        return __('Contact Info');
    }

}