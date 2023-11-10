<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LogisticsHomePageController extends Controller
{
    public $portfolio_home_base_view_path = 'backend.pages.home.logistics-home.';
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function header_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'header-area')->with(['all_languages' => $all_languages]);
    }

    public function update_header_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_06_'.$lang->slug.'_header_section_title' => 'required|array',
                'home_page_06_'.$lang->slug.'_header_section_title.*' => 'required|string',
                'home_page_06_'.$lang->slug.'_header_section_description' => 'nullable|array',
                'home_page_06_'.$lang->slug.'_header_section_description.*' => 'nullable|string',
                'home_page_06_'.$lang->slug.'_header_section_button_one_text' => 'nullable|array',
                'home_page_06_'.$lang->slug.'_header_section_button_one_text.*' => 'nullable|string',
                'home_page_06_'.$lang->slug.'_header_section_button_two_text' => 'nullable|array',
                'home_page_06_'.$lang->slug.'_header_section_button_two_text.*' => 'nullable|string',
                'home_page_06_header_section_bg_image' => 'required|array',
                'home_page_06_header_section_bg_image.*' => 'required|string',
                'home_page_06_header_section_button_two_url' => 'nullable|array',
                'home_page_06_header_section_button_two_url.*' => 'nullable|string',
                'home_page_06_header_section_button_one_url' => 'nullable|array',
                'home_page_06_header_section_button_one_url.*' => 'nullable|string',
            ],[
                'home_page_06_'.$lang->slug.'_header_section_title.required' => __('title field is required'),
                'home_page_06_header_section_bg_image.required' => __('image field is required'),
            ]);

            //save repeater values
            $all_fields = [
                'home_page_06_'.$lang->slug.'_header_section_title',
                'home_page_06_'.$lang->slug.'_header_section_description',
                'home_page_06_'.$lang->slug.'_header_section_button_one_text',
                'home_page_06_'.$lang->slug.'_header_section_button_two_text',
                'home_page_06_header_section_bg_image',
                'home_page_06_header_section_button_two_url',
                'home_page_06_header_section_button_one_url'
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
    public function what_we_offer_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'what-we-offer-area')->with(['all_languages' => $all_languages]);
    }

    public function update_what_we_offer_area(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'logistic_what_we_offer_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_what_we_offer_section_'.$lang->slug.'_title' => 'nullable|string',
                'logistic_what_we_offer_section_'.$lang->slug.'_button_text' => 'nullable|string',
                'home_page_01_service_area_items' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'logistic_what_we_offer_section_'.$lang->slug.'_subtitle',
                'logistic_what_we_offer_section_'.$lang->slug.'_title',
                'logistic_what_we_offer_section_'.$lang->slug.'_button_text',
                'home_page_01_service_area_items'
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

    public function video_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'video-area')->with(['all_languages' => $all_languages]);
    }
    public function update_video_area(Request $request){

        $this->validate($request,[
            'portfolio_video_section_background_image' => 'nullable|string',
            'portfolio_video_section_video_url' => 'nullable|string'
        ]);

        //save repeater values
        $all_fields = [
            'portfolio_video_section_background_image',
            'portfolio_video_section_video_url'
        ];
        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function counterup_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'counterup-area')->with(['all_languages' => $all_languages]);
    }
    public function update_counterup_area(Request $request){

        $this->validate($request,[
            'portfolio_counterup_section_background_image' => 'nullable|string'
        ]);

        //save repeater values
        $all_fields = [
            'portfolio_counterup_section_background_image'
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
        return view($this->portfolio_home_base_view_path.'project-area')->with(['all_languages' => $all_languages]);
    }
    public function update_project_area(Request $request){
        $this->validate($request,[
           'home_page_01_case_study_items' => 'nullable|string'
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'logistic_project_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_project_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'logistic_project_section_'.$lang->slug.'_subtitle',
                'logistic_project_section_'.$lang->slug.'_title'
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
    public function quote_faq_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'quote-faq-area')->with(['all_languages' => $all_languages]);
    }

    public function update_quote_faq_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'logistic_faq_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_faq_section_'.$lang->slug.'_title' => 'nullable|string',
                'logistic_quote_section_'.$lang->slug.'_title' => 'nullable|string',
                'logistic_quote_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_quote_section_'.$lang->slug.'_button_text' => 'nullable|string',
                'home_page_06_'.$lang->slug.'_faq_item_title' => 'nullable|array',
                'home_page_06_'.$lang->slug.'_faq_item_title.*' => 'nullable|string',
                'home_page_06_'.$lang->slug.'_faq_item_description' => 'nullable|array',
                'home_page_06_'.$lang->slug.'_faq_item_description.*' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'logistic_faq_section_'.$lang->slug.'_subtitle',
                'logistic_faq_section_'.$lang->slug.'_title',
                'logistic_quote_section_'.$lang->slug.'_title',
                'logistic_quote_section_'.$lang->slug.'_subtitle',
                'logistic_quote_section_'.$lang->slug.'_button_text'
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
            //save repeater values
            $all_fields = [
                'home_page_06_'.$lang->slug.'_faq_item_title',
                'home_page_06_'.$lang->slug.'_faq_item_description',
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

    public function testimonial_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'testimonial-area')->with(['all_languages' => $all_languages]);
    }

    public function update_testimonial_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'logistic_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_testimonial_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'logistic_testimonial_section_'.$lang->slug.'_subtitle',
                'logistic_testimonial_section_'.$lang->slug.'_title'
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
        return view($this->portfolio_home_base_view_path.'news-area')->with(['all_languages' => $all_languages]);
    }

    public function update_news_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'logistic_news_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'logistic_news_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'logistic_news_section_'.$lang->slug.'_subtitle',
                'logistic_news_section_'.$lang->slug.'_title'
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
