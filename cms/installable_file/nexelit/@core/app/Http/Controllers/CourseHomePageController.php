<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helpers\NexelitHelpers;
use App\Language;
use Illuminate\Http\Request;

class CourseHomePageController extends Controller
{
    public $base_view_path = 'backend.pages.home.course.';
    public $languages;
    public function __construct(){
        $this->middleware('auth:admin');
        $this->languages = Language::all();
    }

    public function header_area(){
        return view($this->base_view_path.'header')->with(['all_languages' => $this->languages]);
    }
    public function speciality_area(){
        return view($this->base_view_path.'speciality-area')->with(['all_languages' => $this->languages]);
    }
    public function featured_courses_area(){
        $all_courses = Course::with('lang')->where(['status' => 'publish'])->get();
        return view($this->base_view_path.'featured-courses-area')->with(['all_languages' => $this->languages,'all_courses' => $all_courses]);
    }
    public function update_header_area(Request $request){

        $this->validate($request,[
            'home_page_17_header_area_button_url' => 'nullable|string',
            'home_page_17_header_area_button_icon' => 'nullable|string',
            'home_page_17_header_area_background_image' => 'nullable|string',
            'home_page_17_header_area_right_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_17_'.$lang->slug.'_header_area_title' => 'nullable|string',
                'home_page_17_'.$lang->slug.'_header_area_description' => 'nullable|string',
                'home_page_17_'.$lang->slug.'_header_area_button_text' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_17_'.$lang->slug.'_header_area_title',
                'home_page_17_'.$lang->slug.'_header_area_description',
                'home_page_17_'.$lang->slug.'_header_area_button_text'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_17_header_area_button_url',
            'home_page_17_header_area_button_icon',
            'home_page_17_header_area_background_image',
            'home_page_17_header_area_right_image',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with(NexelitHelpers::settings_update());
    }

    public function update_speciality_area(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_specialities_area_title' => 'nullable|string',
                'course_home_page_specialities_item_icon' => 'required|array',
                'course_home_page_specialities_item_icon.*' => 'required|string',
                'course_home_page_specialities_item_url' => 'nullable|array',
                'course_home_page_specialities_item_url.*' => 'nullable|string',
                'course_home_page_'.$lang->slug.'_specialities_item_title' => 'nullable|array',
                'course_home_page_'.$lang->slug.'_specialities_item_title.*' => 'nullable|string',
                'course_home_page_'.$lang->slug.'_specialities_item_description' => 'nullable|array',
                'course_home_page_'.$lang->slug.'_specialities_item_description.*' => 'nullable|string',
            ],[
                'course_home_page_specialities_item_icon.required' => __('icon field is required'),
            ]);

            //save repeater values
            $all_fields = [
                'course_home_page_'.$lang->slug.'_specialities_item_title',
                'course_home_page_'.$lang->slug.'_specialities_item_description',
                'course_home_page_specialities_item_icon',
                'course_home_page_specialities_item_url',
            ];
            foreach ($all_fields as $field){
                $field_val = !empty($request->$field) ? $request->$field : [];
                update_static_option($field,serialize($field_val));
            }

            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_specialities_area_title',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function update_featured_courses_area(Request $request){
        $this->validate($request,[
           'featured_courses_ids' => 'required|array'
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_featured_course_area_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_featured_course_area_title',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        $all_fields = [
            'featured_courses_ids',
        ];
        foreach ($all_fields as $field){
            $field_val = !empty($request->$field) ? $request->$field : [];
            update_static_option($field,serialize($field_val));
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function video_area(){
        return view($this->base_view_path.'video-area')->with(['all_languages' => $this->languages]);
    }

    public function update_video_area (Request $request){
        $this->validate($request,[
            'course_home_page_video_section_background_image'  => 'nullable|string',
            'course_home_page_video_section_video_url'  => 'nullable|string',
        ]);

        update_static_option('course_home_page_video_section_background_image',$request->course_home_page_video_section_background_image);
        update_static_option('course_home_page_video_section_video_url',$request->course_home_page_video_section_video_url);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function all_courses_area(){
        return view($this->base_view_path.'all-courses-area')->with(['all_languages' => $this->languages]);
    }
    public function all_testimonial_area(){
        return view($this->base_view_path.'testimonial-area')->with(['all_languages' => $this->languages]);
    }
    public function update_all_testimonial_area (Request $request){
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_testimonial_area_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_testimonial_area_title',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function update_all_courses_area (Request $request){
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_all_course_area_title' => 'nullable|string',
                'course_home_page_'.$lang->slug.'_all_course_area_button_text' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_all_course_area_title',
                'course_home_page_'.$lang->slug.'_all_course_area_button_text',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('course_home_page_all_course_area_items',$request->course_home_page_all_course_area_items);

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }

    public function all_event_area(){
        return view($this->base_view_path.'event-area')->with(['all_languages' => $this->languages]);
    }

    public function update_all_event_area (Request $request){
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_event_area_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_event_area_title',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('home_page_01_event_area_items',$request->home_page_01_event_area_items);

        return back()->with(NexelitHelpers::settings_update());
    }

    public function cta_area(){
        return view($this->base_view_path.'cta-area')->with(['all_languages' => $this->languages]);
    }
    public function update_cta_area (Request $request){
        $this->validate($request,[
           'course_home_page_cta_section_button_icon' => 'nullable|string',
           'course_home_page_cta_area_button_url' => 'nullable|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'course_home_page_'.$lang->slug.'_cta_area_title' => 'nullable|string',
                'course_home_page_'.$lang->slug.'_cta_area_button_status' => 'nullable|string',
                'course_home_page_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
            ]);
            $non_seralize_fields = [
                'course_home_page_'.$lang->slug.'_cta_area_title',
                'course_home_page_'.$lang->slug.'_cta_area_button_status',
                'course_home_page_'.$lang->slug.'_cta_area_button_title',
            ];
            foreach ($non_seralize_fields as $field){
                update_static_option($field,$request->$field);
            }
        }
        update_static_option('course_home_page_cta_area_button_url',$request->course_home_page_cta_area_button_url);
        update_static_option('course_home_page_cta_section_button_icon',$request->course_home_page_cta_section_button_icon);

        return back()->with(NexelitHelpers::settings_update());
    }
}
