<?php


namespace App\WidgetsBuilder\Widgets;


use App\BlogCategory;
use App\EventsCategory;
use App\Helpers\LanguageHelper;
use App\JobsCategory;
use App\KnowledgebaseTopic;
use App\Language;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class KnowledgebaseCategoryWidget extends WidgetBase
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
        $output .= Number::get([
            'name' => 'post_items',
            'label' => __('Post Items'),
            'value' => $widget_saved_values['post_items'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = KnowledgebaseTopic::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->orderBy('id','desc')->get();
        if (!empty($post_items)){
            $blog_posts = $blog_posts->take($post_items);
        }

        $output = $this->widget_before(); //render widget before content
        $output .=  '<div class="widget_nav_menu">';
        if (!empty($widget_title)) {
            $output .= '<h3 class="widget-title style-01">' . purify_html($widget_title) . '</h3>';
        }
        $output .= '<ul>';
        foreach ($blog_posts as $post) {
            $output .= '<li><a href="' . route('frontend.knowledgebase.category', ['id' => $post->id,'any' => Str::slug(purify_html($post->title))]) . '"> <i class="fas fa-folder base-color"></i>' . purify_html($post->title) . '</a></li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        return __('Knowledgebase Category');
    }
}