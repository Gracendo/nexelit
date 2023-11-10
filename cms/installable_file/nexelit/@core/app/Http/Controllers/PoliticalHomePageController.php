<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class PoliticalHomePageController extends Controller
{
    public $all_language;
    public $base_path = 'backend.pages.home.political.';

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->all_language = Language::all();
    }

    public function header_area(){
        return view($this->base_path.'header-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_header_area(Request $request){

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'political_home_page_header_'.$lang->slug.'_title' => 'nullable|string',
                'political_home_page_header_'.$lang->slug.'_description' => 'nullable|string',
                'political_home_page_header_'.$lang->slug.'_button_text' => 'nullable|string',
                'political_home_page_header_background_image' => 'nullable|string',
                'political_home_page_header_left_image' => 'nullable|string',
                'political_home_page_header_button_url' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'political_home_page_header_'.$lang->slug.'_title',
                'political_home_page_header_'.$lang->slug.'_description',
                'political_home_page_header_'.$lang->slug.'_button_text',
                'political_home_page_header_button_url' ,
                'political_home_page_header_left_image',
                'political_home_page_header_background_image'
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

    public function key_feature_area(){
        return view($this->base_path.'key-features-area')->with(['all_languages' => $this->all_language]);
    }
    public function update_key_feature_area(Request $request){

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_key_features_item_title' => 'nullable|array',
                'home_page_11_key_features_section_icon' => 'array|required',
                'home_page_11_key_features_section_icon.*' => 'string|required',
            ]);

            //save repeater values
            $all_fields = [
                'home_page_11_'.$lang->slug.'_key_features_item_title',
                'home_page_11_key_features_section_icon' ,
            ];
            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function about_area(){
        return view($this->base_path.'about')->with(['all_languages' => $this->all_language]);
    }

    public function update_about_area(Request $request){
        $this->validate($request,[
            'political_about_section_button_url' => 'nullable|string',
            'political_about_section_right_image' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'political_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'political_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'political_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'political_about_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'political_about_section_'.$lang->slug.'_subtitle',
                'political_about_section_'.$lang->slug.'_title',
                'political_about_section_'.$lang->slug.'_description',
                'political_about_section_'.$lang->slug.'_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'political_about_section_button_url',
            'political_about_section_right_image',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function video_area(){
        return view($this->base_path.'video-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_video_area(Request $request){
        $this->validate($request,[
            'home_page_11_video_area_video_url' => 'nullable|string',
            'home_page_11_video_area_background_image' => 'nullable|string',
        ]);

        $fields = [
            'home_page_11_video_area_video_url',
            'home_page_11_video_area_background_image'
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function cta_area(){
        return view($this->base_path.'cta-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_cta_area(Request $request){
        $this->validate($request,[
            'home_page_11_cta_area_button_url' => 'nullable|string',
            'home_page_11_cta_area_background_image' => 'nullable|string',
        ]);

        $fields = [
            'home_page_11_cta_area_button_url',
            'home_page_11_cta_area_background_image'
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_cta_area_subtitle' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_cta_area_title' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_cta_area_button_status' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_11_'.$lang->slug.'_cta_area_subtitle',
                'home_page_11_'.$lang->slug.'_cta_area_title',
                'home_page_11_'.$lang->slug.'_cta_area_description',
                'home_page_11_'.$lang->slug.'_cta_area_button_status',
                'home_page_11_'.$lang->slug.'_cta_area_button_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function service_area(){
        return view($this->base_path.'service-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_service_area(Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_01_service_area_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_service_area_subtitle' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_service_area_title' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_service_area_readmore_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_11_'.$lang->slug.'_service_area_subtitle',
                'home_page_11_'.$lang->slug.'_service_area_title',
                'home_page_11_'.$lang->slug.'_service_area_readmore_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function counterup_area(){
        return view($this->base_path.'counterup-area')->with(['all_languages' => $this->all_language]);
    }
    public function update_counterup_area(Request $request){

        $this->validate($request,[
            'home_11_counterup_section_background_image' => 'nullable|string',
        ]);
        
        update_static_option('home_11_counterup_section_background_image',$request->home_11_counterup_section_background_image);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function event_area(){
        return view($this->base_path.'event-area')->with(['all_languages' => $this->all_language]);
    }


    public function update_event_area(Request $request){
        $this->validate($request,[
            'home_page_01_event_area_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_01_event_area_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_event_area_subtitle' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_event_area_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_11_'.$lang->slug.'_event_area_subtitle',
                'home_page_11_'.$lang->slug.'_event_area_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function testimonial_area(){
        return view($this->base_path.'testimonial-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_testimonial_area(Request $request){
        $this->validate($request,[
            'home_page_11_testimonial_area_background_image' => 'nullable|string',
        ]);

        $fields = [
            'home_page_11_testimonial_area_background_image',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_testimonial_section_subtitle' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_testimonial_section_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_11_'.$lang->slug.'_testimonial_section_subtitle',
                'home_page_11_'.$lang->slug.'_testimonial_section_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function news_area(){
        return view($this->base_path.'news-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_news_area(Request $request){

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_11_'.$lang->slug.'_new_area_subtitle' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_new_area_title' => 'nullable|string',
                'home_page_11_'.$lang->slug.'_new_area_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_11_'.$lang->slug.'_new_area_subtitle',
                'home_page_11_'.$lang->slug.'_new_area_title',
                'home_page_11_'.$lang->slug.'_new_area_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

}
