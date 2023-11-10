<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\KnowAbout;
use App\Language;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function about_page_about_section(){
        $all_language = Language::all();
        return view('backend.pages.about-page.about-section')->with(['all_languages' => $all_language]);
    }
    public function about_page_update_about_section(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request ,[
                'about_page_'.$lang->slug.'_about_section_title' => 'nullable|string',
                'about_page_'.$lang->slug.'_about_section_description' => 'nullable|string',
                'about_page_'.$lang->slug.'_about_section_quote_text' => 'nullable|string',
            ]);
            $fields = [
                'about_page_'.$lang->slug.'_about_section_title',
                'about_page_'.$lang->slug.'_about_section_description',
                'about_page_'.$lang->slug.'_about_section_quote_text'
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('about_page_image_two',$request->about_page_image_two);
        update_static_option('about_page_image_one',$request->about_page_image_one);


        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function about_page_global_network_section(){
        $all_language = Language::all();
        return view('backend.pages.about-page.global-network-section')->with(['all_languages' => $all_language]);
    }

    public function about_page_update_global_network_section(Request $request){
        $this->validate($request,[
           'about_page_global_network_image' => 'nullable|string',
        ]);
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request ,[
                'about_page_'.$lang->slug.'_global_network_button_url' => 'nullable|string',
                'about_page_'.$lang->slug.'_global_network_button_title' => 'nullable|string',
                'about_page_'.$lang->slug.'_global_network_button_status' => 'nullable|string',
                'about_page_'.$lang->slug.'_global_network_description' => 'nullable|string',
                'about_page_'.$lang->slug.'_global_network_title' => 'nullable|string',
            ]);
            $fields = [
                'about_page_'.$lang->slug.'_global_network_button_url',
                'about_page_'.$lang->slug.'_global_network_button_title',
                'about_page_'.$lang->slug.'_global_network_button_status',
                'about_page_'.$lang->slug.'_global_network_description',
                'about_page_'.$lang->slug.'_global_network_title'
            ];
            foreach ($fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('about_page_global_network_image',$request->about_page_global_network_image);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function about_page_experience_section(){
        $all_language = Language::all();
        return view('backend.pages.about-page.experience-section')->with(['all_languages' => $all_language]);
    }

    public function about_page_update_experience_section(Request $request){
        $this->validate($request,[
            'about_page_experience_signature_image' => 'nullable|string',
            'about_page_experience_video_background_image' => 'nullable|string',
        ]);
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request ,[
                'about_page_'.$lang->slug.'_experience_title' => 'nullable|string',
                'about_page_'.$lang->slug.'_experience_description' => 'nullable|string',
                'about_page_'.$lang->slug.'_quote_text' => 'nullable|string',
                'about_page_'.$lang->slug.'_experience_video_url' => 'nullable|string',
            ]);

            $experience_title = 'about_page_'.$lang->slug.'_experience_title';
            $experience_description = 'about_page_'.$lang->slug.'_experience_description';
            $quote_text = 'about_page_'.$lang->slug.'_quote_text';
            $_experience_video_url = 'about_page_'.$lang->slug.'_experience_video_url';

            update_static_option('about_page_'.$lang->slug.'_experience_title',$request->$experience_title);
            update_static_option('about_page_'.$lang->slug.'_experience_description',$request->$experience_description);
            update_static_option('about_page_'.$lang->slug.'_experience_video_url',$request->$_experience_video_url);
            update_static_option('about_page_'.$lang->slug.'_quote_text',$request->$quote_text);
        }
        update_static_option('about_page_experience_signature_image',$request->about_page_experience_signature_image);
        update_static_option('about_page_experience_video_background_image',$request->about_page_experience_video_background_image);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function about_page_testimonial_section(){
        $all_language = Language::all();
        return view('backend.pages.about-page.testimonial-section')->with(['all_languages' => $all_language]);
    }

    public function about_page_update_testimonial_section(Request $request){

        $this->validate($request,[
            'about_page_testimonial_background_image' => 'nullable|string',
            'about_page_testimonial_item' => 'nullable|string',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request ,[
                'about_page_'.$lang->slug.'_testimonial_title' => 'nullable|string',
            ]);

            $testimonial_title = 'about_page_'.$lang->slug.'_testimonial_title';

            update_static_option('about_page_'.$lang->slug.'_testimonial_title',$request->$testimonial_title);
        }

        update_static_option('about_page_testimonial_background_image',$request->about_page_testimonial_background_image);
        update_static_option('about_page_testimonial_item',$request->about_page_testimonial_item);

        return redirect()->back()->with([
            'msg' =>  __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }
    public function about_page_team_member_section(){
        $all_language = Language::all();
        return view('backend.pages.about-page.team-section')->with(['all_languages' => $all_language]);
    }

    public function about_page_update_team_member_section (Request $request){
        $this->validate($request,[
            'about_page_team_member_item' => 'nullable|string',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request ,[
                'about_page_'.$lang->slug.'_team_member_section_title' => 'nullable|string',
                'about_page_'.$lang->slug.'_team_member_section_description' => 'nullable|string',
            ]);

            $experience_title = 'about_page_'.$lang->slug.'_team_member_section_title';
            $experience_description = 'about_page_'.$lang->slug.'_team_member_section_description';

            update_static_option('about_page_'.$lang->slug.'_team_member_section_title',$request->$experience_title);
            update_static_option('about_page_'.$lang->slug.'_team_member_section_description',$request->$experience_description);
        }
        update_static_option('about_page_team_member_item',$request->about_page_team_member_item);

        return redirect()->back()->with([
            'msg' =>  __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }

    public function about_page_section_manage(){
        return view('backend.pages.about-page.section-manage');
    }

    public function about_page_update_section_manage(Request $request){

        $this->validate($request,[
            'about_page_about_us_section_status' => 'nullable|string',
            'about_page_brand_logo_section_status' => 'nullable|string',
            'about_page_team_member_section_status' => 'nullable|string',
            'about_page_testimonial_section_status' => 'nullable|string',
            'about_page_experience_section_status' => 'nullable|string',
            'about_page_key_feature_section_status' => 'nullable|string',
            'about_page_global_network_section_status' => 'nullable|string',
        ]);
        $fields = [
            'about_page_testimonial_section_status',
            'about_page_about_us_section_status',
            'about_page_brand_logo_section_status',
            'about_page_team_member_section_status',
            'about_page_experience_section_status',
            'about_page_key_feature_section_status',
            'about_page_global_network_section_status',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());

    }

}
