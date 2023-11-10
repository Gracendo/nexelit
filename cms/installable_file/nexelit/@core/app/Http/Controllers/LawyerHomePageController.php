<?php

namespace App\Http\Controllers;

use App\AppointmentCategory;
use App\Language;
use Illuminate\Http\Request;

class LawyerHomePageController extends Controller
{
    public $all_language;
    public $base_path = 'backend.pages.home.lawyer.';

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
                'home_page_10_'.$lang->slug.'_header_section_subtitle' => 'nullable|array',
                'home_page_10_'.$lang->slug.'_header_section_title' => 'nullable|array',
                'home_page_10_'.$lang->slug.'_header_section_description' => 'nullable|array',
                'home_page_10_'.$lang->slug.'_header_section_button_one_text' => 'nullable|array',
                'home_page_10_'.$lang->slug.'_header_section_button_two_text' => 'nullable|array',
                'home_page_10_header_section_button_one_url' => 'nullable|array',
                'home_page_10_header_section_button_two_url' => 'nullable|array',
                'home_page_10_header_section_bg_image' => 'array|required',
                'home_page_10_header_section_bg_image.*' => 'string|required',
            ]);

            //save repeater values
            $all_fields = [
                'home_page_10_'.$lang->slug.'_header_section_subtitle',
                'home_page_10_'.$lang->slug.'_header_section_title',
                'home_page_10_'.$lang->slug.'_header_section_description',
                'home_page_10_'.$lang->slug.'_header_section_button_one_text' ,
                'home_page_10_'.$lang->slug.'_header_section_button_two_text',
                'home_page_10_header_section_button_one_url' ,
                'home_page_10_header_section_button_two_url',
                'home_page_10_header_section_bg_image'
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
    public function key_feature_area(){
        return view($this->base_path.'key-features-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_key_feature_area(Request $request){

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_key_feeatures_item_description' => 'nullable|array',
                'home_page_10_'.$lang->slug.'_key_features_item_title' => 'nullable|array',
                'home_page_10_key_features_section_icon' => 'array|required',
                'home_page_10_key_features_section_icon.*' => 'string|required',
            ]);

            //save repeater values
            $all_fields = [
                'home_page_10_'.$lang->slug.'_key_feeatures_item_description',
                'home_page_10_'.$lang->slug.'_key_features_item_title',
                'home_page_10_key_features_section_icon' ,
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
            'lawyer_about_section_button_url' => 'nullable|string',
            'lawyer_about_section_left_top_image' => 'nullable|string',
            'lawyer_about_section_left_bottom_image' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'lawyer_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'lawyer_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'lawyer_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'lawyer_about_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'lawyer_about_section_'.$lang->slug.'_subtitle',
                'lawyer_about_section_'.$lang->slug.'_title',
                'lawyer_about_section_'.$lang->slug.'_description',
                'lawyer_about_section_'.$lang->slug.'_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'lawyer_about_section_button_url',
            'lawyer_about_section_left_top_image',
            'lawyer_about_section_left_bottom_image'
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
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
            'home_page_01_service_area_item_type' => 'nullable|string'
        ]);


        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_service_area_title' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_service_area_subtitle' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_service_area_readmore_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_service_area_title',
                'home_page_10_'.$lang->slug.'_service_area_subtitle',
                'home_page_10_'.$lang->slug.'_service_area_readmore_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        $fields = [
            'home_page_01_service_area_items'
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);

    }


    public function appointment_area(){
        $all_categories = AppointmentCategory::with('lang')->where(['status' => 'publish'])->get();
        return view($this->base_path.'appointment-area')->with(['all_languages' => $this->all_language,'all_categories' => $all_categories]);
    }
    public function appointment_category_by_slug(Request $request){
        $selected_donation = unserialize(get_static_option('home_page_10_appointment_section_category'),['class' => false]);
        $selected_items = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
        $all_items = AppointmentCategory::with('lang')->select(['title','id'])->where(['status' => 'publish'])->get();
        return response()->json([
            'categories' => $all_items,
            'selected_items' => $selected_items
        ]);
    }

    public function update_appointment_area(Request $request){
        $this->validate($request,[
            'home_page_10_appointment_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_10_appointment_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_appointment_section_subtitle' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_appointment_section_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_appointment_section_subtitle',
                'home_page_10_'.$lang->slug.'_appointment_section_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
            $cat = 'home_page_10_'.$lang->slug.'_appointment_section_category' ;
            update_static_option($cat,serialize($request->$cat ?? []));
        }

        update_static_option('home_page_10_appointment_section_category',serialize($request->home_page_10_appointment_section_category ?? []));

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function counterup_area(){
        return view($this->base_path.'counterup-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_counterup_area(Request $request){
        $this->validate($request,[
            'home_10_counterup_section_background_image' => 'nullable|string',
        ]);

        $fields = [
            'home_10_counterup_section_background_image'
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
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
        
        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_testimonial_section_subtitle' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_testimonial_section_title' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_testimonial_section_title',
                'home_page_10_'.$lang->slug.'_testimonial_section_subtitle'
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
                'home_page_10_'.$lang->slug.'_new_area_subtitle' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_new_area_title' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_new_area_subtitle',
                'home_page_10_'.$lang->slug.'_new_area_title'
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
            'home_page_10_cta_area_button_url' => 'nullable|string',
            'home_page_10_cta_area_background_image' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_cta_area_title' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_cta_area_button_status' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_cta_area_title',
                'home_page_10_'.$lang->slug.'_cta_area_description',
                'home_page_10_'.$lang->slug.'_cta_area_button_status',
                'home_page_10_'.$lang->slug.'_cta_area_button_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home_page_10_cta_area_background_image',$request->home_page_10_cta_area_background_image);
        update_static_option('home_page_10_cta_area_button_url',$request->home_page_10_cta_area_button_url);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function contact_area(){
        return view($this->base_path.'contact-area')->with(['all_languages' => $this->all_language]);
    }
    public function update_contact_area(Request $request){
        
        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_10_'.$lang->slug.'_contact_area_title' => 'nullable|string',
                'home_page_10_'.$lang->slug.'_contact_area_button_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_10_'.$lang->slug.'_contact_area_title',
                'home_page_10_'.$lang->slug.'_contact_area_button_title',
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
