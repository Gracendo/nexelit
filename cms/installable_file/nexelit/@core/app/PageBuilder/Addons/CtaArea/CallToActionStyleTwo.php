<?php


namespace App\PageBuilder\Addons\CtaArea;


use App\Brand;
use App\FormBuilder;
use App\Helpers\FormBuilderCustom;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class CallToActionStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'cta-area/02.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
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
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'form_title_'.$lang->slug,
                'label' => __('Form Title'),
                'value' => $widget_saved_values['form_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Notice::get([
           'type' => 'secondary',
           'text' => __('Brand Logo Carousel Settings')
        ]);
        $output .= Switcher::get([
           'name' => '',
            'label' => __('Show/Hide Brand Logo Carousel')
        ]);
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Brand Logo Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);

        $output .= Select::get([
            'name' => 'order',
            'label' => __('Brand Logo Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Brand Logo Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Brand Logo Slider Item'),
            'value' => $widget_saved_values['slider_items'] ?? 3,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Form Settings')
        ]);
        $categories = FormBuilder::all()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'custom_form_id',
            'label' => __('Custom Form'),
            'placeholder' => __('Select Form'),
            'options' => $categories,
            'value' => $widget_saved_values['custom_form_id'] ?? null,
            'info' => __('you can select your created custom form here.')
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings')
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 120,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 120,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $custom_form_id = SanitizeInput::esc_html($settings['custom_form_id']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $form_title = SanitizeInput::esc_html($settings['form_title_'.$current_lang]);
        $custom_form_builder_markup = FormBuilderCustom::render_form($custom_form_id);

        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $brand_logos = Brand::query()->orderBy($order_by,$order)->get();

        if(!empty($items)){
            $brand_logos = $brand_logos->take($items);
        }
        $brand_markup = '';

        foreach ($brand_logos as $logo){
            $image = render_image_markup_by_attachment_id($logo->image);
            $link_open = '';
            $link_close = '';
            if (!empty($logo->url)){
                $link_open .= '<a href="'.$logo->url.'">';
                $link_close .= '</a>';
            }
            $brand_markup .= <<<HTML
 <div class="single-brand">
    <div class="img-wrapper">
        {$link_open}
        {$image}
        {$link_close}
    </div>
</div>
HTML;
        }

       $bottom_part_markup =  <<<HTML
    <div class="bottom-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-section padding-bottom-70 padding-top-60">
                       <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="client-area">
                                            <div class="client-active-area global-carousel-init"
                                                 data-loop="true"
                                                 data-desktopitem="{$slider_items}"
                                                 data-mobileitem="1"
                                                 data-tabletitem="2"
                                                 data-autoplay="true"
                                                 data-margin="40"
                                            >
                                           {$brand_markup}
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;

        $top_part_markup = <<<HTML
   <div class="top-part" data-padding-top="{$padding_top}">
       <div class="container">
           <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="left-content-wrap padding-top-60">
                        <h3 class="title">
                            {$title}
                        </h3>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="estimate-form-wrapper">
                        <h4 class="title">{$form_title}</h4>
                        {$custom_form_builder_markup}
                    </div>
                </div>
           </div>
       </div>
   </div>
HTML;

        return <<<HTML
<div class="estimate-area-wrap cleaning-home"  data-padding-bottom="{$padding_bottom}" >
        {$top_part_markup}
        {$bottom_part_markup}
</div>
HTML;

    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('CTA Area: 02');
    }

}