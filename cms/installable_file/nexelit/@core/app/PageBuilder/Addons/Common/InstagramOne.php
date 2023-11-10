<?php


namespace App\PageBuilder\Addons\Common;
use App\Advertisement;
use App\Facades\InstagramFeed;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Support\Facades\Cache;

class InstagramOne extends PageBuilderBase
{

    public function preview_image()
    {
       return 'common/instagram-01.png';
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
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Number::get([
            'name' => 'instagram_item_show',
            'label' => __('Item Show'),
            'value' => $widget_saved_values['instagram_item_show'] ?? null,
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


    public function frontend_render()
    {
        $all_settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);

        $title = SanitizeInput::esc_html($all_settings['title_'.$current_lang]);


        $post_items = $all_settings['instagram_item_show'];
        $instagram_data = Cache::remember('instagram_feed_addon',now()->addDay(2),function () use($post_items) {
            $insta_data = InstagramFeed::fetch($post_items);
            return $insta_data ?? [];
        });

        if (!$instagram_data) {
            return '';
        }

        $markup = '';
        foreach($instagram_data->data ?? [] as $insta){

    $markup.= <<<ITEM
        <div class="single-instagram">
            <div class="instagram-image radius-10">
                <a href="{$insta->permalink}" target="_blank">
                    <img src="{$insta->media_url}" alt="">
                </a>
                <a href="{$insta->permalink}" class="icon color-three radius-5" target="_blank"> <i class="fab fa-instagram"></i> </a>
            </div>
        </div>
ITEM;
 }

return <<<HTML

<div class="instagram-area home-19" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> {$title} </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="instagram-wrapper">
                    <div class="global-slick-init instagram-slider nav-style-one nav-color-three dot-style-one dot-color-three slider-inner-margin" data-infinite="true" data-arrows="true" data-dots="false" data-swipeToSlide="true" data-autoplaySpeed="3000" data-autoplay="true"
                         data-slidesToShow="6" data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 5}},{"breakpoint": 1400,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768, "settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"arrows":false, "dots": true, "slidesToShow": 2}} ]'>
                            {$markup}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


HTML;

    }

    public function addon_title()
    {
        return __('Instagram : 01');
    }

}