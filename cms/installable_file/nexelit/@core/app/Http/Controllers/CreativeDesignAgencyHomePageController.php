<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class CreativeDesignAgencyHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.creative-design-agency.';
    public $languages;
    public function __construct(){
        $this->middleware('auth:admin');
        $this->languages = $all_languages = Language::all();
    }

    public function header_area(){
        return view($this->industry_home_base_view_path.'header')->with(['all_languages' => $this->languages]);
    }
    public function update_header_area(Request $request){
        $this->validate($request,[
            'home_page_14_header_background_image' => 'nullable|string',
            'home_page_14_header_right_image' => 'nullable|string',
            'home_page_14_header_area_button_one_icon' => 'nullable|string',
            'home_page_14_header_area_button_one_url' => 'nullable|string'
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_header_area_title' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_header_area_description' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_header_area_button_one_text' => 'nullable|string',
            ]);

            $field_list = [
                'home_page_14_'.$lang->slug.'_header_area_title',
                'home_page_14_'.$lang->slug.'_header_area_description',
                'home_page_14_'.$lang->slug.'_header_area_button_one_text',
                'home_page_14_'.$lang->slug.'_header_area_button_one_icon',
                'home_page_14_'.$lang->slug.'_header_area_button_one_url',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $field_list = [
            'home_page_14_header_background_image',
            'home_page_14_header_right_image'
        ];

        foreach ($field_list as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function service_area(){
        return view($this->industry_home_base_view_path.'service-area')->with(['all_languages' => $this->languages]);
    }

    public function update_service_area(Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items' => 'nullable|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_service_area_subtitle' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_service_area_title' => 'nullable|string'
            ]);

            $field_list = [
                'home_page_14_'.$lang->slug.'_service_area_subtitle',
                'home_page_14_'.$lang->slug.'_service_area_title'
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $field_list = [
            'home_page_01_service_area_items',
        ];

        foreach ($field_list as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
    public function portfolio_area(){
        return view($this->industry_home_base_view_path.'portfolio-area')->with(['all_languages' => $this->languages]);
    }

    public function update_portfolio_area(Request $request){
        $this->validate($request,[
            'home_page_01_case_study_items' => 'nullable|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_project_area_title' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_project_area_subtitle' => 'nullable|string'
            ]);

            $field_list = [
                'home_page_14_'.$lang->slug.'_project_area_title',
                'home_page_14_'.$lang->slug.'_project_area_subtitle'
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $field_list = [
            'home_page_01_case_study_items',
        ];

        foreach ($field_list as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function cta_area(){
        return view($this->industry_home_base_view_path.'cta-area')->with(['all_languages' => $this->languages]);
    }

    public function update_cta_area(Request $request){
        $this->validate($request,[
            'home_page_14_cta_area_right_image' => 'nullable|string',
            'home_page_14_cta_area_button_url' => 'nullable|string',
            'home_page_14_cta_section_button_icon' => 'nullable|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_cta_area_button_status' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_cta_area_title' => 'nullable|string',
            ]);

            $field_list = [
                'home_page_14_'.$lang->slug.'_cta_area_button_title',
                'home_page_14_'.$lang->slug.'_cta_area_button_status',
                'home_page_14_'.$lang->slug.'_cta_area_description',
                'home_page_14_'.$lang->slug.'_cta_area_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $field_list = [
            'home_page_14_cta_section_button_icon',
            'home_page_14_cta_area_button_url',
            'home_page_14_cta_area_right_image',
        ];

        foreach ($field_list as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function work_process_area(){
        return view($this->industry_home_base_view_path.'work-process-area')->with(['all_languages' => $this->languages]);
    }
    public function update_work_process_area(Request $request){
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_work_process_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'home_page_14_work_process_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_page_14_work_process_section_item_'.$lang->slug.'_title' => 'required|array',
                'home_page_14_work_process_section_item_'.$lang->slug.'_title.*' => 'required|string',
                'home_page_14_work_process_section_item_number' => 'required|array',
                'home_page_14_work_process_section_item_number.*' => 'required|string',
            ],[
                'home_page_14_work_process_section_item_'.$lang->slug.'_title.required' => __('title field is required'),
                'home_page_14_work_process_section_item_number.required' => __('number field is required'),
            ]);

            //save repeater values
            $all_fields = [
                'home_page_14_work_process_section_item_'.$lang->slug.'_title',
                'home_page_14_work_process_section_item_number'
            ];
            foreach ($all_fields as $field){
                $field_val = !empty($request->$field) ? $request->$field : [];
                update_static_option($field,serialize($field_val));
            }

            $non_seralize_fields = [
                'home_page_14_work_process_section_'.$lang->slug.'_subtitle',
                'home_page_14_work_process_section_'.$lang->slug.'_title'
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function counterup_area(){
        return view($this->industry_home_base_view_path.'counterup-area')->with(['all_languages' => $this->languages]);
    }

    public function update_counterup_area(Request $request){

            $this->validate($request,[
                'home_page_14_counterup_section_background_image' => 'nullable|string',
            ]);

            $non_seralize_fields = [
                'home_page_14_counterup_section_background_image',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }


        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function testimonial_area(){
        return view($this->industry_home_base_view_path.'testimonial-area')->with(['all_languages' => $this->languages]);
    }
    public function update_testimonial_area(Request $request){

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_testimonial_section_subtitle' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_testimonial_section_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'home_page_14_'.$lang->slug.'_testimonial_section_subtitle',
                'home_page_14_'.$lang->slug.'_testimonial_section_title'
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function news_area(){
        return view($this->industry_home_base_view_path.'news-area')->with(['all_languages' => $this->languages]);
    }
    public function update_news_area(Request $request){

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_news_area_section_subtitle' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_news_area_section_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'home_page_14_'.$lang->slug.'_news_area_section_subtitle',
                'home_page_14_'.$lang->slug.'_news_area_section_title'
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function contact_area(){
        return view($this->industry_home_base_view_path.'contact-area')->with(['all_languages' => $this->languages]);
    }

    public function update_contact_area(Request $request){

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_14_'.$lang->slug.'_contact_area_subtitle' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_contact_area_title' => 'nullable|string',
                'home_page_14_'.$lang->slug.'_contact_area_button_text' => 'nullable|string',
                'home_page_14_contact_area_button_icon' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'home_page_14_'.$lang->slug.'_contact_area_subtitle',
                'home_page_14_'.$lang->slug.'_contact_area_title',
                'home_page_14_'.$lang->slug.'_contact_area_button_text',
                'home_page_14_contact_area_button_icon',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

}
