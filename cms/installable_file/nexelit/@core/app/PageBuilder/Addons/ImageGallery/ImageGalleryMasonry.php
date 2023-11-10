<?php


namespace App\PageBuilder\Addons\ImageGallery;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\ImageGalleryCategory;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\ImageGallery;
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

class ImageGalleryMasonry extends PageBuilderBase
{

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'image-gallery/masonry-01.png';
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
            $categories = ImageGalleryCategory::where(['lang' => $lang->slug,'status' => 'publish'])->get()->pluck('title','id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' =>  __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_' . $lang->slug] ?? null,
                'info' => __('you can select category for case study, if you want to show all case study leave it empty')
            ]);
            $output .= Text::get([
                'name' => 'all_text_'.$lang->slug,
                'label' => __('All Text'),
                'value' => $widget_saved_values['all_text_' . $lang->slug] ?? null,
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
        $output .= Switcher::get([
            'name' => 'filter_menu_status',
            'label' => __('Filter Menu Show/hide'),
            'value' => $widget_saved_values['filter_menu_status'] ?? null,
            'info' => __('your can show/hide filter menu'),
        ]);
        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('Left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set alignment of section title')
        ]);

        $output .= Notice::get([
           'type' => 'secondary',
           'text' => __('Pagination Settings')
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
        ]);
        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Pagination Enable/Disable '),
            'value' => $widget_saved_values['pagination_status'] ?? null,
            'info' => __('your can show/hide pagination'),
        ]);
        $output .= Select::get([
            'name' => 'pagination_alignment',
            'label' => __('Pagination Alignment'),
            'options' => [
                'text-left' => __('Left'),
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
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
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $all_text = SanitizeInput::esc_html($settings['all_text_'.$current_lang]);
        $categories = $settings['categories_'.$current_lang] ?? [];
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $filter_menu_status = $settings['filter_menu_status'] ?? '';
        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';


        $products = \App\ImageGallery::query()->where(['lang' => $current_lang]);
        $products->orderBy($order_by,$order);
       if (!empty($categories)){
           $products->whereIn('cat_id',$categories);
        }
        if(!empty($items)){
            $all_case_study = $products->paginate($items);
        }else{
            $all_case_study =  $products->get();
        }
        
        

        $all_contain_cat = $all_case_study->map(function ($item) { return $item->categories_id;});
        if (!empty($categories)){
            $all_work_category = ImageGalleryCategory::whereIn('id',$all_contain_cat)->get();
        }else{
            $all_work_category = ImageGalleryCategory::where('lang' , LanguageHelper::user_lang_slug())->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$all_case_study->links().'</div></div>';
        }

        $case_study_markup = '';

        foreach ($all_case_study as $item){
            $image_markup = render_image_markup_by_attachment_id($item->image,null,'grid');
            $filter_slug = Str::slug(get_image_category_name_by_id($item->id),'-',$current_lang);
            $title = $item->title;

           $gallery_img = get_attachment_image_by_id($item->image,'full',false);
           $img_url = !empty($gallery_img) ? $gallery_img['img_url'] : '';

            $case_study_markup .= <<<HTML
<div class="col-lg-4 col-md-4 col-sm-6 masonry-item {$filter_slug}">
     <div class="single-gallery-image ">
       {$image_markup}
       <div class="img-hover">
           <a href="{$img_url}" title="{$title}" class="image-popup">
               <i class="fas fa-search"></i>
           </a>
       </div>
    </div>
</div>
HTML;
        }

        $masonry_filter_menu = '';
        if($filter_menu_status){
            $filter_menu_markup = '';
            foreach($all_work_category as $cat){
                $filter_menu_markup .= '<li data-filter=".'.Str::slug($cat->title,'-',$current_lang).'" >'.$cat->title.'</li>';
            }
            $masonry_filter_menu = <<<HTM
 <ul class=" case-studies-menu style-01">
        <li class="active" data-filter="*">{$all_text}</li>
        {$filter_menu_markup}
</ul>
HTM;

        }

        return <<<HTML
<div class="image-gallery-masonry-wrapper" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
    <div class="container">
        <div class="row">
              <div class="col-lg-12">
                  <div class="case-studies-masonry-wrapper">
                        {$masonry_filter_menu}
                        <div class="case-studies-masonry">
                        {$case_study_markup}
                        </div>
                    </div>
              </div>
              {$pagination_markup}
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
        return __('Image Gallery Masonry: 01');
    }
}