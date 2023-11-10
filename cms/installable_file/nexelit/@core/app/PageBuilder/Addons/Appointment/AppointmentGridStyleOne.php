<?php


namespace App\PageBuilder\Addons\Appointment;
use App\Appointment;
use App\AppointmentCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\ProductRatings;
use App\Products;
use Illuminate\Support\Str;

class AppointmentGridStyleOne extends PageBuilderBase
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
       return 'appointment/slider-01.png';
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
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

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

        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-6' => __('02 Column'),
                'col-lg-4' => __('03 Column'),
                'col-lg-3' => __('04 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Pagination Settings')
        ]);
        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Enable/Disable Pagination'),
            'value' => $widget_saved_values['pagination_status'] ?? null,
            'info' => __('your can show/hide pagination'),
        ]);
        $output .= Select::get([
            'name' => 'pagination_alignment',
            'label' => __('Pagination Alignment'),
            'options' => [
                'text-left' => __('Left'),
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
        ]);

        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
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
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $category = $settings['categories'] ?? [];

        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $columns = SanitizeInput::esc_html($settings['columns']);


        $appointment = Appointment::query()->with('lang_front')->where(['status' => 'publish'])->orderBy($order_by, $order);
        if (!empty($category)) {
            $appointment->whereIn('categories_id', $category);
        }

        if (!empty($items)) {
            $appointment = $appointment->paginate($items);
        }else {
            $appointment = $appointment->get();
        }
        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$appointment->links().'</div></div>';
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


            $category_markup .= <<<HTML
<div class="col-md-6 {$columns}">
    <div class="appointment-single-item cleaning-home">
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
            <div class="btn-wrapper margin-top-30">
                <a href="{$route}" class="boxed-btn">{$button_text}</a>
            </div>
        </div>
    </div>
</div>
HTML;
        }


        return <<<HTML
<div class="feature-products-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
    <div class="container">
        <div class="row">
            {$category_markup}
            {$pagination_markup}
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
        return __('Appointment Grid: 01');
    }
}