<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home_01_brand_logos_area(){
        $all_languages = Language::all();
        return view('backend.pages.home.home-01.brand-logo-area')->with(['all_languages' => $all_languages]);
    }
    public function home_01_update_brand_logos_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_brand_logo_area_title' => 'nullable|string',
            ]);
            $brand_logo_area_title = 'home_page_01_'.$lang->slug.'_brand_logo_area_title';
            update_static_option($brand_logo_area_title,$request->$brand_logo_area_title);

        }
        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function home_01_about_us(){
        return view('backend.pages.home.home-01.about-us');
    }

    public function home_01_update_about_us(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_about_us_title' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_video_url' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_quote_text' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_our_mission_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_our_mission_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_our_vision_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_our_vision_description' => 'nullable|string',
            ]);
            $save_data = [
                'home_page_01_'.$lang->slug.'_about_us_title',
                'home_page_01_'.$lang->slug.'_about_us_video_url',
                'home_page_01_'.$lang->slug.'_about_us_description',
                'home_page_01_'.$lang->slug.'_about_us_quote_text',
                'home_page_01_'.$lang->slug.'_about_us_our_mission_title',
                'home_page_01_'.$lang->slug.'_about_us_our_mission_description',
                'home_page_01_'.$lang->slug.'_about_us_our_vision_title',
                'home_page_01_'.$lang->slug.'_about_us_our_vision_description',
                'home_page_01_about_us_video_background_image',
                'home_page_02_about_us_video_background_image',
                'home_page_02_about_us_signature_image',
                'home_page_03_about_us_image_one',
                'home_page_03_about_us_image_two',
                'home_page_04_about_us_our_mission_image',
                'home_page_04_about_us_our_vision_image',
            ];
            foreach ($save_data as $item){
                if (empty($request->$item)){continue;}
                update_static_option($item,$request->$item);
            }
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_testimonial(){
        $all_languages = Language::all();
        return view('backend.pages.home.home-01.testimonial')->with(['all_languages' => $all_languages]);
    }
    public function home_01_update_testimonial(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_testimonial_section_title' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_testimonial_section_title';

            update_static_option($field_name,$request->$field_name);
        }
        update_static_option('home_03_testimonial_bg',$request->home_03_testimonial_bg);
        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function home_01_latest_news(){
        $all_language = Language::all();
        return view('backend.pages.home.home-01.latest-news')->with(['all_languages' => $all_language]);
    }
    public function home_01_update_latest_news(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_latest_news_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_latest_news_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_latest_news_title';
            $field_two = 'home_page_01_'.$lang->slug.'_latest_news_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_two,$request->$field_two);
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }


    public function home_01_service_area(){
        return view('backend.pages.home.home-01.service-area');
    }
    public function home_01_update_service_area(Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items' => 'required|string',
            'home_page_01_service_area_background_image' => 'nullable|string|max:191',
            'home_page_01_service_area_item_type' => 'required|string|max:191',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_service_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_service_area_description' => 'nullable|string'
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_service_area_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_service_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }
        update_static_option('home_page_01_service_area_item_type', $request->home_page_01_service_area_item_type);
        update_static_option('home_page_01_service_area_items', $request->home_page_01_service_area_items);
        update_static_option('home_page_01_service_area_background_image', $request->home_page_01_service_area_background_image);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_case_study_area(){
        return view('backend.pages.home.home-01.case-study');
    }
    public function home_01_update_case_study_area(Request $request){
        $this->validate($request,[
           'home_page_01_case_study_items' => 'nullable|string',
           'home_page_02_case_study_background_image' => 'nullable|string'
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_case_study_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_case_study_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_case_study_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_case_study_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }

        update_static_option('home_page_01_case_study_items',$request->home_page_01_case_study_items);
        update_static_option('home_page_02_case_study_background_image',$request->home_page_02_case_study_background_image);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }



    public function home_01_section_manage(){
        return view('backend.pages.section-manage');
    }
    public function home_01_update_section_manage(Request $request){

        $this->validate($request,[
                'home_page_key_feature_section_status' => 'nullable|string',
                'home_page_about_us_section_status' => 'nullable|string',
                'home_page_counterup_section_status' => 'nullable|string',
                'home_page_service_section_status' => 'nullable|string',
                'home_page_case_study_section_status' => 'nullable|string',
                'home_page_testimonial_section_status' => 'nullable|string',
                'home_page_latest_news_section_status' => 'nullable|string',
                'home_page_brand_logo_section_status' => 'nullable|string',
                'home_page_support_bar_section_status' => 'nullable|string',
                'home_page_price_plan_section_status' => 'nullable|string',
                'home_page_team_member_section_status' => 'nullable|string',
                'home_page_call_to_action_section_status' => 'nullable|string',
                'home_page_quality_section_status' => 'nullable|string',
                'home_page_contact_section_status' => 'nullable|string',
                'home_page_donation_cause_section_status' => 'nullable|string',
                'home_page_all_courses_section_status' => 'nullable|string',
                'home_page_product_category_section_status' => 'nullable|string',
            ]);

            $section_list = [
              'home_page_call_to_action_section_status',
              'home_page_appointment_section_status',
              'home_page_about_us_section_status',
              'home_page_service_section_status',
              'home_page_key_feature_section_status',
              'home_page_counterup_section_status',
              'home_page_case_study_section_status',
              'home_page_testimonial_section_status',
              'home_page_latest_news_section_status',
              'home_page_brand_logo_section_status',
              'home_page_support_bar_section_status',
              'home_page_price_plan_section_status',
              'home_page_team_member_section_status',
              'home_page_quality_section_status',
              'home_page_contact_section_status',
              'home_page_quote_faq_section_status',
              'home_page_video_section_status',
              'home_page_expertice_section_status',
              'home_page_event_section_status',
              'home_page_donation_cause_section_status',
              'home_page_work_process_section_status',
              'home_page_top_selling_section_status',
              'home_page_online_store_section_status',
              'home_page_process_section_status',
              'home_page_offer_section_status',
              'home_page_featured_fruit_section_status',
              'home_page_all_courses_section_status',
              'home_page_featured_courses_section_status',
              'home_page_our_speciality_section_status',
              'home_page_course_category_section_status',
              'home_page_product_category_section_status',
            ];

            foreach($section_list as $section){
                update_static_option($section,$request->$section);
            }


        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_price_plan(){
        return view('backend.pages.home.home-01.price-plan');
    }
    public function home_01_update_price_plan(Request $request){

        $this->validate($request,[
            'home_page_01_price_plan_section_items' => 'required|string',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_price_plan_section_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_price_plan_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_price_plan_section_title';
            $_price_plan_section_description = 'home_page_01_'.$lang->slug.'_price_plan_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($_price_plan_section_description,$request->$_price_plan_section_description);
        }

        update_static_option('home_page_01_price_plan_section_items',$request->home_page_01_price_plan_section_items);
        update_static_option('home_page_01_price_plan_background_image',$request->home_page_01_price_plan_background_image);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_team_member(){
        return view('backend.pages.home.home-01.team-member');
    }
    public function home_01_update_team_member(Request $request){
        $this->validate($request,[
            'home_page_01_team_member_items' => 'nullable|string'
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_team_member_section_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_team_member_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_team_member_section_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_team_member_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }
        update_static_option('home_page_01_team_member_items',$request->home_page_01_team_member_items);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_newsletter()
    {
        return view('backend.pages.home.home-01.newsletter');
    }

    public function home_01_update_newsletter(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_newsletter_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_newsletter_area_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_newsletter_area_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_newsletter_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_cta_area(){
        return view('backend.pages.home.home-01.cta-area');
    }
    public function home_01_update_cta_area(Request $request){
        $this->validate($request,[
           'home_page_01_cta_area_button_url' => 'nullable|string'
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_cta_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
            ]);

            $_cta_area_title = 'home_page_01_'.$lang->slug.'_cta_area_title';
            $_cta_area_button_status = 'home_page_01_'.$lang->slug.'_cta_area_button_status';
            $_cta_area_button_title = 'home_page_01_'.$lang->slug.'_cta_area_button_title';

            update_static_option($_cta_area_button_title,$request->$_cta_area_button_title);
            update_static_option($_cta_area_title,$request->$_cta_area_title);
            update_static_option($_cta_area_button_status,$request->$_cta_area_button_status);
        }
        update_static_option('home_page_01_cta_area_button_url',$request->home_page_01_cta_area_button_url);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_contact_area(){
        return view('backend.pages.home.home-01.contact-area');
    }
    public function home_01_update_contact_area(Request $request){

        $this->validate($request,[
            'home_page_01_contact_area_map_location' => 'required|string|max:191'
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_contact_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_contact_area_button_text' => 'nullable|string'
            ]);

            $contact_area_title = 'home_page_01_'.$lang->slug.'_contact_area_title';
            $contact_area_button_text = 'home_page_01_'.$lang->slug.'_contact_area_button_text';

            update_static_option($contact_area_title,$request->$contact_area_title);
            update_static_option($contact_area_button_text,$request->$contact_area_button_text);
        }

        update_static_option('home_page_01_contact_area_map_location', $request->home_page_01_contact_area_map_location);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function home_01_quality_area(){
        $all_language = Language::all();
        return view('backend.pages.home.home-01.quality-area')->with(['all_languages' => $all_language]);
    }
    public function home_01_update_quality_area(Request $request){

        $this->validate($request,[
            'home_page_01_quality_area_background_image' => 'nullable|string',
            'home_page_02_quality_area_image' => 'nullable|string',
            'home_page_04_quality_area_image' => 'nullable|string',
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_quality_area_button_url' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_quality_area_button_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_quality_area_button_status' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_quality_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_quality_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_quality_area_list' => 'nullable|string',
            ]);

            $fields = [
                'home_page_01_'.$lang->slug.'_quality_area_title',
                'home_page_01_'.$lang->slug.'_quality_area_description',
                'home_page_01_'.$lang->slug.'_quality_area_button_status',
                'home_page_01_'.$lang->slug.'_quality_area_button_title',
                'home_page_01_'.$lang->slug.'_quality_area_button_url',
                'home_page_01_'.$lang->slug.'_quality_area_list'
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }

        }
        if (!empty($request->home_page_01_quality_area_background_image)){
            update_static_option('home_page_01_quality_area_background_image',$request->home_page_01_quality_area_background_image);
        }
        if (!empty($request->home_page_02_quality_area_image)){
            update_static_option('home_page_02_quality_area_image',$request->home_page_02_quality_area_image);
        }
        if (!empty($request->home_page_04_quality_area_image)){
            update_static_option('home_page_04_quality_area_image',$request->home_page_04_quality_area_image);
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
}
