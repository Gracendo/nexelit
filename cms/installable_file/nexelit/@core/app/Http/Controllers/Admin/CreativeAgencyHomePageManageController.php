<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreativeAgencyHomePageManageController extends Controller
{
    const   BASE_PATH = 'backend.pages.home.creative-agency-two.';
    public function __construct() {
        $this->middleware('auth:admin');
    }
    public function header_area(){
        return view(self::BASE_PATH.'header-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function services_area(){
        return view(self::BASE_PATH.'services-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function project_area(){
        return view(self::BASE_PATH.'project-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function counterup_area(){
        return view(self::BASE_PATH.'counterup-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function blog_area(){
        return view(self::BASE_PATH.'blog-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function testimonial_area(){
        return view(self::BASE_PATH.'testimonial-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function contact_area(){
        return view(self::BASE_PATH.'contact-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function newsletter_area(){
        return view(self::BASE_PATH.'newsletter-area')->with(['all_languages' => LanguageHelper::all_languages() ]);
    }
    public function header_area_update(Request $request){
        $this->validate($request,[
            'home21_header_section_background_image' => 'nullable|string',
            'home21_header_section_right_image' => 'nullable|string',
            'home21_header_section_text_image' => 'nullable|string',
            'home21_header_section_title_shape_image' => 'nullable|string',
            'home21_header_section_shape_01_image' => 'nullable|string',
            'home21_header_section_shape_02_image' => 'nullable|string',
            'home21_header_section_shape_03_image' => 'nullable|string',
            'home21_header_section_button_one_url' => 'nullable|string',
            'home21_header_section_button_two_url' => 'nullable|string',
        ]);
        //todo save data to db serialize data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_header_section_'.$lang->slug.'_social_text' => 'nullable|array',
                'home_21_header_section_'.$lang->slug.'_social_text.*' => 'nullable|string',
                'home21_header_section_social_url' => 'required|array',
                'home21_header_section_social_url.*' => 'required|string',
            ]);

            //save repeater values
            $all_fields = [
                'home_21_header_section_'.$lang->slug.'_social_text',
                'home21_header_section_social_url'
            ];
            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_header_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_header_section_'.$lang->slug.'_description' => 'nullable|string',
                'home_21_header_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'home_21_header_section_'.$lang->slug.'_button_two_text' => 'nullable|string',
                'home_21_header_section_'.$lang->slug.'_button_two_info_text' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_header_section_'.$lang->slug.'_title',
                'home_21_header_section_'.$lang->slug.'_description',
                'home_21_header_section_'.$lang->slug.'_button_one_text',
                'home_21_header_section_'.$lang->slug.'_button_two_text',
                'home_21_header_section_'.$lang->slug.'_button_two_info_text'
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }



        //todo save normal field to db
        $fields = [
            'home21_header_section_background_image',
            'home21_header_section_right_image',
            'home21_header_section_text_image',
            'home21_header_section_title_shape_image',
            'home21_header_section_shape_01_image',
            'home21_header_section_shape_02_image',
            'home21_header_section_shape_03_image',
            'home21_header_section_button_one_url',
            'home21_header_section_button_two_url',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function services_area_update(Request $request){
        $this->validate($request,[
            'home_21_service_section_button_one_url' => 'nullable|string',
            'home_page_01_service_area_items' => 'nullable|string',
        ]);

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_service_section_'.$lang->slug.'_button_one_text' => 'nullable|string',
                'home_21_service_section_'.$lang->slug.'_description' => 'nullable|string',
                'home_21_service_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_service_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_service_section_'.$lang->slug.'_button_one_text',
                'home_21_service_section_'.$lang->slug.'_description',
                'home_21_service_section_'.$lang->slug.'_title',
                'home_21_service_section_'.$lang->slug.'_subtitle',
                'home_21_service_section_'.$lang->slug.'_item_explore_one_text',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }



        //todo save normal field to db
        $fields = [
            'home_21_service_section_button_one_url',
            'home_page_01_service_area_items',
            'home21_services_section_right_shape_image',
            'home21_services_section_left_shape_image',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function project_area_update(Request $request){

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_project_section_'.$lang->slug.'_item_explore_one_text' => 'nullable|string',
                'home_21_project_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_project_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_project_section_'.$lang->slug.'_item_explore_one_text',
                'home_21_project_section_'.$lang->slug.'_title',
                'home_21_project_section_'.$lang->slug.'_subtitle',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return back()->with(NexelitHelpers::item_update());
    }
    public function counterup_area_update(Request $request){

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_counterup_section_'.$lang->slug.'_description' => 'nullable|string',
                'home_21_counterup_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_counterup_section_'.$lang->slug.'_description',
                'home_21_counterup_section_'.$lang->slug.'_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return back()->with(NexelitHelpers::item_update());
    }

    public function blog_area_update(Request $request){

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_blog_section_'.$lang->slug.'_item_keep_reading_text' => 'nullable|string',
                'home_21_blog_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_blog_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_blog_section_'.$lang->slug.'_item_keep_reading_text',
                'home_21_blog_section_'.$lang->slug.'_subtitle',
                'home_21_blog_section_'.$lang->slug.'_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return back()->with(NexelitHelpers::item_update());
    }


    public function testimonial_area_update(Request $request){
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_testimonial_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_testimonial_section_'.$lang->slug.'_subtitle' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_testimonial_section_'.$lang->slug.'_subtitle',
                'home_21_testimonial_section_'.$lang->slug.'_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }


        return back()->with(NexelitHelpers::item_update());
    }

    public function contact_area_update(Request $request){

        //todo save data to db serialize data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_contact_section_'.$lang->slug.'_info_item_title' => 'nullable|array',
                'home_21_contact_section_'.$lang->slug.'_info_item_title.*' => 'nullable|string',
                'home_21_contact_section_'.$lang->slug.'_info_item_details' => 'nullable|array',
                'home_21_contact_section_'.$lang->slug.'_info_item_details.*' => 'nullable|string',
                'home21_contact_section_info_item_icon' => 'required|array',
                'home21_contact_section_info_item_icon.*' => 'required|string',
            ]);

            //save repeater values
            $all_fields = [
                'home_21_contact_section_'.$lang->slug.'_info_item_details',
                'home_21_contact_section_'.$lang->slug.'_info_item_title',
                'home21_contact_section_info_item_icon'
            ];
            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_contact_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_contact_section_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_contact_section_'.$lang->slug.'_title',
                'home_21_contact_section_'.$lang->slug.'_button_text',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function newsletter_area_update(Request $request){
        //todo save langauge wise data
        $this->validate($request,[
            'home_21_newsletter_section_shape_image' => 'nullable|integer'
        ]);
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_21_newsletter_section_'.$lang->slug.'_subtitle' => 'nullable|string',
                'home_21_newsletter_section_'.$lang->slug.'_title' => 'nullable|string',
                'home_21_newsletter_section_'.$lang->slug.'_placeholder_text' => 'nullable|string',
            ]);

            $field_list = [
                'home_21_newsletter_section_'.$lang->slug.'_title',
                'home_21_newsletter_section_'.$lang->slug.'_subtitle',
                'home_21_newsletter_section_'.$lang->slug.'_placeholder_text',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_21_newsletter_section_shape_image',$request->home_21_newsletter_section_shape_image);

        return back()->with(NexelitHelpers::item_update());
    }

}
