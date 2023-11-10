<?php


namespace App\WidgetsBuilder\Widgets;


use App\Helpers\LanguageHelper;
use App\Language;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;

class EventSearchWidget extends WidgetBase
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

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';

        $output = $this->widget_before(); //render widget before content

        if (!empty($widget_title)) {
            $output .= '<h4 class="widget-title">' . purify_html($widget_title). '</h4>';
        }
        $output .='<div class="widget_search">
                        <form action="'.route('frontend.events.search').'" method="get" class="search-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="'.__('Search...').'">
                            </div>
                            <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        return __('Event Search');
    }
}