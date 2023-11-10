<?php


namespace App\PageBuilder\Addons\Donation;

use App\Course;
use App\CoursesCategory;
use App\Donation;
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
use App\ServiceCategory;
use App\Services;
use Illuminate\Support\Str;

class DonationGridStyleOne extends PageBuilderBase
{

    public function enable() : bool
    {
        return (boolean) get_static_option('donations_module_status');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
        return 'donation/grid-01.png';
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
                'name' => 'section_title_' . $lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'section_subtitle_' . $lang->slug,
                'label' => __('Section Subtitle'),
                'value' => $widget_saved_values['section_subtitle_' . $lang->slug] ?? null,
            ]);
            $categories = Donation::where(['lang' =>  $lang->slug,'status' => 'publish'])->get()->pluck('title', 'id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'donations_' . $lang->slug,
                'multiple' => true,
                'label' => __('Donations'),
                'placeholder' => __('Select Donation'),
                'options' => $categories,
                'value' => $widget_saved_values['donations_' . $lang->slug] ?? null,
                'info' => __('you can select donations, if you want to show all leave it empty')
            ]);

            $output .= Text::get([
                'name' => 'goal_text_' . $lang->slug,
                'label' => __('Goal Text'),
                'value' => $widget_saved_values['goal_text_' . $lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'raise_text_' . $lang->slug,
                'label' => __('Raise Text'),
                'value' => $widget_saved_values['raise_text_' . $lang->slug] ?? null,
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
                'raised' => __('Raised'),
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
            'info' => __('enter how many item you want to show in frontend'),
        ]);
        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-4' => __('03 Column'),
                'col-lg-3' => __('04 Column'),
                'col-lg-6' => __('02 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);
        $output .= Notice::get([
           'type' => 'secondary',
           'text' => __('Pagination Settings')
        ]);
        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Enable/Disable Pagination'),
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
        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Section Settings')
        ]);
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
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
        //have to work on it.
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $section_subtitle = SanitizeInput::esc_html($settings['section_subtitle_' . $current_lang]);
        $section_title = SanitizeInput::esc_html($settings['section_title_' . $current_lang]);
        $goal_text = SanitizeInput::esc_html($settings['goal_text_' . $current_lang]);
        $raise_text = SanitizeInput::esc_html($settings['raise_text_' . $current_lang]);
        $donation_ids = $settings['donations_' . $current_lang] ?? [];
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $background_image = SanitizeInput::esc_html($settings['background_image']);
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $background_image = render_background_image_markup_by_attachment_id($background_image);
        $columns = SanitizeInput::esc_html($settings['columns']);

        $donation = Donation::query()->where(['status' => 'publish','lang' => $current_lang])->orderBy($order_by, $order);

        if (!empty($donation_ids)) {
            $donation->whereIn('id', $donation_ids);
        }
        if (!empty($items)) {
            $donation = $donation->paginate($items);
        }else{
            $donation = $donation->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$donation->links().'</div></div>';
        }

        $item_markup = '';
        $a = 1;
        foreach ($donation as $item) {
            $route = route('frontend.donations.single', $item->slug);
            $image = render_image_markup_by_attachment_id($item->image);
            $title = SanitizeInput::esc_html($item->title);
            $excerpt = Str::words(strip_tags($item->donation_content),20);
            $percentage = get_percentage($item->amount,$item->raised);

            $raised_amount =  !empty($item->raised) ? amount_with_currency_symbol($item->raised) :  amount_with_currency_symbol(0);
            $goal_amount = amount_with_currency_symbol($item->amount);

            $item_markup .= <<<HTML
<div class="{$columns} col-md-6">
   <div class="single-popular-cause-item margin-bottom-30">
        <div class="thumb">
            {$image}
        </div>
        <div class="content">
            <a href="{$route}"><h4 class="title">{$title}</h4></a>
            <p>{$excerpt}</p>
            <div class="thumb-content">
                <div class="progress-item">
                    <div class="donation-progress style-{$a}" data-percent="{$percentage}"></div>
                </div>
                <div class="goal">
                    <h4 class="raised"><span>{$raise_text}:</span>  {$raised_amount}</h4>
                    <h4 class="raised"><span>{$goal_text}:</span> {$goal_amount} </h4>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
            $a++;
        }

        $section_title_markup = '';
        if (!empty($section_title)) {
            $section_title_markup .= <<<HTML
<div class="row justify-content-between ">
   <div class="col-lg-12">
       <div class="section-title desktop-center margin-bottom-60 charity-home">
            <span class="subtitle">{$section_subtitle}</span>
            <h2 class="title">{$section_title}</h2>
       </div>
   </div>
</div>
HTML;
        }

        return <<<HTML
<div class="latest-cause-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_image}>
    <div class="container">
        {$section_title_markup}
        <div class="row">
            {$item_markup}
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
        return __('Donation Grid: 01');
    }
}