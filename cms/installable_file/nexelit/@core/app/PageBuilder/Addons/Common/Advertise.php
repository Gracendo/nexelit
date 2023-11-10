<?php


namespace App\PageBuilder\Addons\Common;
use App\Advertisement;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\PageBuilderBase;

class Advertise extends PageBuilderBase
{

    public function preview_image()
    {
       return 'common/add.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Select::get([
            'name' => 'advertisement_type',
            'label' => __('Advertisement Type'),
            'class'=> 'backend_addon_advertisement_type',
            'options' => [
                'image' => __('Image'),
                'google_adsense' => __('Google Adsense'),
                'scripts' => __('Scripts'),
            ],
            'value' => $widget_saved_values['advertisement_type'] ?? null,
            'info' => __('set advertisement_type')
        ]);

        $output .= Select::get([
            'name' => 'advertisement_size',
            'label' => __('Advertisement Size'),
            'options' => [
                '350*250' => __('300 x 250'),
                '320*50' => __('320 x 50'),
                '160*600' => __('160 x 600'),
                '300*600' => __('300 x 600'),
                '336*280' => __('336 x 280'),
                '728*90' => __('728 x 90'),
                '730*180' => __('730 X 180'),
                '730*210' => __('730 X 210'),
                '300*1050' => __('300 X 1050'),
                '950*160' => __('950 X 160'),
                '950*200' => __('950 X 200'),
                '250*1110' => __('250 X 1110'),
            ],
            'value' => $widget_saved_values['advertisement_size'] ?? null,
            'info' => __('set Advertisement Size')
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
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);

        $advertisement_type = SanitizeInput::esc_html($all_settings['advertisement_type']);
        $advertisement_size = SanitizeInput::esc_html($all_settings['advertisement_size']);


        $add_query = Advertisement::select('id','type','image','slot','status','redirect_url','embed_code','title');
        if (!empty($advertisement_type)){
            $add_query = $add_query->where('type',$advertisement_type);
        }

        if (!empty($advertisement_size)){
            $add_query = $add_query->where('size',$advertisement_size);
        }

        $add = $add_query->where('status',1)->inRandomOrder()->first();

        $image_markup = render_image_markup_by_attachment_id($add->image,null,'full');
        $redirect_url = SanitizeInput::esc_url($add->redirect_url);
        $slot = $add->slot;
        $embed_code = $add->embed_code;

        $add_markup = '';
        if ($add->type === 'image'){
            $add_markup.= '<a href="'.$redirect_url.'">'.$image_markup.'</a>';
        }elseif($add->type === 'google_adsense'){
            $add_markup.= $this->script_add($slot);
        }else{
            $add_markup.= '<div>'.$embed_code.'</div>';
        }

   return <<<HTML

<div class="banner-ads-area home-20  wow animated zoomIn" data-wow-delay=".3s" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
       <input type="hidden" id="add_id" value="$add->id"> 
        <div class="single-banner-ads center-text">
           {$add_markup}
        </div>
    </div>

HTML;

    }

    public function addon_title()
    {
        return __('Advertisement : 01');
    }

    private function script_add($slot){
        $google_adsense_publisher_id = get_static_option('google_adsense_publisher_id');
        return <<<HTML
            <div>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="{$google_adsense_publisher_id}"
                 data-ad-slot="{$slot}"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>
    HTML;
    }
}