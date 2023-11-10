<?php

namespace App\Http\Controllers;

use App\Language;
use App\Products;
use Illuminate\Http\Request;

class FrouitHomePageController extends Controller
{
    public $industry_home_base_view_path = 'backend.pages.home.fruit.';
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
            'home_page_15_header_area_button_url' => 'nullable|string',
            'home_page_15_header_area_button_icon' => 'nullable|string',
            'home_page_15_header_area_background_image' => 'nullable|string',
            'home_page_15_header_area_bottom_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_header_area_title' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_header_area_description' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_new_area_button_text' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_header_area_title',
                'home_page_15_'.$lang->slug.'_header_area_description',
                'home_page_15_'.$lang->slug.'_header_area_button_text'
            ];

            foreach ($fields_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        $fields = [
            'home_page_15_header_area_button_url',
            'home_page_15_header_area_button_icon',
            'home_page_15_header_area_background_image',
            'home_page_15_header_area_bottom_image',
        ];

        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function offer_area(){
        return view($this->industry_home_base_view_path.'offer-area')->with(['all_languages' => $this->languages]);
    }
    public function update_offer_area(Request $request){
        $this->validate($request,[
           'home_page_15_offer_item_button_url' => 'required|array',
           'home_page_15_offer_item_button_url.*' => 'required|string',
        ]);
        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_offer_item_title' => 'nullable|array',
                'home_page_15_'.$lang->slug.'_offer_item_short_description' => 'nullable|array',
                'home_page_15_'.$lang->slug.'_offer_item_button_text' => 'nullable|array',
                'home_page_15_offer_item_image' => 'nullable|array'
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_offer_item_title',
                'home_page_15_'.$lang->slug.'_offer_item_short_description',
                'home_page_15_'.$lang->slug.'_offer_item_button_text',
                'home_page_15_offer_item_button_url',
                'home_page_15_offer_item_image',
            ];

            foreach ($fields_list as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function featured_product_area(){
        $all_products = Products::where(['lang' => get_default_language(),'status' => 'publish'])->get();
        return view($this->industry_home_base_view_path.'featured-product-area')->with(['all_languages' => $this->languages,'all_products' => $all_products]);
    }

    public function featured_product_by_lang(Request $request){
        $selected_donation = unserialize(get_static_option('home_page_15_'.$request->lang.'_featured_product_area_items'),['class' => false]);
        $selected_items = is_array($selected_donation) && count($selected_donation) > 0 ? $selected_donation : [];
        $all_items = Products::select(['title','id'])->where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json([
            'product_items' => $all_items,
            'selected_items' => $selected_items
        ]);
    }

    public function update_featured_product_area(Request $request){

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_featured_product_area_subtitle' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_featured_product_area_title' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_featured_product_area_items' => 'nullable|array',
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_featured_product_area_subtitle',
                'home_page_15_'.$lang->slug.'_featured_product_area_title',
            ];

            foreach ($fields_list as $field){
                update_static_option($field, $request->$field);
            }

            //add serialize
            $featured_product_area_items = 'home_page_15_'.$lang->slug.'_featured_product_area_items';
            $feature_items = $request->$featured_product_area_items ?? [];
            if (!empty($feature_items)){
                update_static_option($featured_product_area_items, serialize($feature_items));
            }
        }

        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function process_area(){
        return view($this->industry_home_base_view_path.'process-area')->with(['all_languages' => $this->languages]);
    }

    public function update_process_area(Request $request){

        $this->validate($request,[
           'home_page_15_process_area_item_number' => 'required|array',
           'home_page_15_process_area_item_number.*' => 'required|string',
           'home_page_15_process_area_item_icon' => 'required|array',
           'home_page_15_process_area_item_icon.*' => 'required|string',
           'home_page_15_process_area_background_image' => 'nullable|string',
           'home_page_15_process_area_right_image' => 'nullable|string',
           'home_page_15_process_area_left_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_process_area_item_title' => 'nullable|array',
                'home_page_15_'.$lang->slug.'_process_area_item_description' => 'nullable|array',
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_process_area_item_title',
                'home_page_15_'.$lang->slug.'_process_area_item_description',
                'home_page_15_process_area_item_icon',
                'home_page_15_process_area_item_number',
            ];

            foreach ($fields_list as $field){
                $value = $request->$field ?? [];
                update_static_option($field, serialize($value));
            }
        }

        $fields_list = [
            'home_page_15_process_area_background_image',
            'home_page_15_process_area_right_image',
            'home_page_15_process_area_left_image',
        ];
        foreach ($fields_list as $field){
            update_static_option($field, $request->$field);
        }


        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function product_area(){
        return view($this->industry_home_base_view_path.'product-area')->with(['all_languages' => $this->languages]);
    }

    public function update_product_area(Request $request){

        $this->validate($request,[
            'home_page_products_area_items' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_product_section_subtitle' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_product_section_title' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_product_section_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_product_section_subtitle',
                'home_page_15_'.$lang->slug.'_product_section_title',
                'home_page_15_'.$lang->slug.'_product_section_button_text',
            ];

            foreach ($fields_list as $field){
                update_static_option($field, $request->$field);
            }
        }

        $fields_list = [
            'home_page_products_area_items',
        ];
        foreach ($fields_list as $field){
            update_static_option($field, $request->$field);
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
        $this->validate($request,[
            'home_page_15_testimonial_area_background_image' => 'nullable|string',
            'home_page_15_testimonial_area_right_image' => 'nullable|string',
            'home_page_15_testimonial_area_left_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_testimonial_area_title' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_testimonial_area_subtitle' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_testimonial_area_title',
                'home_page_15_'.$lang->slug.'_testimonial_area_subtitle'
            ];

            foreach ($fields_list as $field){
                update_static_option($field, $request->$field);
            }
        }

        $fields_list = [
            'home_page_15_testimonial_area_background_image',
            'home_page_15_testimonial_area_right_image',
            'home_page_15_testimonial_area_left_image',
        ];
        foreach ($fields_list as $field){
            update_static_option($field, $request->$field);
        }
        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

    public function top_selling_product_area(){
        return view($this->industry_home_base_view_path.'top-selling-product-area')->with(['all_languages' => $this->languages]);
    }

    public function update_top_selling_product_area(Request $request){
        $this->validate($request,[
            'home_page_15_top_selling_product_area_items' => 'nullable|string',
            'home_page_15_top_selling_product_area_right_image' => 'nullable|string',
            'home_page_15_top_selling_product_area_left_image' => 'nullable|string',
        ]);

        foreach ($this->languages as $lang){
            $this->validate($request,[
                'home_page_15_'.$lang->slug.'_top_selling_product_area_subtitle' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_top_selling_product_area_title' => 'nullable|string'
            ]);
            $fields_list = [
                'home_page_15_'.$lang->slug.'_top_selling_product_area_title',
                'home_page_15_'.$lang->slug.'_top_selling_product_area_subtitle'
            ];

            foreach ($fields_list as $field){
                update_static_option($field, $request->$field);
            }
        }

        $fields_list = [
            'home_page_15_top_selling_product_area_items',
            'home_page_15_top_selling_product_area_left_image',
            'home_page_15_top_selling_product_area_right_image',
        ];
        foreach ($fields_list as $field){
            update_static_option($field, $request->$field);
        }
        return back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }

}
