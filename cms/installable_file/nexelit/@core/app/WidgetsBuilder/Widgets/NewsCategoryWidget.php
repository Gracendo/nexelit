<?php


namespace App\WidgetsBuilder\Widgets;


use App\Blog;
use App\BlogCategory;
use App\EventsCategory;
use App\Helpers\LanguageHelper;
use App\Language;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class NewsCategoryWidget extends WidgetBase
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
                'name' => 'widget_title_' . $lang->slug,
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
        $icon_class = (get_user_lang_direction() == 'rtl') ? 'left ml-2' : 'right';
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_' . LanguageHelper::user_lang_slug()] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = BlogCategory::where(['status' => 'publish', 'lang' => LanguageHelper::user_lang_slug()])->orderBy('id', 'desc')->get();
        if (!empty($post_items)) {
            $blog_posts = $blog_posts->take($post_items);
        }

        $cat_item = '';
        foreach ($blog_posts as $post) {
            $route = route('frontend.blog.category', ['id' => $post->id,'any' => Str::slug(purify_html($post->name))]);
            $cat_name = purify_html($post->name);
            $bg_image = render_background_image_markup_by_attachment_id($post->image);
            $cat_count = Blog::where('blog_categories_id', $post->id)->count();

     $cat_item.= <<<ITEM
                
    <li class="single-item">
        <span class="extra-bg lazy"{$bg_image}></span>
        <a href="{$route}" class="wrap">
            <span class="left-content">$cat_name</span>
            <span class="right-content"> $cat_count</span>
        </a>
    </li>
ITEM;

}


return <<<MARKUP

<div class="category style-03">
    <div class="section-title-20">
      <h4 class="title">$widget_title</h4>
</div>
  
    <ul class="widget-category-list">
        $cat_item
    </ul>
</div>
MARKUP;

    }

    public function widget_title()
    {
        return __('News Category');
    }
}