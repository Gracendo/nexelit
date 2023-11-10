<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Language;
use Illuminate\Http\Request;

class CharityHomePageController extends Controller
{
    public $all_language;
    public $base_path = 'backend.pages.home.charity.';

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->all_language = Language::all();
    }

    public function header_area(){
        return view($this->base_path.'header')->with(['all_languages' => $this->all_language]);
    }

    public function update_header_area(Request $request){

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_header_section_subtitle' => 'nullable|array',
                'home_page_13_'.$lang->slug.'_header_section_title' => 'nullable|array',
                'home_page_13_'.$lang->slug.'_header_section_description' => 'nullable|array',
                'home_page_13_'.$lang->slug.'_header_section_button_one_text' => 'nullable|array',
                'home_page_13_header_section_button_one_url' => 'nullable|array',
                'home_page_13_header_section_button_one_icon' => 'nullable|array',
                'home_page_13_header_section_bg_image' => 'required|array',
                'home_page_13_header_section_bg_image>*' => 'required|string',
            ]);

            //save repeater values
            $all_fields = [
                'home_page_13_'.$lang->slug.'_header_section_subtitle',
                'home_page_13_'.$lang->slug.'_header_section_title' ,
                'home_page_13_'.$lang->slug.'_header_section_description',
                'home_page_13_'.$lang->slug.'_header_section_button_one_text',
                'home_page_13_header_section_button_one_url' ,
                'home_page_13_header_section_button_one_icon',
                'home_page_13_header_section_bg_image'
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
            'home_page_13_about_section_button_url' => 'nullable|string',
            'home_page_13_about_section_video_url' => 'nullable|string',
            'home_page_13_about_section_right_image' => 'nullable|string',
            'home_page_13_about_section_button_icon' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_about_section_subtitle' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_about_section_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_about_section_description' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_about_section_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_about_section_subtitle',
                'home_page_13_'.$lang->slug.'_about_section_title',
                'home_page_13_'.$lang->slug.'_about_section_description',
                'home_page_13_'.$lang->slug.'_about_section_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_13_about_section_button_url',
            'home_page_13_about_section_video_url',
            'home_page_13_about_section_right_image',
            'home_page_13_about_section_button_icon',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function popular_cause_area(){

        $default_lang =  get_default_language();
        $all_donation_cause = Donation::select(['title','id'])->where(['lang' => $default_lang ,'status' => 'publish'])->get();
        return view($this->base_path.'popular-cause')->with(['all_languages' => $this->all_language,'all_cause' => $all_donation_cause,'default_lang' => $default_lang]);
    }

    public function update_popular_cause_area(Request $request){
        $this->validate($request,[
            'home_page_13_popular_cause_popular_cause_items' => 'nullable|string',
            'home_page_13_popular_cause_popular_cause_order' => 'nullable|string',
            'home_page_13_popular_cause_popular_cause_orderby' => 'nullable|string',
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_popular_cause_subtitle' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_popular_cause_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_popular_cause_popular_cause_list' => 'nullable',
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_popular_cause_subtitle',
                'home_page_13_'.$lang->slug.'_popular_cause_title',
                'home_page_13_'.$lang->slug.'_popular_cause_goal_text',
                'home_page_13_'.$lang->slug.'_popular_cause_rise_text',
            ];

            foreach ($fields_list as $field){
                if ($request->has($field) ){
                    update_static_option($field,$request->$field);
                }
            }
            $field_name = 'home_page_13_'.$lang->slug.'_popular_cause_popular_cause_list';
            if (!empty($request->$field_name)){
                $field_value = $request->$field_name ?? [];
                update_static_option($field_name,serialize($field_value));
            }
        }

        $fields = [
            'home_page_13_popular_cause_popular_cause_items',
            'home_page_13_popular_cause_popular_cause_order',
            'home_page_13_popular_cause_popular_cause_orderby',
            'home_page_13_popular_cause_popular_cause_background_image',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function donation_cause_by_lang(Request $request){
        $selected_donation = unserialize(get_static_option('home_page_13_'.$request->lang.'_popular_cause_popular_cause_list'),['class' => false]);
        $selected_items = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
        $all_items = Donation::select(['title','id'])->where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json([
           'donations_items' => $all_items,
           'selected_items' => $selected_items
        ]);
    }

    public function team_area(){
        return view($this->base_path.'team')->with(['all_languages' => $this->all_language]);
    }

    public function update_team_area(Request $request){
        $this->validate($request,[
            'home_page_01_team_member_items' => 'nullable|string',
        ]);

        $fields = [
            'home_page_01_team_member_items',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_team_member_section_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_team_member_section_subtitle' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_team_member_section_title',
                'home_page_13_'.$lang->slug.'_team_member_section_subtitle',
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

    public function cta_area(){
        return view($this->base_path.'cta-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_cta_area(Request $request){
        $this->validate($request,[
            'home_page_13_cta_area_background_image' => 'nullable|string',
            'home_page_13_cta_area_button_url' => 'nullable|string',
            'home_page_13_cta_section_button_icon' => 'nullable|string',
        ]);

        $fields = [
            'home_page_13_cta_area_button_url',
            'home_page_13_cta_area_background_image',
            'home_page_13_cta_section_button_icon',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_cta_area_button_status' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_cta_area_title' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_cta_area_title',
                'home_page_13_'.$lang->slug.'_cta_area_button_title',
                'home_page_13_'.$lang->slug.'_cta_area_button_status',
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
                'home_page_13_'.$lang->slug.'_event_area_subtitle' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_event_area_title' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_event_area_subtitle',
                'home_page_13_'.$lang->slug.'_event_area_title'
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
        $this->validate($request,[
            'home_page_13_testimonial_section_background_image' => 'nullable|string'
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_testimonial_section_subtitle' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_testimonial_section_title' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_testimonial_section_subtitle',
                'home_page_13_'.$lang->slug.'_testimonial_section_title'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home_page_13_testimonial_section_background_image',$request->home_page_13_testimonial_section_background_image);

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
    public function cta_two_area(){
        return view($this->base_path.'cta-two-area')->with(['all_languages' => $this->all_language]);
    }

    public function update_cta_two_area(Request $request){
        $this->validate($request,[
            'home_page_13_cta_two_section_button_icon' => 'nullable|string',
            'home_page_13_cta_two_area_button_url' => 'nullable|string'
        ]);

        foreach ($this->all_language as $lang){
            $this->validate($request,[
                'home_page_13_'.$lang->slug.'_cta_two_area_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_cta_two_area_button_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_cta_two_area_button_status' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_cta_two_area_title',
                'home_page_13_'.$lang->slug.'_cta_two_area_button_title',
                'home_page_13_'.$lang->slug.'_cta_two_area_button_status'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home_page_13_cta_two_section_button_icon',$request->home_page_13_cta_two_section_button_icon);
        update_static_option('home_page_13_cta_two_area_button_url',$request->home_page_13_cta_two_area_button_url);

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
                'home_page_13_'.$lang->slug.'_new_area_subtitle' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_new_area_title' => 'nullable|string',
                'home_page_13_'.$lang->slug.'_new_area_button_text' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_13_'.$lang->slug.'_new_area_subtitle',
                'home_page_13_'.$lang->slug.'_new_area_title',
                'home_page_13_'.$lang->slug.'_new_area_button_text'
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
