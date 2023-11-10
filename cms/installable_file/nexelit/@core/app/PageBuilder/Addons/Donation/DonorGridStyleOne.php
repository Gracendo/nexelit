<?php


namespace App\PageBuilder\Addons\Donation;

use App\Course;
use App\CoursesCategory;
use App\Donation;
use App\DonationLogs;
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

class DonorGridStyleOne extends PageBuilderBase
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
        return 'donation/donor-grid-01.png';
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

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
                'amount' => __('Amount'),
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
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';

        $columns = SanitizeInput::esc_html($settings['columns']);

        $donation = DonationLogs::query()->orderBy($order_by, $order);

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
        foreach ($donation as $item) {
            $image = asset('assets/frontend/img/heart.png');
            $title =  ($item->anonymous == 1) ? __('anonymous') : $item->name;
            $donate_text = __('Donate');
            $amount = amount_with_currency_symbol($item->amount);

            $item_markup .= <<<HTML
<div class="{$columns} col-md-6">
    <div class="single-donor-info">
        <div class="thumb">
            {$image}
        </div>
        <div class="content">
            <h4 class="title">{$title} </h4>
            <span class="amount">{$donate_text} {$amount}</span>
        </div>
    </div>
</div>
HTML;
        }

        if (empty($item_markup)){
            $item_markup = '<div class="col-lg-12"><div class="alert alert-warning">'.__('No donor found').'</div></div>';
        }
        return <<<HTML
<div class="donation-list" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" >
    <div class="container">
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
        return __('Donor List: 01');
    }
}