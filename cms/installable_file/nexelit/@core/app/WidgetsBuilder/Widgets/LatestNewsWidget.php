<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\Helpers\LanguageHelper;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class LatestNewsWidget extends WidgetBase
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

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = Blog::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        if (!empty($post_items)){
            $blog_posts = $blog_posts->take($post_items);
        }
        $output = $this->widget_before('single-sidebar-item responsive-margin'); //render widget before content
        if (!empty($widget_title)) {
            $output .= '<div class="section-title-20"><h4 class="title">' . purify_html($widget_title) . '</h4></div>';
        }
        $output .= '<div class="sidebar-contents margin-top-40">';
        $number = 1;
        foreach ($blog_posts as $post) {

            $output .= '<div class="recent-contents style-02 wow  fadeInUp animated" data-wow-delay=".1s"><span class="span-num"> '.$number.' </span>';
            $output .= '<h4 class="latest-title"> <a href="' . route('frontend.blog.single',['slug' => $post->slug ]) . '">' . purify_html($post->title) . '</a> </h4>';
            $output .= '</div>';
            $number++;
        }

        $output .= ' </div>';

        $output .= $this->widget_after(); // render widget after content
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        return __('Latest News');
    }
}