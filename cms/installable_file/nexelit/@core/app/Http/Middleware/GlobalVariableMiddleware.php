<?php

namespace App\Http\Middleware;

use App\Blog;
use App\Helpers\LanguageHelper;
use App\Language;
use App\Menu;
use App\SocialIcons;
use App\StaticOption;
use App\Widgets;
use Closure;

class GlobalVariableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = LanguageHelper::user_lang_slug();
        $all_social_item = SocialIcons::all();
        $all_usefull_links = Menu::find(get_static_option('useful_link_'.get_user_lang().'_widget_menu_id'));
        $all_important_links = Menu::find(get_static_option('important_link_'.get_user_lang().'_widget_menu_id'));
        $all_recent_post = Blog::where('lang' ,$lang)->orderBy('id', 'DESC')->take(get_static_option('recent_post_widget_item'))->get();
        $all_language = LanguageHelper::all_languages();
        $primary_menu = Menu::where(['status' => 'default' ,'lang' => $lang])->first();
        $footer_widgets = Widgets::orderBy('widget_order','ASC')->get();

        $popup_id = get_static_option('popup_selected_'.$lang.'_id');

        $popup_details = \App\PopupBuilder::find($popup_id);
        $website_url = url('/');
        if (preg_match('/(xgenious)/',$website_url)){
            $popup_details = \App\PopupBuilder::where('lang',$lang)->inRandomOrder()->first();
        }



        //make a function to call all static option by home page
        $static_option_arr = [
            'testimonial_page_slug',
            'price_plan_page_slug',
            'quote_page_slug',
            'donor_page_slug',
            'team_page_slug',
            'image_gallery_page_slug',
            'clients_feedback_page_slug',
            'feedback_page_slug',
            'service_page_slug',
            'donation_page_slug',
            'support_ticket_page_slug',
            'product_page_slug',
            'blog_page_slug',
            'service_page_slug',
            'about_page_slug',
            'team_page_slug',
            'faq_page_slug',
            'contact_page_slug',
            'career_with_us_page_slug',
            'events_page_slug',
            'knowledgebase_page_slug',
            'work_page_slug',
            'appointment_page_slug',
            'courses_page_slug',
            'product_module_status',
            'site_white_logo',
            'site_google_analytics',
            'og_meta_image_for_site',
            'site_color',
            'site_logo',
            'site_main_color_two',
            'portfolio_home_color',
            'logistics_home_color',
            'industry_home_color',
            'site_secondary_color',
            'site_heading_color',
            'site_paragraph_color',
            'construction_home_color',
            'portfolio_home_dark_color',
            'fruits_home_heading_color',
            'portfolio_home_dark_two_color',
            'charity_home_color',
            'dagency_home_color',
            'cleaning_home_color',
            'cleaning_home_two_color',
            'course_home_color',
            'grocery_home_two_color',
            'course_home_two_color',
            'lawyer_home_color',
            'political_home_color',
            'medical_home_color',
            'medical_home_color_two',
            'grocery_home_color',
            'fruits_home_color',
            'heading_font',
            'heading_font_family',
            'body_font_family',
            'body_font_family',
            'site_rtl_enabled',
            'site_third_party_tracking_code',
            'site_favicon',
            'home_page_variant',
            'item_license_status',
            'site_script_unique_key',
            'site_meta_'.$lang.'_description',
            'site_meta_'.$lang.'_tags',
            'site_'.$lang.'_title',
            'site_'.$lang.'_tag_line',
            'home_page_07_topbar_section_info_item_icon',
            'home_page_07_'.$lang.'_topbar_section_info_item_title',
            'home_page_07_'.$lang.'_topbar_section_info_item_details',
            'language_select_option',
            'navbar_button_custom_url_status',
            'navbar_button',
            'navbar_'.$lang.'_button_text',
        ];
        $static_field_data = StaticOption::whereIn('option_name',$static_option_arr)->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();

        $all_data = [
            'global_static_field_data' => $static_field_data,
            'popup_details' => $popup_details,
            'all_usefull_links'=> $all_usefull_links,
            'all_important_links'=> $all_important_links,
            'all_recent_post'=> $all_recent_post,
            'all_social_item'=> $all_social_item,
            'all_language'=> $all_language,
            'primary_menu'=> optional($primary_menu)->id,
            'footer_widgets'=> $footer_widgets,
            'user_select_lang_slug'=> $lang
        ];
        view()->composer([
            'frontend/*',
            'components/*',
        ], function ($view) use ($all_data){
            $view->with($all_data);
        });

        return $next($request);
    }
}
