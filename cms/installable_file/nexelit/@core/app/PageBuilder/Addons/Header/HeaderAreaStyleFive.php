<?php


namespace App\PageBuilder\Addons\Header;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;

class HeaderAreaStyleFive extends PageBuilderBase
{

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image() : string
     {
        return 'header-area-style-05.png';
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
                'name' => 'title_' . $lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= Textarea::get([
                'name' => 'description_' . $lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_one_' . $lang->slug,
                'label' => __('Button One Text'),
                'value' => $widget_saved_values['button_text_one_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_text_two_' . $lang->slug,
                'label' => __('Button Two Text'),
                'value' => $widget_saved_values['button_text_two_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Text::get([
            'name' => 'button_one_url',
            'label' => __('Button One Url'),
            'value' => $widget_saved_values['button_one_url'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'button_two_url',
            'label' => __('Button Two Url'),
            'value' => $widget_saved_values['button_two_url'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
            'dimensions' => '690x950'
        ]);
        $output .= Image::get([
            'name' => 'shape_01',
            'label' => __('Shape 01 Image'),
            'value' => $widget_saved_values['shape_01'] ?? null,
            'dimensions' => '200x200'
        ]);
        $output .= Image::get([
            'name' => 'shape_02',
            'label' => __('Shape 02 Image'),
            'value' => $widget_saved_values['shape_02'] ?? null,
            'dimensions' => '200x200'
        ]);
        $output .= Image::get([
            'name' => 'shape_03',
            'label' => __('Shape 03 Image'),
            'value' => $widget_saved_values['shape_03'] ?? null,
            'dimensions' => '200x200'
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 285,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 450,
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
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();

        $right_image = render_image_markup_by_attachment_id($settings['right_image']);
        $shape_01 = render_image_markup_by_attachment_id($settings['shape_01']);
        $shape_02 = render_image_markup_by_attachment_id($settings['shape_02']);
        $shape_03 = render_image_markup_by_attachment_id($settings['shape_03']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::esc_html($settings['description_'.$current_lang]);
        $button_text_one = SanitizeInput::esc_html($settings['button_text_one_'.$current_lang]);
        $button_text_two = SanitizeInput::esc_html($settings['button_text_two_'.$current_lang]);
        $button_one_url = SanitizeInput::esc_url($settings['button_one_url']);
        $button_two_url = SanitizeInput::esc_url($settings['button_two_url']);
        $header_bottom_image = asset('assets/frontend/img/shape/header-bottom-shape.svg');
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $button_one = '';
        if (!empty($button_text_one) && !empty($button_one_url)){
            $button_one = '<a href="'.$button_one_url.'" class="boxed-btn medical">'.$button_text_one.'</a>';
        }
        $button_two = '';
        if (!empty($button_text_two) && !empty($button_two_url)){
            $button_two = '<a href="'.$button_two_url.'" class="boxed-btn medical blank">'.$button_text_two.'</a>';
        }


        return <<<HTML
<div class="header-area medical-home" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
            <div class="right-image-wrap">
                {$right_image}
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title">{$title}</h1>
                            <p class="description">{$description}</p>
                            <div class="btn-wrapper margin-top-30">
                               {$button_one}
                                {$button_two}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-image-shape">
                <img src="{$header_bottom_image}" alt="header bottom image shape">
            </div>
            <div class="shape image-1">
                {$shape_01}
            </div>
            <div class="shape image-2">
                {$shape_02}
            </div>
            <div class="shape image-3">
                {$shape_03}
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
        return __('Header: 05');
    }
}