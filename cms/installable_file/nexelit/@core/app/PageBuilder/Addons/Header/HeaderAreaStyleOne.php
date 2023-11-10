<?php

namespace App\PageBuilder\Addons\Header;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;

class HeaderAreaStyleOne extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        // TODO: Implement admin_render() method.
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
            $output .= Textarea::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button Url'),
            'value' => $widget_saved_values['button_url'] ?? null,
        ]);

        $output .= IconPicker::get([
            'name' => 'button_icon',
            'label' => __('Button Icon'),
            'value' => $widget_saved_values['button_icon'] ?? 'fa far-star',
        ]);

        $output .= Image::get([
            'name' => 'right_side_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_side_image'] ?? null,
            'dimensions' => '770x1050'
        ]);

        $output .= Image::get([
            'name' => 'shape_side_image_01',
            'label' => __('Shape Image 01'),
            'value' => $widget_saved_values['shape_side_image_01'] ?? null,
            'dimensions' => '120x120'
        ]);
        $output .= Image::get([
            'name' => 'shape_side_image_02',
            'label' => __('Shape Image 02'),
            'value' => $widget_saved_values['shape_side_image_02'] ?? null,
            'dimensions' => '120x120'
        ]);
        $output .= Image::get([
            'name' => 'shape_side_image_03',
            'label' => __('Shape Image 03'),
            'value' => $widget_saved_values['shape_side_image_03'] ?? null,
            'dimensions' => '120x120'
        ]);
        $output .= Image::get([
            'name' => 'shape_side_image_04',
            'label' => __('Shape Image 04'),
            'value' => $widget_saved_values['shape_side_image_04'] ?? null,
            'dimensions' => '150x250'
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 200,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 300,
            'max' => 500,
        ]);

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
        $shape_01 = render_image_markup_by_attachment_id($settings['shape_side_image_01']);
        $shape_02 = render_image_markup_by_attachment_id($settings['shape_side_image_02']);
        $shape_03 = render_image_markup_by_attachment_id($settings['shape_side_image_03']);
        $shape_04 = render_image_markup_by_attachment_id($settings['shape_side_image_04']);
        $right_image = render_image_markup_by_attachment_id($settings['right_side_image']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_icon = SanitizeInput::esc_html($settings['button_icon']);
        $button_url = SanitizeInput::esc_url($settings['button_url']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        return <<<HTML
<div class="cagency-header-static" >
        <div class="header-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
            <div class="shape-image shape-01">
                {$shape_01}
            </div>
            <div class="shape-image shape-02">
               {$shape_02}
            </div>
            <div class="shape-image shape-03">
               {$shape_03}
            </div>

            <div class="right-image">
               {$right_image}
                <div class="shape-04">
                    {$shape_04}
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-10">
                        <div class="header-inner">
                             <h1 class="title">{$title}</h1>
                             <div class="description">{$description}</div>
                                <div class="btn-wrapper margin-top-30">
                                    <a href="{$button_url}" class="cagency-btn">{$button_text} <i class="{$button_icon}"></i></a>
                                </div>
                             </div>
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
        // TODO: Implement widget_title() method.
        return __('Header: 01');
    }


    /**
     * @inheritDoc
     */
    public function preview_image()
    {
        // TODO: Implement preview_image() method.

        return 'header-area-style-one.png';
    }
}