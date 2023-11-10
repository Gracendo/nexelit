<?php


namespace App\PageBuilder\Addons\Course;

use App\Course;
use App\CoursesCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;

class CourseSliderStyleOne extends PageBuilderBase
{


    public function enable(): bool
    {
        return (boolean)get_static_option('course_module_status');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
        return 'course/slider-01.png';
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
                'name' => 'section_title_' . $lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end(); //have to end language tab

        $categories = CoursesCategory::with('lang')->where(['status' => 'publish'])->get()->pluck('lang.title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple' => true,
            'label' => __('Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('you can select category for course, if you want to show all course leave it empty')
        ]);
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
            'value' => $widget_saved_values['slider_items'] ?? 3,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
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
        $section_title = SanitizeInput::esc_html($settings['section_title_' . $current_lang]);
        $section_title_alignment = SanitizeInput::esc_html($settings['section_title_alignment']);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $category = $settings['categories'] ?? [];


        $courses = Course::query()->with('lang_front')->where(['status' => 'publish'])->orderBy($order_by, $order);
        if (!empty($category)) {
            $courses->whereIn('categories_id', $category);
        }
        $courses = $courses->get();
        if (!empty($items)) {
            $courses = $courses->take($items);
        }
        $category_markup = '';
        $a = 1;
        foreach ($courses as $course) {
            $category_route = route('frontend.course.category',[\Str::slug(optional(optional($course->category)->lang_front)->title ?? '','-',optional(optional($course->category)->lang_front)->lang ?? ''),optional($course->category)->id]);
            $category_title = optional(optional($course->category)->lang_front)->title ?? '';
            $route = route('frontend.course.single', ['slug' => optional($course->lang_front)->slug ?? '', 'id' => $course->id]);
            $image = render_image_markup_by_attachment_id($course->image);
            $title = SanitizeInput::esc_html(optional($course->lang_front)->title ?? __('Untitled'));
            $title = \Str::words($title ?? '',6,'..');

            $price_wrap = '<div class="price-wrap">'.amount_with_currency_symbol($course->price);
            $price_wrap .= '<del>'.amount_with_currency_symbol($course->sale_price).'</del>';
            $price_wrap .= '</div>';
            $by = __('By');
            $instructor_name = optional($course->instructor)->name;
            $instructor_route = route('frontend.course.instructor',[\Str::slug(optional($course->instructor)->name ?? ''),optional($course->instructor)->id]);

            $description =  \Str::words(strip_tags(optional($course->lang_front)->description ?? ''),15);


            $review_markup = '';
            if(count($course->reviews) > 0){
                $review_markup = '<div class="rating-wrap">
                    <div class="ratings">
                        <span class="hide-rating"></span>
                        <span class="show-rating" style="width: '.get_course_ratings_avg_by_id($course->id) / 5 * 100 .'%"></span>
                    </div>
                    <p><span class="total-ratings">('.count($course->reviews).')</span></p>
                </div>';
            }

            $enrolled = $course->enrolled_student. ' '.__('Enrolled');
            $duration = $course->duration .' '.$course->duration_type;

            $category_markup .= <<<HTML
<div class="course-single-grid-item">
    <div class="thumb">
        <a href="{$route}">
            {$image}
        </a>
        {$price_wrap}
        <div class="cat">
            <a class="bg-{$a}" href="{$category_route}">{$category_title}</a>
        </div>
    </div>
    <div class="content">
     {$review_markup}
       
        <h3 class="title"><a href="{$route}">{$title}</a></h3>
        <div class="instructor-wrap"><span>{$by}</span> <a href="{$instructor_route}">{$instructor_name}</a></div>
        <div class="description">
            {$description}
        </div>
        <div class="footer-part">
            <span><i class="fas fa-users"></i> {$enrolled}</span>
            <span><i class="fas fa-clock"></i> {$duration}</span>
        </div>
    </div>
    </div>
HTML;
            if ($a == 6) {
                $a = 1;
            } else {
                $a++;
            }
        }

        $section_title_markup = '';
        if (!empty($section_title)) {
            $section_title_markup .= <<<HTML
<div class="row">
    <div class="col-lg-12">
        <div class="section-title course-home margin-bottom-80 {$section_title_alignment}">
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
                <div class="recent-course-area global-carousel-init"
                    data-loop="true" 
                    data-desktopitem="{$slider_items}"
                    data-mobileitem="1" 
                    data-tabletitem="2" 
                    data-autoplay="true" 
                    data-nav="true" 
                    data-margin="30"
                    data-stagepadding="10"
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
        return __('Course Slider: 01');
    }
}