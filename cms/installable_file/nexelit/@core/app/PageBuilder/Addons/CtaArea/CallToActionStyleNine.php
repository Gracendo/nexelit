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

class CallToActionStyleNine extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'cta-area/09.png';
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
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_url_'.$lang->slug,
                'label' => __('Button URL'),
                'value' => $widget_saved_values['button_url_' . $lang->slug] ?? null,
            ]);
            $output .= IconPicker::get([
                'name' => 'button_icon_'.$lang->slug,
                'label' => __('Button Icon'),
                'value' => $widget_saved_values['button_icon_' . $lang->slug] ?? null,
            ]);
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings')
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
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Shape Settings')
        ]);
        $output .= Image::get([
            'name' => 'shape_01',
            'label' => __('Shape 01 Image'),
            'value' => $widget_saved_values['shape_01'] ?? null,
            'dimensions' => '60x60px'
        ]);
        $output .= Image::get([
            'name' => 'shape_02',
            'label' => __('Shape 02 Image'),
            'value' => $widget_saved_values['shape_02'] ?? null,
            'dimensions' => '60x60px'
        ]);
        $output .= Image::get([
            'name' => 'shape_03',
            'label' => __('Shape 03 Image'),
            'value' => $widget_saved_values['shape_03'] ?? null,
            'dimensions' => '60x60px'
        ]);
        $output .= Image::get([
            'name' => 'shape_04',
            'label' => __('Shape 04 Image'),
            'value' => $widget_saved_values['shape_04'] ?? null,
            'dimensions' => '60x60px'
        ]);
        $output .= Image::get([
            'name' => 'shape_05',
            'label' => __('Shape 05 Image'),
            'value' => $widget_saved_values['shape_05'] ?? null,
            'dimensions' => '60x60px'
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
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::kses_basic($settings['description_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_url = SanitizeInput::esc_url($settings['button_url_'.$current_lang]);
        $button_icon = SanitizeInput::esc_html($settings['button_icon_'.$current_lang]);
        $right_image = SanitizeInput::esc_html($settings['right_image']);
        $shape_01 = SanitizeInput::esc_html($settings['shape_01']);
        $shape_01 = render_image_markup_by_attachment_id($shape_01);
        $shape_02 = SanitizeInput::esc_html($settings['shape_02']);
        $shape_02 = render_image_markup_by_attachment_id($shape_02);
        $shape_03 = SanitizeInput::esc_html($settings['shape_03'] ?? '') ;
        $shape_03 = render_image_markup_by_attachment_id($shape_03);
        $shape_04 = SanitizeInput::esc_html($settings['shape_04']);
        $shape_04 = render_image_markup_by_attachment_id($shape_04);
        $shape_05 = SanitizeInput::esc_html($settings['shape_05']);
        $shape_05 = render_image_markup_by_attachment_id($shape_05);

        $right_image_markup = '';
        if (!empty($right_image)){
            $right_image_tag = render_image_markup_by_attachment_id($right_image);
            $right_image_markup = <<<HTML
<div class="right-image-wrap">
{$right_image_tag}
</div>
HTML;
        }
        $button_markup = '';
        if (!empty($button_text)){
            $button_icon = !empty($button_icon) ? '<i class="'.$button_icon.'"></i>' : '';
            $button_markup = <<<HTML
<div class="btn-wrapper margin-top-30">
    <a href="{$button_url}" class="cagency-btn">{$button_text} {$button_icon}</a>
</div>
HTML;

        }


        return <<<HTML
<div class="creative-agency-call-to-action" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" >
        {$right_image_markup}
        <div class="shape shape-01">{$shape_01}</div>
        <div class="shape shape-02">$shape_02}</div>
        <div class="shape shape-03">$shape_03}</div>
        <div class="shape shape-04">$shape_04}</div>
        <div class="shape shape-05">$shape_05}</div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-10">
                    <div class="cagency-cta-area-inner">
                        <h2 class="title">{$title}</h2>
                        <div class="description">{$description}</div>
                        {$button_markup}
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