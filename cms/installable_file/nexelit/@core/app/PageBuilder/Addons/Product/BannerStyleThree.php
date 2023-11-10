<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;

class BannerStyleThree extends PageBuilderBase
{

    public function preview_image()
    {
       return 'product/banner-03.png';
    }

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
                'value' => $widget_saved_values['title_'.$lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['subtitle_'.$lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_'.$lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button URL'),
            'value' => $widget_saved_values['button_url'] ?? null,
        ]);


        $output .= Image::get([
            'name' => 'left_image',
            'label' => __('Left Image'),
            'value' => $widget_saved_values['left_image'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 200,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
            'max' => 200,
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();

        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang]);
        $button_text = SanitizeInput::esc_html($settings['button_text_'.$current_lang]);
        $button_url = SanitizeInput::esc_html($settings['button_url']);

        $image_id_left = SanitizeInput::esc_html($settings['left_image']);
        $image_id_right = SanitizeInput::esc_html($settings['right_image']);

        $image_markup_left = render_image_markup_by_attachment_id($image_id_left,null,'full');
        $image_markup_right = render_image_markup_by_attachment_id($image_id_right,null,'full');

return <<<HTML
<section class="clothing-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="clothing-wrapper bg-item-two">
                    <div class="clothing-thumb">
                      {$image_markup_left}
                      {$image_markup_right}
                    </div>
                    <div class="clothing-contents center-text">
                        <span class="percent-discount color-three fs-22 fw-500"> {$title} </span>
                        <h2 class="clothing-title"> {$subtitle} </h2>
                        <div class="btn-wrapper mt-4 mt-lg-5">
                            <a href="{$button_url}" class="cmn-btn btn-bg-3">{$button_text}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;
}

    public function addon_title()
    {
        return __('Banner: 03');
    }
}