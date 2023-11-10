<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\Helpers\LanguageHelper;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class ConnectUsWidget extends WidgetBase
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
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'connect_widget_repeater_01',
            'fields' => [
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('URL')
                ],
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();
        $lang = LanguageHelper::user_lang_slug();
        $widget_title = $widget_saved_values['widget_title_'.$lang] ?? '';
        $repeater_data = $widget_saved_values['connect_widget_repeater_01'] ?? [];

        $item = '';
        foreach ($repeater_data['icon_'] as $key=> $icon){
            $ic = $icon ?? '';
            $url = $repeater_data['url_'][$key] ?? '';

   $item.= <<<ITEM
         <li class="list">
            <a class="facebook" href="{$url}"> <i class="{$ic}"></i> </a>
        </li>
ITEM;

        }


  return <<<HTML
        <div class="sidebars-single-content">
            <h4 class="sidebars-title">{$widget_title}</h4>
            <div class="updated-socials">
                <ul class="sidebars-socials">
                  {$item}
                </ul>
            </div>
        </div>
HTML;



    }


    public function widget_title()
    {
        return __('Connect Us');
    }
}