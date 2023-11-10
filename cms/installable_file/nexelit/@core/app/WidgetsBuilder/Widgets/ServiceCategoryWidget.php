<?php


namespace App\WidgetsBuilder\Widgets;


use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\ServiceCategory;
use App\Services;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class ServiceCategoryWidget extends WidgetBase
{

    public function admin_render()
    {
        // TODO: Implement admin_render() method.
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

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
        // TODO: Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();

        $post_items = $widget_saved_values['post_items'] ?? '';

        $category = ServiceCategory::where(['status' =>'publish','lang' => LanguageHelper::user_lang_slug()])->orderBy('id','desc')->get();
        if (!empty($post_items)){
            $category = $category->take($post_items);
        }
        $service = Services::where('slug',\Request::route('slug'))->first();
        $output =  '<div class="widget-nav-menu margin-bottom-30 service-category sidebars-single-content">';
        $output .= '<ul>';
        foreach ($category as $data) {
            $class_name = '';
            if(\Request::is(get_static_option('service_page_slug').'/*')){
                $class_name = ($data->id == $service->categories_id)? 'active' : '';
            }
            $route = route('frontend.services.category', ['id' => $data->id,'any' => Str::slug(purify_html($data->name))]);
            $name = $data->name;
            $output .= <<<HTML
<li>
    <a href="{$route}"
       class="service-widget {$class_name}">
        <div class="service-title">
            <h6 class="title">{$name}</h6>
        </div>
    </a>
</li>
HTML;
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    public function widget_title()
    {
        return __('Service Category');
    }
}