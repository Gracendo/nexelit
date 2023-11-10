<?php


namespace App\PageBuilder\Addons\Common;

use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class PromoAreaOne extends PageBuilderBase
{
    use RepeaterHelper;

    public function preview_image()
    {
        return 'common/promo-area-01.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'promo_area_one',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title_url',
                    'label' => __('Title URL')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'subtitle',
                    'label' => __('Subtitle')
                ],

                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon'),
                ],
            ]
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 100,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 100,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);

        $repeater_data = $all_settings['promo_area_one'] ?? [];
        $item_markup = '';
        foreach ($repeater_data['title_'.$current_lang] as $key => $item){

            $title = $item ?? '';
            $title_url = $repeater_data['title_url_'.$current_lang][$key] ?? '';
            $subtitle = $repeater_data['subtitle_'.$current_lang][$key] ?? '';
            $icon = $repeater_data['icon_'.$current_lang][$key] ?? '';

 $item_markup.= <<<ITEM
  <div class="col-xxl-3 col-xl-3 col-md-6 promo-child mt-4">
        <div class="single-promo no-shadow border-1">
            <div class="promo-inner">
                <div class="icon color-three">
                    <i class="{$icon}"></i>
                </div>
                <div class="contents">
                    <h4 class="common-title hover-color-three"> <a href="{$title_url}"> {$title}</a> </h4>
                    <p class="common-para"> {$subtitle} </p>
                </div>
            </div>
        </div>
    </div>
ITEM;
}


return <<<HTML

    <section class="promo-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container container-one">
            <div class="row">
               {$item_markup}
            </div>
        </div>
    </section>

HTML;

}

  public function addon_title()
    {
        return __('Promo Area: 01');
    }


}