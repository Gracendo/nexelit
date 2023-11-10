<?php


namespace App\PageBuilder\Addons\Appointment;
use App\Appointment;
use App\AppointmentCategory;
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
use App\ProductRatings;
use App\Products;
use Illuminate\Support\Str;

class AppointmentSliderStyleTwo extends PageBuilderBase
{


    public function enable() : bool
    {
        return (boolean) get_static_option('appointment_module_status');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'appointment/slider-02.png';
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
                'name' => 'section_subtitle_'.$lang->slug,
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['section_subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'text-left' => __('left'),
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set section title alignment')
        ]);
        $categories = AppointmentCategory::with('lang')->where(['status' => 'publish'])->get()->pluck('lang.title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple' => true,
            'label' => __('Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('you can select category for appointment, if you want to show all appointment leave it empty')
        ]);
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
                'price' => __('Price'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
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
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);
        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Items'),
            'value' => $widget_saved_values['slider_items'] ?? 4,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= Select::get([
            'name' => 'theme',
            'label' => __('Theme'),
            'options' => [
                'lawyyer-home' => __('Style One'),
                'medical-home' => __('Style Two'),
                'cleaning-home' => __('Style Three'),
            ],
            'value' => $widget_saved_values['theme'] ?? null,
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
        $section_subtitle = SanitizeInput::esc_html($settings['section_subtitle_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $theme = SanitizeInput::esc_html($settings['theme']);
        $section_title_alignment = SanitizeInput::esc_html($settings['section_title_alignment']);
        $category = $settings['categories'] ?? [];

        $appointment = Appointment::query()->with('lang_front')->where(['status' => 'publish'])->orderBy($order_by, $order);
        if (!empty($category)) {
            $appointment->whereIn('categories_id', $category);
        }
        $appointment = $appointment->get();
        if (!empty($items)) {
            $appointment = $appointment->take($items);
        }


        $category_markup = '';
        foreach ($appointment as $item){
            $category_title = optional(optional($item->category)->lang_front)->title ?? __("Uncategorized");
            $category_route = route('frontend.appointment.category',['id' => optional($item->category)->id,'any' => Str::slug(optional(optional($item->category)->lang_front)->title ?? __("Uncategorized"))]);
            $image_markup =  render_background_image_markup_by_attachment_id($item->image,'','grid');
            $route = route('frontend.appointment.single',[optional($item->lang_front)->slug ?? __('untitled'),$item->id]);
            $title = optional($item->lang_front)->title ?? '';
            $description = Str::words(strip_tags(optional($item->lang_front)->short_description ?? ''),10);
            $designation_markup = '';
            if(!empty(optional($item->lang_front)->designation)){
                $designation_markup = '<span class="designation">'.optional($item->lang_front)->designation.'</span>';
            }
            $review_markup = '';
            if(count($item->reviews) > 0){
                $rating_avg = get_appointment_ratings_avg_by_id($item->id) / 5 * 100;
                $review_count = count($item->reviews);
                $review_markup = <<<HTML
<div class="rating-wrap">
    <div class="ratings">
        <span class="hide-rating"></span>
        <span class="show-rating" style="width: {$rating_avg}%"></span>
    </div>
    <p><span class="total-ratings">({$review_count})</span></p>
</div>
HTML;
            }

            $location_markup = '';
            if(!empty(optional($item->lang_front)->location)){
                $location_markup = '<span class="location"><i class="fas fa-map-marker-alt"></i>'.optional($item->lang_front)->location.'</span>';
            }
            $button_markup = '';

            if (!empty($button_text)){
                $button_markup = <<<HTML
 <div class="btn-wrapper margin-top-30">
    <a href="{$route}" class="boxed-btn">{$button_text}</a>
</div>
HTML;

            }

            $category_markup .= <<<HTML
<div class="appointment-single-item {$theme}">
    <div class="thumb"
      {$image_markup}
    >
        <div class="cat">
            <a href="{$category_route}">{$category_title}</a>
        </div>
    </div>
    <div class="content">
       {$designation_markup}
       {$review_markup}
        <a href="{$route}"><h4 class="title">{$title}</h4></a>
        {$location_markup}
        <p>{$description}</p>
       {$button_markup}
    </div>
</div>
HTML;
        }

        $section_title_markup = '';
        if (!empty($section_title)){
            $section_title_markup .= <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="section-title desktop-center margin-bottom-60 {$theme} {$section_title_alignment}">
            <span class="subtitle">{$section_subtitle}</span>
            <h2 class="title">{$section_title}</h2>
        </div>
    </div>
</div>
HTML;
        }

        return <<<HTML
<div class="feature-products-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init logistic-dots {$theme}"
                     data-loop="true"
                     data-desktopitem="{$slider_items}"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
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
        return __('Appointment Slider: 02');
    }
}