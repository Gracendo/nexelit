<?php


namespace App\PageBuilder\Addons\Course;
use App\CoursesCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;

class CourseCategoryStyleOne extends PageBuilderBase
{


    public function enable() : bool
    {
        return (boolean) get_static_option('course_module_status');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'course/category-01.png';
    }

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
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Secction Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set category order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set category order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);
        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Item'),
            'value' => $widget_saved_values['slider_items'] ?? 5,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        // add padding option

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
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($settings['section_title_'.$current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);


        $product_category = CoursesCategory::query()->with('lang_front')->where(['status' => 'publish'])->orderBy($order_by,$order)->get();

        if(!empty($items)){
            $product_category = $product_category->take($items);
        }
        $category_markup = '';
        $a = 1;
        foreach ($product_category as $category){
            $route = route('frontend.course.category',[\Str::slug(optional($category->lang_front)->title ?? '','-',optional($category->lang_front)->lang ?? ''),$category->id]);

            $title = optional($category->lang_front)->title ?? __('Untitled');
            $icon_bg = asset('assets/frontend/img/icon/course-'.$a.'.svg');
            $icon = $category->icon;
            $count = optional($category->course)->count() ?? 0 ;
            $count .=' '. __('Courses');
            $category_markup .= <<<HTML
 <div class="single-course-category-item">
    <a href="{$route}">
    <div class="icon bg-{$a}"
    style="background-image: url({$icon_bg})"
    >
        <i class="{$icon}"></i>
    </div>
    </a>
    <div class="content">
        <a href="{$route}">
        <h4 class="title">{$title}</h4>
        </a>
        <span class="count">{$count}</span>
    </div>
</div>
HTML;
            if($a == 6){ $a=1;}else{$a++;}
        }

        $section_title_markup = '';
        if (!empty($section_title)){
            $section_title_markup .= <<<HTML
<div class="row">
    <div class="col-lg-8">
        <div class="section-title course-home margin-bottom-80">
            <h2 class="title">{$section_title}</h2>
        </div>
    </div>
</div>
HTML;

        }

        return <<<HTML
<div class="categories-area-wrap" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-categories logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="{$slider_items}"
                     data-mobileitem="2"
                     data-tabletitem="3"
                     data-autoplay="true"
                     data-margin="40"
                     data-dots="true"
                     data-nav="true"
                >
                {$category_markup}
                </div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __('Course Category: 01');
    }
}