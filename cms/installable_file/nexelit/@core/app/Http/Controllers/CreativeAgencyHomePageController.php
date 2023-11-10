<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class CreativeAgencyHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.creative-agency.';
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
                'cagency_header_section_'.$lang->slug.'_title' => 'nullable|string',
                'cagency_header_section_'.$lang->slug.'_description' => 'nullable|string',
                'cagency_header_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'cagency_header_section_button_one_url' => 'nullable|string',
                'cagency_header_section_button_one_icon' => 'nullable|string',
                'cagency_header_section_right_image' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'cagency_header_section_'.$lang->slug.'_title',
                'cagency_header_section_'.$lang->slug.'_description' ,
                'cagency_header_section_'.$lang->slug.'_button_one_text',
                'cagency_header_section_button_one_url' ,
                'cagency_header_section_button_one_icon',
                'cagency_header_section_right_image'
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

    public function update_what_we_offer_area (Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items'  => 'nullable'
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'cagency_what_we_offer_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'cagency_what_we_offer_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'cagency_what_we_offer_section_'.$lang->slug.'_subtitle',
                'cagency_what_we_offer_section_'.$lang->slug.'_title',
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

    public function video_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'video-area')->with(['all_languages' => $all_languages]);
    }

    public function update_video_area (Request $request){
        $this->validate($request,[
            'creative_agency_video_section_background_image'  => 'nullable|string',
            'creative_agency_video_section_video_url'  => 'nullable|string',
        ]);

        update_static_option('creative_agency_video_section_background_image',$request->creative_agency_video_section_background_image);
        update_static_option('creative_agency_video_section_video_url',$request->creative_agency_video_section_video_url);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
    public function work_process_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'work-process-area')->with(['all_languages' => $all_languages]);
    }

    public function update_work_process_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'cagency_work_process_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'cagency_work_process_section_'.$lang->slug.'_title' => 'nullable|string',
                'cagency_work_process_section_item_'.$lang->slug.'_title' => 'required|array',
                'cagency_work_process_section_item_'.$lang->slug.'_title.*' => 'required|string',
                'cagency_work_process_section_item_number' => 'required|array',
                'cagency_work_process_section_item_number.*' => 'required|string',
            ],[
                'cagency_work_process_section_item_'.$lang->slug.'_title.required' => __('title field is required'),
                'cagency_work_process_section_item_number.required' => __('number field is required'),
            ]);

            //save repeater values
            $all_fields = [
                'cagency_work_process_section_item_'.$lang->slug.'_title',
                'cagency_work_process_section_item_number'
            ];
            foreach ($all_fields as $field){
                $field_val = !empty($request->$field) ? $request->$field : [];
                update_static_option($field,serialize($field_val));
            }

            $non_seralize_fields = [
                'cagency_work_process_section_'.$lang->slug.'_subtitle',
                'cagency_work_process_section_'.$lang->slug.'_title'
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

    public function our_portfolio_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'our-portfolio')->with(['all_languages' => $all_languages]);
    }

    public function update_our_portfolio_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'cagency_our_portfolio_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'cagency_our_portfolio_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            $non_seralize_fields = [
                'cagency_our_portfolio_section_'.$lang->slug.'_subtitle',
                'cagency_our_portfolio_section_'.$lang->slug.'_title'
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home_page_01_case_study_items',$request->home_page_01_case_study_items);

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function cta_area(){
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'call-to-action-area')->with(['all_languages' => $all_languages]);
    }

    public function update_cta_area(Request $request){
        $this->validate($request,[
            'cagency_cta_section_right_image' => 'nullable|string',
            'cagency_cta_section_button_url' => 'nullable|string',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'cagency_cta_section_'.$lang->slug.'_button_text' => 'nullable|string',
                'cagency_cta_section_'.$lang->slug.'_description' => 'nullable|string',
                'cagency_cta_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            $non_seralize_fields = [
                'cagency_cta_section_'.$lang->slug.'_button_text',
                'cagency_cta_section_'.$lang->slug.'_description',
                'cagency_cta_section_'.$lang->slug.'_title'
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('cagency_cta_section_right_image',$request->cagency_cta_section_right_image);
        update_static_option('cagency_cta_section_button_url',$request->cagency_cta_section_button_url);
        update_static_option('cagency_cta_section_button_icon',$request->cagency_cta_section_button_icon);

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
                'cagency_testimonial_section_'.$lang->slug.'_title' => 'nullable|string',
                'cagency_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $non_seralize_fields = [
                'cagency_testimonial_section_'.$lang->slug.'_title',
                'cagency_testimonial_section_'.$lang->slug.'_subtitle'
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
        $all_languages = Language::all();
        return view($this->industry_home_base_view_path.'news-area')->with(['all_languages' => $all_languages]);
    }

    public function update_news_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'cagency_news_area_section_'.$lang->slug.'_title' => 'nullable|string',
                'cagency_news_area_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $non_seralize_fields = [
                'cagency_news_area_section_'.$lang->slug.'_title',
                'cagency_news_area_section_'.$lang->slug.'_subtitle'
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
