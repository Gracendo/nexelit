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

class FollowUsWidget extends WidgetBase
{

    /**
     * @inheritDoc
     */
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
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'follow_widget_repeater_01',
            'fields' => [
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::NUMBER,
                    'name' => 'number',
                    'label' => __('number')
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

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';

        $output = $this->widget_before('single-sidebar-item responsive-margin'); //render widget before content
        if (!empty($widget_title)) {
            $output .= '<div class="section-title-20"><h4 class="title">' . purify_html($widget_title) . '</h4></div>';
        }
        $rep_icons = $widget_saved_values['follow_widget_repeater_01']['icon_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_title = $widget_saved_values['follow_widget_repeater_01']['title_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_number = $widget_saved_values['follow_widget_repeater_01']['number_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_url = $widget_saved_values['follow_widget_repeater_01']['url_'.LanguageHelper::user_lang_slug()] ??  [];

        $chunked_arr =  array_chunk($rep_icons,2,true);
        $output .= '<div class="sidebar-contents margin-top-20"><div class="follow-list">';
        $colors = ['facebook','youtube','twitter','instagram','pintarest','linkedin'];
        foreach($chunked_arr as $index => $ficon){

            $output .= '<div class="single-flex-list">';

        foreach($ficon as $key => $icon){
            $output .= '<div class="single-list margin-top-20">';
            $output .= '<a class="'.$colors[$key % count($colors)].'-bg" href="'.$rep_url[$key].'"> <i class="'.$icon.'"></i> </a>';
            $output .= '<span class="followers"> <strong>'.$rep_number[$key].'</strong> '.$rep_title[$key].' </span>';
            $output .= '</div>';
        }
            $output .= '</div>';
        }
        $output .= '</div></div>';

        $output .= $this->widget_after(); // render widget after content
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        return __('Follow Us');
    }
}