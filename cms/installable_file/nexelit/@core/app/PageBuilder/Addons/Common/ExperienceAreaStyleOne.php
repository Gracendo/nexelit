<?php


namespace App\PageBuilder\Addons\Common;


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

class ExperienceAreaStyleOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'experience-area/style-01.png';
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
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Notice::get([
               'type' => 'secondary',
               'text' => __('Vision Settings')
            ]);
            $output .= Text::get([
                'name' => 'vision_title_'.$lang->slug,
                'label' => __('Vision Title'),
                'value' => $widget_saved_values['vision_title_' . $lang->slug] ?? null,
            ]);
            $output .= Summernote::get([
                'name' => 'vision_description_'.$lang->slug,
                'label' => __('Vision Description'),
                'value' => $widget_saved_values['vision_description_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'vision_image_'.$lang->slug,
                'label' => __('Vision Image'),
                'value' => $widget_saved_values['vision_image_' . $lang->slug] ?? null,
            ]);
            $output .= Notice::get([
                'type' => 'secondary',
                'text' => __('Mission Settings')
            ]);
            $output .= Text::get([
                'name' => 'mission_title_'.$lang->slug,
                'label' => __('Mission Title'),
                'value' => $widget_saved_values['mission_title_' . $lang->slug] ?? null,
            ]);
            $output .= Summernote::get([
                'name' => 'mission_description_'.$lang->slug,
                'label' => __('Mission Description'),
                'value' => $widget_saved_values['mission_description_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'mission_image_'.$lang->slug,
                'label' => __('Mission Image'),
                'value' => $widget_saved_values['mission_image_' . $lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Feature List Settings')
        ]);
        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'experience_area_feature_list_repeater_01',
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
            'text' => __('Section Settings')
        ]);
        $output .= ColorPicker::get([
            'name' => 'left_background_color',
            'label' => __('Left Background Color'),
            'value' => $widget_saved_values['left_background_color'] ?? null,
        ]);
        $output .= ColorPicker::get([
            'name' => 'mission_background_color',
            'label' => __('Mission Background Color'),
            'value' => $widget_saved_values['mission_background_color'] ?? null,
        ]);
        $output .= ColorPicker::get([
            'name' => 'vision_background_color',
            'label' => __('Vision Background Color'),
            'value' => $widget_saved_values['vision_background_color'] ?? null,
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
            'value' => $widget_saved_values['padding_bottom'] ?? 20,
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
        $all_settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $title = SanitizeInput::esc_html($all_settings['title_'.$current_lang]);
        $description = SanitizeInput::kses_basic($all_settings['description_'.$current_lang]);
        $mission_title = SanitizeInput::kses_basic($all_settings['mission_title_'.$current_lang]);
        $mission_description = SanitizeInput::kses_basic($all_settings['mission_description_'.$current_lang]);
        $mission_image = SanitizeInput::esc_html($all_settings['mission_image_'.$current_lang]);
        $mission_image = render_background_image_markup_by_attachment_id($mission_image);

        $vision_title = SanitizeInput::kses_basic($all_settings['vision_title_'.$current_lang]);
        $vision_description = SanitizeInput::kses_basic($all_settings['vision_description_'.$current_lang]);
        $vision_image = SanitizeInput::esc_html($all_settings['vision_image_'.$current_lang]);
        $vision_image = render_background_image_markup_by_attachment_id($vision_image);
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);

        $left_background_color = SanitizeInput::esc_html($all_settings['left_background_color']);
        $left_background_color = !empty($left_background_color) ? 'style="background-color: '.$left_background_color.'"' : '';

        $mission_background_color = SanitizeInput::esc_html($all_settings['mission_background_color']);
        $mission_background_color = !empty($mission_background_color) ? 'style="background-color: '.$mission_background_color.'"' : '';

        $vision_background_color = SanitizeInput::esc_html($all_settings['vision_background_color']);
        $vision_background_color = !empty($vision_background_color) ? 'style="background-color: '.$vision_background_color.'"' : '';


        $output = '<div class="our-mission-area" >';
        $output .='<div class="container-fluid p-0">';
        $output .= <<<HTML

HTML;


        $output .= '<div class="row no-gutters">';
        $output .= '<div class="col-lg-6"><div class="our-service-wrappper bg-main " '.$left_background_color.' data-padding-top="'.$padding_top.'" ><div class="section-title white desktop-left" data-padding-bottom="'.$padding_bottom.'">';
        $output .= '<h2 class="title">'.$title.'</h2>';
        $output .= '<div class="m-inherit">'.$description.'</div>';
        $output .= '<div class="service-area-work">';

        $this->args['settings'] = RepeaterField::remove_default_fields($all_settings);

        foreach ($this->args['settings'] as $key => $setting){
            if (is_array($setting)){
                $this->args['repeater'] = $setting;
                $array_lang_item = $setting[array_key_last($setting)];
                if (!empty($array_lang_item) && is_array($array_lang_item) && count($array_lang_item) > 0) {
                    foreach ($array_lang_item as $index => $value) {

                        $output .= $this->render_slider_markup($index); // for multiple array index
                    }
                } else {
                    $output .= $this->render_slider_markup(); // for only one index of array
                }
            }
        }

        $output .= '</div></div> </div> </div>';

        //
        $output .= <<<HTML
<div class="col-lg-6">
    <div class="service-item-wrapper">
        <div class="single-service-item">
            <div class="service-img">
                <div class="bg-image" {$mission_image}></div>
            </div>
            <div class="service-text" {$mission_background_color}>
                <div class="service-text-inner">
                    <h2 class="title">{$mission_title}</h2>
                    <div class="description">{$mission_description}</div>
                </div>
            </div>
        </div>
        <div class="single-service-item">
            <div class="service-text" {$vision_background_color}>
                <div class="service-text-inner">
                    <h2 class="title">{$vision_title}</h2>
                    <div class="description">{$vision_description}</div>
                </div>
            </div>
            <div class="service-img style-01">
                <div class="bg-image" {$vision_image}></div>
            </div>
        </div>
    </div>
</div>
HTML;



        $output .= '</div></div></div>';
        return $output;
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Experience Area: 01');
    }

    private function render_slider_markup(int $index = null): string
    {
        $title = $this->get_repeater_field_value('title', $index, LanguageHelper::user_lang_slug());
        $icon = $this->get_repeater_field_value('icon', $index, LanguageHelper::user_lang_slug());
        return <<<HTML
<div class="single-header-bottom-item-04">
    <div class="icon">
        <i class="{$icon}"></i>
    </div>
    <div class="content">
        <h4 class="title">{$title}</h4>
    </div>
</div>
HTML;

    }


}