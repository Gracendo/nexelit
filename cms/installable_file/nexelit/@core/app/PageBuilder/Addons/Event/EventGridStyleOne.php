<?php


namespace App\PageBuilder\Addons\Event;
use App\Events;
use App\EventsCategory;
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
use App\Testimonial;
use Illuminate\Support\Str;

class EventGridStyleOne extends PageBuilderBase
{
    public function enable() : bool
    {
        return (boolean) get_static_option('events_module_status');
    }
    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'event/slider-02.png';
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
            $categories = EventsCategory::where(['status' => 'publish','lang' => $lang->slug])->get()->pluck('title', 'id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_'.$lang->slug] ?? null,
                'info' => __('you can select category for event, if you want to show all event leave it empty')
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
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);
        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-4' => __('03 Column'),
                'col-lg-6' => __('02 Column'),
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
        $category = $settings['categories_'.$current_lang] ?? [];

        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $columns = SanitizeInput::esc_html($settings['columns']);


        $events = Events::query()->where(['lang' => $current_lang,'status' => 'publish']);
        if (!empty($category)){
            $events->whereIn('category_id', $category);
        }
        $events =$events->orderBy($order_by,$order);
        if(!empty($items)){
            $events = $events->paginate($items);
        }else {
            $events = $events->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$events->links().'</div></div>';
        }

        $category_markup = '';
        $a =0;
        foreach ($events as $event){
            $image = render_image_markup_by_attachment_id($event->image,'','grid');
            $day = date('d',strtotime($event->date));
            $month = date('M',strtotime($event->date));
            $route = route('frontend.events.single',$event->slug);
            $title = $event->title;
            $location = $event->venue_location;
            $description = strip_tags(Str::words(str_replace('&nbsp;',' ',$event->content),20));
            $location_markup = '';
            if (!empty($location)){
                $location_markup = '<li><i class="fas fa-map-marker-alt"></i> '.$location.'</li>';
            }
            $time_markup = '';
            if (!empty($event->time)){
                $time_markup = '<li><i class="far fa-clock"></i> '.$event->time.'</li>';
            }
            $category_markup .= <<<HTML
<div class="col-md-6 {$columns}">
    <div class="charity-single-event-item-wrap margin-bottom-30">
        <div class="thumb">
             {$image}
            <div class="time-wrap style-{$a}">
               <span class="date">{$day}</span>
                    <span class="month">{$month}</span>
            </div>
        </div>
        <div class="content">
            <h4 class="title"><a href="{$route}">{$title}</a></h4>
            <div class="description">{$description}</div>
            <ul>
                {$time_markup}
                {$location_markup}
            </ul>
        </div>
    </div>
</div>
HTML;
            ($a == 2) ? $a = 0 : $a++;
        }

        return <<<HTML
<div class="charity-event-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
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
        return __('Event Grid: 01');
    }
}