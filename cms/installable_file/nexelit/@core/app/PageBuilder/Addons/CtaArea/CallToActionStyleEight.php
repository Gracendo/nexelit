<?php


namespace App\PageBuilder\Addons\CtaArea;


use App\FormBuilder;
use App\Helpers\FormBuilderCustom;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class CallToActionStyleEight extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'cta-area/08.png';
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
                'name' => 'subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['subtitle_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
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
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '1920x1000px'
        ]);
        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
            'dimensions' => '900x820px'
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
        $background_image = SanitizeInput::esc_html($settings['background_image']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang]);
        $background_image = render_background_image_markup_by_attachment_id($background_image);
        $right_image = SanitizeInput::esc_html($settings['right_image']);
        $custom_form_id = SanitizeInput::esc_html($settings['custom_form_id']);
        $custom_form_markup = FormBuilderCustom::render_form($custom_form_id,null,null,'industry-btn const-home-color d-inline-block');

        $right_image_markup = '';
        if (!empty($right_image)){
            $right_image_tag = render_image_markup_by_attachment_id($right_image);
            $right_image_markup = <<<HTML
<div class="right-image">
{$right_image_tag}
</div>
HTML;
        }


        return <<<HTML
<div class="construction-quote-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_image}>
        {$right_image_markup}
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title margin-bottom-60 white const-home-color">
                        <span class="subtitle">{$subtitle}</span>
                        <h2 class="title">{$title}</h2>
                    </div>
                    <div class="construction-home-quote-form">
                        {$custom_form_markup}
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
        return __('CTA Area: 09');
    }

}