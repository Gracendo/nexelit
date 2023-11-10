<?php


namespace App\PageBuilder\Addons\CaseStudy;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\ProductRatings;
use App\Products;
use App\Works;
use App\WorksCategory;
use Illuminate\Support\Str;

class CaseStudySliderFour extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'case-study/slider-04.png';
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
            $categories = WorksCategory::where(['lang' => $lang->slug,'status' => 'publish'])->get()->pluck('name','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' =>  __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_' . $lang->slug] ?? null,
                'info' => __('you can select category for case study, if you want to show all case study leave it empty')
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all'),
        ]);
        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Items'),
            'value' => $widget_saved_values['slider_items'] ?? 2,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings')
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

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $categories = $settings['categories_'.$current_lang] ?? [];
        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang]);
        $section_title = SanitizeInput::esc_html($settings['title_'.$current_lang]);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);


        $products = Works::query()->where(['lang' => $current_lang,'status' => 'publish']);
        $products->orderBy($order_by,$order);
        if(!empty($items)){
            $all_case_study = $products->paginate($items);
        }else{
            $all_case_study =  $products->get();
        }
        
        if (!empty($categories)){
          $all_case_study =  $all_case_study->filter(function ($item) use ($categories){
              $un_array = $item->categories_id;
              if (array_intersect($un_array,$categories)){
                return $item;
              }
          });
        }


        $case_study_markup = '';

        foreach ($all_case_study as $item){
            $route = route('frontend.work.single',$item->slug);
            $image_markup = render_image_markup_by_attachment_id($item->image,'','large');
            $title = $item->title;

            $cat_markup = '';
            $all_cats = get_work_category_by_id($item->id);
            foreach($all_cats as $cat_id => $name){
                $cat_markup .= '<a href="'.route('frontend.works.category',['id' => $cat_id,'any' =>  Str::slug($name)]).'">'.$name.'</a>';
            }

            $case_study_markup .= <<<HTML
<div class="industry-single-case-studies-item industry-home">
    <div class="thumb">
         {$image_markup}
        <div class="content">
            <div class="cat">{$cat_markup}</div>
            <h4 class="title"><a href="{$route}"> {$title}</a></h4>
        </div>
    </div>
</div>
HTML;
        }

        $rand_number = random_int(9,666666);
        return <<<HTML
<div class="industry-project-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title margin-bottom-60 industry-home">
                    <span class="subtitle">{$subtitle}</span>
                    <h2 class="title">{$section_title}</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="project-carousel-nav rand_{$rand_number}"></div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="global-carousel-init logistic-dots" 
                        data-loop="true" 
                        data-desktopitem="{$slider_items}" 
                        data-mobileitem="1" 
                        data-tabletitem="1" 
                        data-nav="true" 
                        data-dots="true" 
                        data-autoplay="true" 
                        data-navcontainer=".rand_{$rand_number}"
                        data-margin="30"
                        >
                         {$case_study_markup}               
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
        return __('Case Study Slider: 04');
    }
}