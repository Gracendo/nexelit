<?php


namespace App\PageBuilder\Addons\Service;

use App\Course;
use App\CoursesCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
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
use App\ServiceCategory;
use App\Services;
use Illuminate\Support\Str;

class ServiceGridStyleFour extends PageBuilderBase
{



    /**
     * @inheritDoc
     */
    public function preview_image()
    {
        return 'service/grid-04.png';
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
                'name' => 'section_subtitle_' . $lang->slug,
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['section_subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'section_title_' . $lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'read_more_text_' . $lang->slug,
                'label' => __('Read More Text'),
                'value' => $widget_saved_values['read_more_text_' . $lang->slug] ?? null,
            ]);
            $categories = ServiceCategory::where(['lang' =>  $lang->slug,'status' => 'publish'])->get()->pluck('name', 'id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories',
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories'] ?? null,
                'info' => __('you can select category for service, if you want to show all service it empty')
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('Left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set alignment of section title')
        ]);
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
        $section_subtitle = SanitizeInput::esc_html($settings['section_subtitle_' . $current_lang]);
        $section_title = SanitizeInput::esc_html($settings['section_title_' . $current_lang]);
        $read_more_text = SanitizeInput::esc_html($settings['read_more_text_' . $current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $section_title_alignment = SanitizeInput::esc_html($settings['section_title_alignment']);
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $category = $settings['categories'] ?? [];


        $services = Services::query()->where(['status' => 'publish','lang' => $current_lang])->orderBy($order_by, $order);

        if (!empty($category)) {
            $services->whereIn('categories_id', $category);
        }
        if (!empty($items)) {
            $services = $services->paginate($items);
        }else{
            $services = $services->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$services->links().'</div></div>';
        }

        $item_markup = '';
        foreach ($services as $service) {
            $route = route('frontend.services.single', $service->slug);
            $image = render_image_markup_by_attachment_id($service->image);
            $title = SanitizeInput::esc_html($service->title);
            $excerpt = SanitizeInput::esc_html($service->excerpt);
            $read_more_markup = '';

            if (!empty($read_more_text)){
                $read_more_markup = '<a href="'.$route.'" class="readmore">'.$read_more_text.' <i class="fas fa-long-arrow-alt-right"></i> </a>';
            }

            $item_markup .= <<<HTML
<div class="col-lg-4 col-md-6">
<div class="political-single-what-we-cover-item  margin-bottom-30">
    <div class="hover">
         <h4 class="title"><a href="{$route}">{$title}</a></h4>
        <p>{$excerpt}</p>
    </div>
    {$image}
    <div class="content">
        <h4 class="title"><a href="{$route}">{$title}</a></h4>
        {$read_more_markup}
    </div>
</div>
</div>
HTML;
        }

        $section_title_markup = '';
        if (!empty($section_title)) {
            $section_title_markup .= <<<HTML
<div class="row justify-content-between ">
   <div class="col-lg-12">
       <div class="section-title desktop-center margin-bottom-60 political-home {$section_title_alignment}">
            <span class="subtitle">{$section_subtitle}</span>
            <h2 class="title">{$section_title}</h2>
       </div>
   </div>
</div>
HTML;
        }

        return <<<HTML
<div class="political-what-we-offer-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
        <div class="row">
            {$item_markup}
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
        return __('Service Grid: 04');
    }
}