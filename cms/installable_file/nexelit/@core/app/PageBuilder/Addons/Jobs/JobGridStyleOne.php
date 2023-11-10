<?php


namespace App\PageBuilder\Addons\Jobs;
use App\Events;
use App\EventsCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\Jobs;
use App\JobsCategory;
use App\PageBuilder\Fields\ColorPicker;
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
use App\Testimonial;
use Illuminate\Support\Str;

class JobGridStyleOne extends PageBuilderBase
{
    public function enable() : bool
    {
        return (boolean) get_static_option('job_module_status');
    }
    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'jobs/grid-01.png';
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
            $categories = JobsCategory::where(['status' => 'publish','lang' => $lang->slug])->get()->pluck('title', 'id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_'.$lang->slug] ?? null,
                'info' => __('you can select category for it, if you want to show all item leave it empty')
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
            'info' => __('enter how many item you want to show in frontend'),
        ]);
        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-6' => __('02 Column'),
                'col-lg-4' => __('03 Column'),
                'col-lg-3' => __('04 Column'),
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

        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? null,
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
        $category = $settings['categories_'.$current_lang] ?? [];

        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        $background_color = SanitizeInput::esc_html($settings['background_color']);
        $background_color = !empty($background_color) ? 'style="background-color:'.$background_color.';"' : '';
        $pagination_alignment = $settings['pagination_alignment'];
        $pagination_status = $settings['pagination_status'] ?? '';
        $columns = SanitizeInput::esc_html($settings['columns']);


        $jobs = Jobs::query()->where(['lang' => $current_lang,'status' => 'publish']);
        if (!empty($category)){
            $jobs->whereIn('category_id', $category);
        }
        $jobs =$jobs->orderBy($order_by,$order);
        if(!empty($items)){
            $jobs = $jobs->paginate($items);
        }else {
            $jobs = $jobs->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$jobs->links().'</div></div>';
        }

        $category_markup = '';
        foreach ($jobs as $job){
            $employment_status = __(str_replace('_',' ',$job->employment_status));
            $route = route('frontend.jobs.single',$job->slug);
            $title = $job->title;
            $company_label = __('Company:');
            $company_name = $job->company_name;
            $deadline_label = __('Deadline:');
            $deadline = date("d M Y", strtotime($job->deadline));
            $position = $job->position;
            $salary = $job->salary;
            $job_location = $job->job_location;

            $category_markup .= <<<HTML
<div class="col-md-12 {$columns}">
   <div class="single-job-list-item margin-bottom-30">
        <span class="job_type"><i class="far fa-clock"></i> {$employment_status}</span>
        <a href="{$route}"><h3 class="title">{$title}</h3></a>
        <span class="company_name"><strong>{$company_label}</strong> {$company_name}</span>
        <span class="deadline"><strong>{$deadline_label}</strong> {$deadline}</span>
        <ul class="jobs-meta">
            <li><i class="fas fa-briefcase"></i> {$position}</li>
            <li><i class="fas fa-wallet"></i> {$salary}</li>
            <li><i class="fas fa-map-marker-alt"></i> {$job_location}</li>
        </ul>
    </div>
</div>
HTML;
        }

        return <<<HTML
<div class="job-post-addon-wrapper" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" {$background_color}>
    <div class="container">
        <div class="row">
               {$category_markup}
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
        return __('Job Post Grid: 01');
    }
}