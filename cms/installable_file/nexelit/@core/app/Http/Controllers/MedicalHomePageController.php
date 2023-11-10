<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\AppointmentCategory;
use Illuminate\Http\Request;
use App\Language;

class MedicalHomePageController extends Controller
{
    public $all_language;
    public $base_path = 'backend.pages.home.medical.';

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
                'medical_home_page_header_'.$lang->slug.'_title' => 'nullable|string',
                'medical_home_page_header_'.$lang->slug.'_description' => 'nullable|string',
                'medical_home_page_header_'.$lang->slug.'_button_text' => 'nullable|string',
                'medical_home_page_header_'.$lang->slug.'_button_two_text' => 'nullable|string',
                'medical_home_page_header_background_image' => 'nullable|string',
                'medical_home_page_header_right_image' => 'nullable|string',
                'medical_home_page_header_button_url' => 'nullable|string',
                'medical_home_page_header_button_two_url' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'medical_home_page_header_'.$lang->slug.'_title',
                'medical_home_page_header_'.$lang->slug.'_description',
                'medical_home_page_header_'.$lang->slug.'_button_text',
                'medical_home_page_header_'.$lang->slug.'_button_two_text',
                'medical_home_page_header_button_two_url' ,
                'medical_home_page_header_button_url' ,
                'medical_home_page_header_right_image',
                'medical_home_page_header_background_image'
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
        return view($this->base_path.'about')->with(['all_languages' => $this->all_language]);
    }

    public function update_about_area(Request $request){
        $this->validate($request,[
            'medical_about_section_button_url' => 'nullable|string',
            'medical_about_section_right_image' => 'nullable|string',
            'home_page_12_about_section_video_url' => 'nullable|string',
            'medical_about_section_right_bottom_image' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'medical_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'medical_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'medical_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'medical_about_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'medical_about_section_'.$lang->slug.'_subtitle',
                'medical_about_section_'.$lang->slug.'_title',
                'medical_about_section_'.$lang->slug.'_description',
                'medical_about_section_'.$lang->slug.'_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'medical_about_section_button_url',
            'medical_about_section_right_image',
            'medical_about_section_right_bottom_image',
            'home_page_13_about_section_video_url',
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
                'home_page_12_'.$lang->slug.'_service_area_subtitle' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_service_area_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_12_'.$lang->slug.'_service_area_subtitle',
                'home_page_12_'.$lang->slug.'_service_area_title',
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

    public function cta_area(){
        return view($this->base_path.'cta-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_cta_area(Request $request){
        $this->validate($request,[
            'medical_cta_area_section_cta_area_email' => 'nullable|string',
        ]);

        $fields = [
            'medical_cta_area_section_cta_area_email',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'medical_cta_area_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'medical_cta_area_section_'.$lang->slug.'_title' => 'nullable|string',
                'medical_cta_area_section_'.$lang->slug.'_description' => 'nullable|string',
                'medical_cta_area_section_'.$lang->slug.'_hotline' => 'nullable|string',
                'medical_cta_area_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'medical_cta_area_section_'.$lang->slug.'_subtitle',
                'medical_cta_area_section_'.$lang->slug.'_title',
                'medical_cta_area_section_'.$lang->slug.'_description',
                'medical_cta_area_section_'.$lang->slug.'_hotline',
                'medical_cta_area_section_'.$lang->slug.'_button_text',
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
        return view($this->base_path.'appointment-area')->with(['all_languages' => $this->all_language,'all_categories' => $all_categories]);
    }
    public function appointment_category_by_slug(Request $request){
        $selected_donation = unserialize(get_static_option('home_page_12_appointment_section_category'),['class' => false]);
        $selected_items = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
        $all_items = AppointmentCategory::select(['title','id'])->where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json([
            'categories' => $all_items,
            'selected_items' => $selected_items
        ]);
    }

    public function update_appointment_area(Request $request){
        $this->validate($request,[
            'home_page_12_appointment_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_12_appointment_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_12_'.$lang->slug.'_appointment_section_subtitle' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_appointment_section_title' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_appointment_section_category' => 'nullable',
            ]);
            $fields_list = [
                'home_page_12_'.$lang->slug.'_appointment_section_subtitle',
                'home_page_12_'.$lang->slug.'_appointment_section_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $cat = 'home_page_12_appointment_section_category' ;
        update_static_option($cat,serialize($request->$cat ?? []));

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function case_study_area(){
        return view($this->base_path.'case-study-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_case_study_area(Request $request){
        $this->validate($request,[
            'home_page_01_case_study_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_01_case_study_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_12_'.$lang->slug.'_case_study_section_title' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_case_study_section_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_12_'.$lang->slug.'_case_study_section_title',
                'home_page_12_'.$lang->slug.'_case_study_section_subtitle',
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
    public function testimonial_area(){
        return view($this->base_path.'testimonial-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_testimonial_area(Request $request){
        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_12_'.$lang->slug.'_testimonial_section_title' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_testimonial_section_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_12_'.$lang->slug.'_testimonial_section_title',
                'home_page_12_'.$lang->slug.'_testimonial_section_subtitle',
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
        return view($this->base_path.'news-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_news_area(Request $request){
        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_12_'.$lang->slug.'_news_section_subtitle' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_news_section_title' => 'nullable|string',
                'home_page_12_'.$lang->slug.'_news_section_readmore_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_12_'.$lang->slug.'_news_section_subtitle',
                'home_page_12_'.$lang->slug.'_news_section_title',
                'home_page_12_'.$lang->slug.'_news_section_readmore_text',
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

}
