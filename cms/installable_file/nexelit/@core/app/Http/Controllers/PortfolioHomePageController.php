<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
class PortfolioHomePageController extends Controller
{
    public $portfolio_home_base_view_path = 'backend.pages.home.portfolio-home.';
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function header_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'header')->with(['all_languages' => $all_languages]);
    }

    public function update_header_area(Request $request){
        $this->validate($request,[
           'portfolio_home_page_button_url' => 'nullable|string|max:191',
           'portfolio_home_page_right_image' => 'nullable|string|max:191'
        ]);
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'portfolio_home_page_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_home_page_'.$lang->slug.'_title' => 'nullable|string',
                'portfolio_home_page_'.$lang->slug.'_profession' => 'nullable|string',
                'portfolio_home_page_'.$lang->slug.'_button_text' => 'nullable|string',
                'portfolio_home_page_'.$lang->slug.'_description' => 'nullable|string',
            ]);

            $all_fields = [
                'portfolio_home_page_'.$lang->slug.'_subtitle',
                'portfolio_home_page_'.$lang->slug.'_title',
                'portfolio_home_page_'.$lang->slug.'_profession',
                'portfolio_home_page_'.$lang->slug.'_description',
                'portfolio_home_page_'.$lang->slug.'_button_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('portfolio_home_page_button_url',$request->portfolio_home_page_button_url);
        update_static_option('portfolio_home_page_right_image',$request->portfolio_home_page_right_image);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function about_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'about')->with(['all_languages' => $all_languages]);
    }

    public function update_about_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_05_'.$lang->slug.'_about_section_icon_box_title' => 'required|array',
                'home_page_05_'.$lang->slug.'_about_section_icon_box_title.*' => 'required|string',
                'home_page_05_about_section_icon_box_icon' => 'required|array',
                'home_page_05_about_section_icon_box_icon.*' => 'required|string',
                'portfolio_about_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_about_section_'.$lang->slug.'_title' => 'nullable|string',
                'portfolio_about_section_'.$lang->slug.'_description' => 'nullable|string',
                'portfolio_about_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'portfolio_about_section_'.$lang->slug.'_button_two_text' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'home_page_05_'.$lang->slug.'_about_section_icon_box_title',
                'home_page_05_about_section_icon_box_icon',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,serialize($request->$field));
            }
            //save repeater values
            $all_fields = [
                'portfolio_about_section_'.$lang->slug.'_subtitle',
                'portfolio_about_section_'.$lang->slug.'_title',
                'portfolio_about_section_'.$lang->slug.'_description',
                'portfolio_about_section_'.$lang->slug.'_button_one_text',
                'portfolio_about_section_'.$lang->slug.'_button_two_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        //save repeater values
        $all_fields = [
            'portfolio_about_section_left_image',
            'portfolio_about_section_button_two_url',
            'portfolio_about_section_button_one_url',
            'portfolio_about_section_button_one_icon',
            'portfolio_about_section_button_two_icon',
        ];
        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function expertises_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'expertice-area')->with(['all_languages' => $all_languages]);
    }

    public function update_expertises_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_title' => 'required|array',
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_title.*' => 'required|string',
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_subtitle' => 'required|array',
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_subtitle.*' => 'required|string',
                'home_page_05_experties_section_skill_box_number' => 'required|array',
                'home_page_05_experties_section_skill_box_number.*' => 'required|string',
                'portfolio_expertice_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_expertice_section_'.$lang->slug.'_title' => 'nullable|string'
            ]);

            //save repeater values
            $all_fields = [
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_title',
                'home_page_05_'.$lang->slug.'_experties_section_skill_box_subtitle',
                'home_page_05_experties_section_skill_box_number',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,serialize($request->$field));
            }
            //save repeater values
            $all_fields = [
                'portfolio_expertice_section_'.$lang->slug.'_subtitle',
                'portfolio_expertice_section_'.$lang->slug.'_title'
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function what_we_offer_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'what-we-offer-area')->with(['all_languages' => $all_languages]);
    }

    public function update_what_we_offer_area(Request $request){
        $this->validate($request,[
            'portfolio_what_we_offer_section_items' => 'required',
            'portfolio_what_we_offer_section_orderby' => 'required',
        ],[
            'portfolio_what_we_offer_section_items.required' => __('enter how many item you want to show in this section'),
            'portfolio_what_we_offer_section_orderby.required' => __('you must have to select order for items')
        ]);
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'portfolio_what_we_offer_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_what_we_offer_section_'.$lang->slug.'_title' => 'nullable|string'
            ]);
            //save repeater values
            $all_fields = [
                'portfolio_what_we_offer_section_'.$lang->slug.'_subtitle',
                'portfolio_what_we_offer_section_'.$lang->slug.'_title'
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_service_area_items',$request->home_page_01_service_area_items);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function recent_work_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'recent-work-area')->with(['all_languages' => $all_languages]);
    }

    public function update_recent_work_area(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'portfolio_recent_work_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_recent_work_section_'.$lang->slug.'_title' => 'nullable|string',
                'portfolio_recent_work_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            //save repeater values
            $all_fields = [
                'portfolio_recent_work_section_'.$lang->slug.'_subtitle',
                'portfolio_recent_work_section_'.$lang->slug.'_title',
                'portfolio_recent_work_section_'.$lang->slug.'_button_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_case_study_items',$request->home_page_01_case_study_items);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function cta_area(){
        $all_languages = Language::all();
        return view($this->portfolio_home_base_view_path.'cta-area')->with(['all_languages' => $all_languages]);
    }

    public function update_cta_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'portfolio_cta_section_'.$lang->slug.'_description' => 'nullable|string',
                'portfolio_cta_section_'.$lang->slug.'_title' => 'nullable|string',
                'portfolio_cta_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            //save repeater values
            $all_fields = [
                'portfolio_cta_section_'.$lang->slug.'_description',
                'portfolio_cta_section_'.$lang->slug.'_title',
                'portfolio_cta_section_'.$lang->slug.'_button_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('portfolio_cta_section_button_url',$request->portfolio_cta_section_button_url);
        update_static_option('portfolio_cta_section_button_icon',$request->portfolio_cta_section_button_icon);
        update_static_option('portfolio_cta_section_right_image',$request->portfolio_cta_section_right_image);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
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
                'portfolio_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_testimonial_section_'.$lang->slug.'_title' => 'nullable|string'
            ]);
            //save repeater values
            $all_fields = [
                'portfolio_testimonial_section_'.$lang->slug.'_subtitle',
                'portfolio_testimonial_section_'.$lang->slug.'_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
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
                'portfolio_news_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'portfolio_news_section_'.$lang->slug.'_title' => 'nullable|string',
                'portfolio_news_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            //save repeater values
            $all_fields = [
                'portfolio_news_section_'.$lang->slug.'_subtitle',
                'portfolio_news_section_'.$lang->slug.'_title',
                'portfolio_news_section_'.$lang->slug.'_button_text',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }
}
