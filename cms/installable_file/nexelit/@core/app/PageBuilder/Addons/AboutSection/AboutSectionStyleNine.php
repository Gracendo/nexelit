<?php


namespace App\PageBuilder\Addons\AboutSection;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
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

class AboutSectionStyleNine extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'about-section/09.png';
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

            $output .= Text::get([
                'name' => 'button_one_text_'.$lang->slug,
                'label' => __('Button One Text'),
                'value' => $widget_saved_values['button_one_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_one_url_'.$lang->slug,
                'label' => __('Button One URL'),
                'value' => $widget_saved_values['button_one_url_' . $lang->slug] ?? null,
            ]);
            $output .= IconPicker::get([
                'name' => 'button_one_icon_'.$lang->slug,
                'label' => __('Button One Icon'),
                'value' => $widget_saved_values['button_one_icon_' . $lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'button_two_text_'.$lang->slug,
                'label' => __('Button Two Text'),
                'value' => $widget_saved_values['button_two_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_two_url_'.$lang->slug,
                'label' => __('Button Two URL'),
                'value' => $widget_saved_values['button_two_url_' . $lang->slug] ?? null,
            ]);
            $output .= IconPicker::get([
                'name' => 'button_two_icon_'.$lang->slug,
                'label' => __('Button Two Icon'),
                'value' => $widget_saved_values['button_two_icon_' . $lang->slug] ?? null,
            ]);

            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Image::get([
            'name' => 'left_image',
            'label' => __('Left Image'),
            'value' => $widget_saved_values['left_image'] ?? null,
            'dimensions' => '450x550px'
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Info Settings'),
        ]);

        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'about_style_nine_repeater_01',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);


        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings'),
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
        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang]);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $description = SanitizeInput::kses_basic($settings['description_'.$current_lang]);

        $button_one_text = SanitizeInput::esc_html($settings['button_one_text_'.$current_lang]);
        $button_one_url = SanitizeInput::esc_url($settings['button_one_url_'.$current_lang]);
        $button_one_icon = SanitizeInput::esc_html($settings['button_one_icon_'.$current_lang]);

        $button_two_text = SanitizeInput::esc_html($settings['button_two_text_'.$current_lang]);
        $button_two_url = SanitizeInput::esc_url($settings['button_two_url_'.$current_lang]);
        $button_two_icon = SanitizeInput::esc_html($settings['button_two_icon_'.$current_lang]);

        $left_image = render_image_markup_by_attachment_id($settings['left_image'],'','full');
        $shape_img = asset('assets/frontend/img/shape/06.png');
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';

        $button_one_markup = '';
        if (!empty($button_one_url) && !empty($button_one_text)){
            $button_icon = $button_one_icon ? '<i class="'.$button_one_icon.'"></i>' : '';
            $button_one_markup = ' <a href="'.$button_one_url.'" class="portfolio-btn">'.$button_one_text.$button_icon.'</a>';
        }

        $button_two_markup = '';
        if (!empty($button_two_url) && !empty($button_two_text)){
            $button_icon = $button_two_icon ? '<i class="'.$button_two_icon.'"></i>' : '';
            $button_two_markup = ' <a href="'.$button_two_url.'" class="portfolio-btn blank">'.$button_two_text.$button_icon.'</a>';
        }


        $repeater_markup = '<ul class="about-info-list">';

        $this->args['settings'] = RepeaterField::remove_default_fields($settings);

        foreach ($this->args['settings'] as $key => $setting){
            if (is_array($setting)){
                $this->args['repeater'] = $setting;
                $array_lang_item = $setting[array_key_last($setting)];
                if (!empty($array_lang_item) && is_array($array_lang_item) && count($array_lang_item) > 0) {
                    foreach ($array_lang_item as $index => $value) {

                        $repeater_markup .= $this->render_info_item_markup($index); // for multiple array index
                    }
                } else {
                    $repeater_markup .= $this->render_info_item_markup(); // for only one index of array
                }
            }
        }
        $repeater_markup .= ' </ul>';



        return <<<HTML
<div class="portfolio-about-us-section dark-section-bg-two" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
       <div class="container">
        <div class="row">
           <div class="col-lg-6">
                <div class="left-content-area">
                    <div class="img-wrapper">
                        <div class="shape-06">
                            <img src="{$shape_img}" alt="">
                        </div>
                       {$left_image}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-area">
                    <span class="subtitle">{$subtitle}</span>
                    <h3 class="title">{$title}</h3>
                    <div class="description">
                        {$description}
                    </div>
                    {$repeater_markup}
                    <div class="button-wrap margin-top-40">
                        {$button_one_markup}
                        {$button_two_markup}
                    </div>
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
        return __('About Area: 09');
    }

    private function render_info_item_markup(int $index)
    {

        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $icon = $this->get_repeater_field_value('icon', $index, LanguageHelper::user_lang_slug());
        return <<<HTML
 <li><i class="{$icon}"></i> {$title}</li>
HTML;

    }

}