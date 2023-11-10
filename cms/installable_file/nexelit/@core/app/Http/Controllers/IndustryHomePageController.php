<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class IndustryHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.industry-home.';
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function header_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'header-area')->with(['all_languages' => $all_languages]);
    }

    public function update_header_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_07_'.$lang->slug.'_header_section_title' => 'required|array',
                'home_page_07_'.$lang->slug.'_header_section_title.*' => 'required|string',
                'home_page_07_'.$lang->slug.'_header_section_description' => 'nullable|array',
                'home_page_07_'.$lang->slug.'_header_section_description.*' => 'nullable|string',
                'home_page_07_'.$lang->slug.'_header_section_button_one_text' => 'nullable|array',
                'home_page_07_'.$lang->slug.'_header_section_button_one_text.*' => 'nullable|string',
                'home_page_07_header_section_bg_image' => 'required|array',
                'home_page_07_header_section_bg_image.*' => 'required|string',
                'home_page_07_header_section_button_one_icon' => 'nullable|array',
                'home_page_07_header_section_button_one_icon.*' => 'nullable|string',
                'home_page_07_header_section_button_one_url' => 'nullable|array',
                'home_page_07_header_section_button_one_url.*' => 'nullable|string',
            ],[
                'home_page_07_'.$lang->slug.'_header_section_title.required' => __('title field is required'),
                'home_page_07_header_section_bg_image.required' => __('image field is required'),
            ]);

            //save repeater values
            $all_fields = [
                'home_page_07_'.$lang->slug.'_header_section_title',
                'home_page_07_'.$lang->slug.'_header_section_description',
                'home_page_07_'.$lang->slug.'_header_section_button_one_text',
                'home_page_07_header_section_bg_image',
                'home_page_07_header_section_button_one_url',
                'home_page_07_header_section_button_one_icon'
            ];
            foreach ($all_fields as $field){
                $field_val = !empty($request->$field) ? $request->$field : [];
                update_static_option($field,serialize($field_val));
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function about_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'about')->with(['all_languages' => $all_languages]);
    }

    public function update_about_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'industry_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'industry_about_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'industry_about_section_'.$lang->slug.'_experience_year_title' => 'nullable|string',
                'industry_about_section_button_one_url' => 'nullable|string',
                'industry_about_section_video_url' => 'nullable|string',
                'industry_about_section_experience_year' => 'nullable|string',
                'industry_about_section_button_one_icon' => 'nullable|string',
                'industry_about_section_left_image' => 'nullable|string',
                'industry_about_section_video_background_image' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_about_section_'.$lang->slug.'_subtitle',
                'industry_about_section_'.$lang->slug.'_title',
                'industry_about_section_'.$lang->slug.'_description',
                'industry_about_section_'.$lang->slug.'_button_one_text',
                'industry_about_section_'.$lang->slug.'_experience_year_title',
                'industry_about_section_button_one_url',
                'industry_about_section_video_url',
                'industry_about_section_experience_year',
                'industry_about_section_button_one_icon',
                'industry_about_section_left_image',
                'industry_about_section_video_background_image',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function service_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'what-we-offer-area')->with(['all_languages' => $all_languages]);
    }

    public function update_service_area(Request $request){
        $this->validate($request,[
           'home_page_01_service_area_items'  => 'nullable'
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_what_we_offer_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_what_we_offer_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_what_we_offer_section_'.$lang->slug.'_subtitle',
                'industry_what_we_offer_section_'.$lang->slug.'_title',
                'industry_what_we_offer_section_'.$lang->slug.'_readmore_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_service_area_items',$request->home_page_01_service_area_items);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function counterup_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'counterup-area')->with(['all_languages' => $all_languages]);
    }

    public function update_counterup_area(Request $request){
        $this->validate($request,[
            'industry_counterup_section_background_image'  => 'nullable'
        ]);

        update_static_option('industry_counterup_section_background_image',$request->industry_counterup_section_background_image);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function our_project_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'project-area')->with(['all_languages' => $all_languages]);
    }

    public function update_our_project_area(Request $request){
        $this->validate($request,[
            'home_page_01_case_study_items'  => 'nullable'
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_project_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_project_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_project_section_'.$lang->slug.'_subtitle',
                'industry_project_section_'.$lang->slug.'_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_case_study_items',$request->home_page_01_case_study_items);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function team_member_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'team-member-area')->with(['all_languages' => $all_languages]);
    }

    public function update_team_member_area(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_team_member_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_team_member_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_team_member_section_'.$lang->slug.'_subtitle',
                'industry_team_member_section_'.$lang->slug.'_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_team_member_items',$request->home_page_01_team_member_items);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function testimonial_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'testimonial-area')->with(['all_languages' => $all_languages]);
    }
    public function update_testimonial_area(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_testimonial_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_testimonial_section_'.$lang->slug.'_subtitle',
                'industry_testimonial_section_'.$lang->slug.'_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function news_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'news-area')->with(['all_languages' => $all_languages]);
    }

    public function update_news_area(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'industry_news_area_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'industry_news_area_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'industry_news_area_section_'.$lang->slug.'_subtitle',
                'industry_news_area_section_'.$lang->slug.'_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
}
