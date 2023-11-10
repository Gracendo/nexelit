<?php


namespace App\PageBuilder\Addons\Common;


use App\Faq;
use App\FormBuilder;
use App\Helpers\FormBuilderCustom;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class QuoteAndFaqStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'common/quote-faq-01.png';
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
            $output .= Notice::get([
                'type' => 'secondary',
                'text' => __('Quote Settings'),
            ]);
            $output .= Text::get([
                'name' => 'quote_subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['quote_subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'quote_title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['quote_title_' . $lang->slug] ?? null,
            ]);
            $output .= Notice::get([
                'type' => 'secondary',
                'text' => __('FAQ Settings'),
            ]);
            $output .= Text::get([
                'name' => 'faq_subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['faq_subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'faq_title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['faq_title_' . $lang->slug] ?? null,
            ]);
            $faqs = Faq::where('lang',$lang->slug)->get()->pluck('title','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'faq_ids_'.$lang->slug,
                'multiple' => true,
                'label' => __('Select Faq'),
                'placeholder' => __('Select faq'),
                'options' => $faqs,
                'value' => $widget_saved_values['faq_ids_'.$lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $custom_form = FormBuilder::all()->pluck('title','id')->toArray();

        $output .= Select::get([
            'name' => 'custom_form_id',
            'label' => __('Custom Form'),
            'placeholder' => __('Select Form'),
            'options' => $custom_form,
            'value' => $widget_saved_values['custom_form_id'] ?? null,
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings')
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
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
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color: '.$background_color.'"' : '';
        $quote_subtitle = SanitizeInput::esc_html($settings['quote_subtitle_'.$current_lang]);
        $quote_title = SanitizeInput::esc_html($settings['quote_title_'.$current_lang]);
        $faq_subtitle = SanitizeInput::esc_html($settings['faq_subtitle_'.$current_lang]);
        $faq_title = SanitizeInput::esc_html($settings['faq_title_'.$current_lang]);
        $faq_ids = $settings['faq_ids_'.$current_lang] ?? [];

        $custom_form_markup = FormBuilderCustom::render_form($custom_form_id,null,null,'logistics-btn','logistic-quote-form');

        $faq_markup = '';
        $faq_items = Faq::where(['lang'=> $current_lang]);
        if (!empty($faq_ids)){
            $faq_items->whereIn('id',$faq_ids);
        }
        $faq_items = $faq_items->get();
        $rand_number = random_int(9999,99999999);
        $faq_markup .='<div class="accordion-wrapper logistics-style"><div id="accordion_'.$rand_number.'">';
        foreach ($faq_items as $index => $faq){

            $title = SanitizeInput::esc_html($faq->title);
            $description = SanitizeInput::kses_basic($faq->description);
            $aria_expanded = 'false';
            $collapse = '';
            if($faq->is_open == 'on'){
                $aria_expanded = 'true';
            }
            if($faq->is_open == 'on') {
                $collapse = 'show';
            }

            $faq_markup .= <<<HTML
<div class="card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="card-header" id="headingOne_{1$index}" itemprop="name">
        <h5 class="mb-0">
            <a data-toggle="collapse" data-target="#collapseOne_{$index}" role="button"
               aria-expanded="{$aria_expanded}" aria-controls="collapseOne_{$index}">
                {$title}
            </a>
        </h5>
    </div>

    <div id="collapseOne_{$index}" class="collapse {$collapse}"
         aria-labelledby="headingOne_{$index}" data-parent="#accordion_{$rand_number}" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div class="card-body" itemprop="text">
            {$description}
        </div>
    </div>
</div>
HTML;
        }
    $faq_markup .= '</div></div>';



        return <<<HTML
<div class="quote-and-faq section-white-bg-one" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="logistic-get-quote">
                        <span class="subtitle">{$quote_subtitle}</span>
                        <h4 class="title">{$quote_title}</h4>
                        {$custom_form_markup}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="logistic-faq-wrapper">
                        <span class="subtitle">{$faq_subtitle}</span>
                        <h4 class="title">{$faq_title}</h4>
                        {$faq_markup}
                    </div>
                </div>
            </div>
        </div>
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
        return __('Quote & Faq: 01');
    }

}