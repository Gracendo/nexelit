<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class ConstructionHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.construction.';
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function header_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'header')->with(['all_languages' => $all_languages]);
    }

    public function update_header_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_header_section_'.$lang->slug.'_title' => 'nullable|string',
                'construction_header_section_'.$lang->slug.'_description' => 'nullable|string',
                'construction_header_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'construction_header_section_button_one_url' => 'nullable|string',
                'construction_header_section_button_one_icon' => 'nullable|string',
                'construction_header_section_bg_image' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_header_section_'.$lang->slug.'_title',
                'construction_header_section_'.$lang->slug.'_description' ,
                'construction_header_section_'.$lang->slug.'_button_one_text',
                'construction_header_section_button_one_url' ,
                'construction_header_section_button_one_icon',
                'construction_header_section_bg_image'
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

    public function about_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'about')->with(['all_languages' => $all_languages]);
    }

    public function update_about_area(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'construction_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'construction_about_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'construction_about_section_'.$lang->slug.'_experience_year_title' => 'nullable|string',
                'construction_about_section_button_one_url' => 'nullable|string',
                'construction_about_section_video_url' => 'nullable|string',
                'construction_about_section_experience_year' => 'nullable|string',
                'construction_about_section_button_one_icon' => 'nullable|string',
                'construction_about_section_left_image' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_about_section_'.$lang->slug.'_subtitle',
                'construction_about_section_'.$lang->slug.'_title',
                'construction_about_section_'.$lang->slug.'_description' ,
                'construction_about_section_'.$lang->slug.'_button_one_text',
                'construction_about_section_'.$lang->slug.'_experience_year_title',
                'construction_about_section_button_one_url',
                'construction_about_section_video_url',
                'construction_about_section_experience_year',
                'construction_about_section_button_one_icon',
                'construction_about_section_left_image'
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


    public function what_we_offer_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'what-we-offer-area')->with(['all_languages' => $all_languages]);
    }

    public function update_what_we_offer_area(Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items' => 'nullable'
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_what_we_offer_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_what_we_offer_section_'.$lang->slug.'_title' => 'nullable|string',
                'construction_what_we_offer_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_what_we_offer_section_'.$lang->slug.'_subtitle',
                'construction_what_we_offer_section_'.$lang->slug.'_title',
                'construction_what_we_offer_section_'.$lang->slug.'_button_text',
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

    public function quote_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'quote-area')->with(['all_languages' => $all_languages]);
    }

    public function update_quote_area(Request $request){
        $this->validate($request,[
            'construction_quote_section__button_icon' => 'nullable',
            'construction_quote_section_bg_image' => 'nullable',
            'construction_quote_section_right_image' => 'nullable',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_quote_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_quote_section_'.$lang->slug.'_title' => 'nullable|string',
                'construction_quote_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_quote_section_'.$lang->slug.'_subtitle',
                'construction_quote_section_'.$lang->slug.'_title',
                'construction_quote_section_'.$lang->slug.'_button_text',
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        $all_fields = [
            'construction_quote_section__button_icon',
            'construction_quote_section_bg_image',
            'construction_quote_section_right_image'
        ];
        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function project_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'project-area')->with(['all_languages' => $all_languages]);
    }

    public function update_project_area(Request $request){
        $this->validate($request,[
            'home_page_01_case_study_items' => 'nullable',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_project_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_project_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_project_section_'.$lang->slug.'_subtitle',
                'construction_project_section_'.$lang->slug.'_title',
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
        $this->validate($request,[
            'home_page_01_team_member_items' => 'nullable',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_team_member_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_team_member_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_team_member_section_'.$lang->slug.'_subtitle',
                'construction_team_member_section_'.$lang->slug.'_title',
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

    public function testimonial_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'testimonial-area')->with(['all_languages' => $all_languages]);
    }

    public function update_testimonial_area(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'construction_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_testimonial_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_testimonial_section_'.$lang->slug.'_subtitle',
                'construction_testimonial_section_'.$lang->slug.'_title',
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
                'construction_news_area_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'construction_news_area_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'construction_news_area_section_'.$lang->slug.'_subtitle',
                'construction_news_area_section_'.$lang->slug.'_title',
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
