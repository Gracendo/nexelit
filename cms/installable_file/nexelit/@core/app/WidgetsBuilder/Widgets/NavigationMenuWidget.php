<?php


namespace App\WidgetsBuilder\Widgets;

use App\Helpers\LanguageHelper;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;

class NavigationMenuWidget extends WidgetBase
{

    public function admin_render()
    {
        // TODO: Implement admin_render() method.
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
            $navigation_menus = Menu::where('lang',$lang->slug)->get()->pluck('title','id');
            $output .= Select::get([
                'name' => 'navigation_menu_id_'.$lang->slug,
                'label' => __('Select Menu'),
                'options' => $navigation_menus,
                'value' => $widget_saved_values['navigation_menu_id_' . $lang->slug] ?? null,
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
        // TODO: Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();
        $widget_title =  $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';
        $menu_id = $widget_saved_values['navigation_menu_id_'.LanguageHelper::user_lang_slug()] ?? '';

        $output = $this->widget_before(); //render widget before content
        $output .= '<div class="footer-widget widget widget_nav_menu">';

        if (!empty($widget_title)){
            $output .= '<h4 class="widget-title">'.purify_html($widget_title).'</h4>';
        }
        $output .= '<ul>';
        $output .= render_frontend_menu($menu_id);
        $output .= '</ul>';

        $output .= '</div>';
        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        // TODO: Implement widget_title() method.
        return __('Navigation Menu');
    }
}