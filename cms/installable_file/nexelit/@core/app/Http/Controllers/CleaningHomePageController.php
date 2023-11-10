<?php

namespace App\Http\Controllers;

use App\AppointmentCategory;
use App\Language;
use Illuminate\Http\Request;

class CleaningHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.cleaning.';
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
            'home_page_16_header_area_button_url' => 'nullable|string',
            'home_page_16_header_area_background_image' => 'nullable|string',
            'home_page_16_header_area_right_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_header_area_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_header_area_description' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_new_area_button_text' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_header_area_title',
                'home_page_16_'.$lang->slug.'_header_area_description',
                'home_page_16_'.$lang->slug.'_header_area_button_text'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_16_header_area_button_url',
            'home_page_16_header_area_background_image',
            'home_page_16_header_area_right_image',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function about_area(){
        return view($this->industry_home_base_view_path.'about')->with(['all_languages' => $this->languages]);
    }

    public function update_about_area(Request $request){
        $this->validate($request,[
            'home_page_16_about_section_left_image' => 'nullable|string',
            'home_page_16_about_section_button_url' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_about_section_button_text' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_about_section_description' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_about_section_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_about_section_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_about_section_button_text',
                'home_page_16_'.$lang->slug.'_about_section_description',
                'home_page_16_'.$lang->slug.'_about_section_title',
                'home_page_16_'.$lang->slug.'_about_section_subtitle',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_16_about_section_left_image',
            'home_page_16_about_section_button_url',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function service_area(){
        return view($this->industry_home_base_view_path.'service-area')->with(['all_languages' => $this->languages]);
    }

    public function update_service_area(Request $request){
        $this->validate($request,[
            'home_page_16_about_section_left_image' => 'nullable|string',
            'home_page_16_about_section_button_url' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_service_area_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_service_area_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_service_area_title',
                'home_page_16_'.$lang->slug.'_service_area_subtitle',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_01_service_area_items',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function estimate_area(){
        return view($this->industry_home_base_view_path.'estimate-area')->with(['all_languages' => $this->languages]);
    }
    public function update_estimate_area(Request $request){
        $this->validate($request,[
            'home_page_16_estimate_area_form_email' => 'nullable|email',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_estimate_area_form_button_text' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_estimate_area_form_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_estimate_area_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_estimate_area_form_button_text',
                'home_page_16_'.$lang->slug.'_estimate_area_form_title',
                'home_page_16_'.$lang->slug.'_estimate_area_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_16_estimate_area_form_email',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
    public function work_area(){
        return view($this->industry_home_base_view_path.'work-area')->with(['all_languages' => $this->languages]);
    }

    public function update_work_area(Request $request){
        $this->validate($request,[
            'home_page_01_case_study_items' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_work_section_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_work_section_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_work_section_title',
                'home_page_16_'.$lang->slug.'_work_section_subtitle',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_01_case_study_items',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
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
                'home_page_16_'.$lang->slug.'_testimonial_area_subtitle' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_testimonial_area_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_testimonial_area_subtitle',
                'home_page_16_'.$lang->slug.'_testimonial_area_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }
        return back()->with([
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
                'home_page_16_'.$lang->slug.'_new_area_subtitle' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_new_area_title' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_new_area_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_new_area_subtitle',
                'home_page_16_'.$lang->slug.'_new_area_title',
                'home_page_16_'.$lang->slug.'_new_area_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }


    public function appointment_area(){
        $all_categories = AppointmentCategory::with('lang')->where(['status' => 'publish'])->get();
        return view($this->industry_home_base_view_path.'appointment-area')->with(['all_languages' => $this->languages,'all_categories' => $all_categories]);
    }
    public function appointment_category_by_slug(Request $request){
        $selected_donation = unserialize(get_static_option('home_page_16_appointment_section_category'),['class' => false]);
        $selected_items = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
        $all_items = AppointmentCategory::select(['title','id'])->where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json([
            'categories' => $all_items,
            'selected_items' => $selected_items
        ]);
    }

    public function update_appointment_area(Request $request){
        $this->validate($request,[
            'home_page_16_appointment_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_16_appointment_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_16_'.$lang->slug.'_appointment_section_subtitle' => 'nullable|string',
                'home_page_16_'.$lang->slug.'_appointment_section_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_16_'.$lang->slug.'_appointment_section_subtitle',
                'home_page_16_'.$lang->slug.'_appointment_section_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
            $cat = 'home_page_16_'.$lang->slug.'_appointment_section_category' ;
            update_static_option($cat,serialize($request->$cat ?? []));
        }
        update_static_option('home_page_16_appointment_section_category',serialize($request->home_page_16_appointment_section_category ?? [] ));

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

}

