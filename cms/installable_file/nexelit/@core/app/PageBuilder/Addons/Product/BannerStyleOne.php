<?php


namespace App\PageBuilder\Addons\Product;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;

class BannerStyleOne extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'product/banner-01.png';
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


        $output .= Image::get([
            'name' => 'left_image',
            'label' => __('Left Banner'),
            'value' => $widget_saved_values['left_image'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'left_image_url',
            'label' => __('Left Banner Url'),
            'value' => $widget_saved_values['left_image_url'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Banner'),
            'value' => $widget_saved_values['right_image'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'right_image_url',
            'label' => __('Right Banner Url'),
            'value' => $widget_saved_values['right_image_url'] ?? null,
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

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $right_image_id = SanitizeInput::esc_html($settings['right_image']);
        $right_image_url = SanitizeInput::esc_html($settings['right_image_url']);
        $right_image_markup = render_image_markup_by_attachment_id($right_image_id,null,'full');

        $left_image_id = SanitizeInput::esc_html($settings['left_image']);
        $left_image_url = SanitizeInput::esc_html($settings['left_image_url']);
        $left_image_markup = render_image_markup_by_attachment_id($left_image_id,null,'full');

        return <<<HTML
<div class="offer-area-wrap" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="offer-item-wrap no-padding">
                        <a href="{$right_image_url}">{$right_image_markup}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="offer-item-wrap no-padding">
                        <a href="{$left_image_url}">{$left_image_markup}</a>
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
        return __('Banner: 01');
    }
}