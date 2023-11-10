<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Language;
use App\Products;
use Illuminate\Http\Request;

class GroceryHomePageController extends Controller
{

    public $all_languages;
    const BASE_PATH = 'backend.pages.home.grocery.';
    public function __construct() {
        $this->middleware('auth:admin');
        if ($this->all_languages == null){
            $this->all_languages = Language::all();
        }
    }

    public function header_area(){
        return view(self::BASE_PATH.'header')->with(['all_languages' => $this->all_languages]);
    }

    public function update_header_area(Request $request){

        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_header_section_subtitle' => 'nullable|array',
                'grocery_home_page_'.$lang->slug.'_header_section_title' => 'nullable|array',
                'grocery_home_page_'.$lang->slug.'_header_section_description' => 'nullable|array',
                'grocery_home_page_'.$lang->slug.'_header_section_button_one_text' => 'nullable|array',
                'grocery_home_page_header_section_button_one_url' => 'nullable|array',
                'grocery_home_page_header_section_button_one_icon' => 'nullable|array',
                'grocery_home_page_header_section_bg_image' => 'required|array',
                'grocery_home_page_header_section_bg_image.*' => 'required|string',
            ]);

            //save repeater values
            $all_fields = [
                'grocery_home_page_'.$lang->slug.'_header_section_subtitle',
                'grocery_home_page_'.$lang->slug.'_header_section_title' ,
                'grocery_home_page_'.$lang->slug.'_header_section_description',
                'grocery_home_page_'.$lang->slug.'_header_section_button_one_text',
                'grocery_home_page_header_section_button_one_url' ,
                'grocery_home_page_header_section_button_one_icon',
                'grocery_home_page_header_section_bg_image'
            ];
            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function product_categories_area(){
        return view(self::BASE_PATH.'product-categories-area')->with(['all_languages' => $this->all_languages]);
    }
    public function update_product_categories_area(Request $request){
        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_product_category_area_title' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'grocery_home_page_'.$lang->slug.'_product_category_area_title',
            ];
            foreach ($all_fields as $field){
                update_static_option($field,$request->$field );
            }
        }
        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function offer_area(){
        return view(self::BASE_PATH.'offer-area')->with(['all_languages' => $this->all_languages]);
    }

    public function update_offer_area(Request $request){

        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_offer_item_image' => 'required|array',
                'grocery_home_page_offer_item_image.*' => 'required|string',
                'grocery_home_page_offer_item_button_url' => 'required|array',
                'grocery_home_page_offer_item_button_url.*' => 'required|string',
            ]);

            //save repeater values
            $all_fields = [
                'grocery_home_page_offer_item_image' ,
                'grocery_home_page_offer_item_button_url'
            ];
            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }

        return redirect()->back()->with(NexelitHelpers::settings_update());
    }
    public function popular_item_area(){
        $all_products = Products::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'popular-product-area')->with(['all_languages' => $this->all_languages,'all_products' => $all_products]);
    }
    public function update_popular_item_area(Request $request){

        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_featured_product_area_subtitle' => 'nullable|string',
                'grocery_home_page_'.$lang->slug.'_featured_product_area_title' => 'nullable|string',
                'home_page_15_'.$lang->slug.'_featured_product_area_items' => 'nullable|array',
            ]);
            $fields_list = [
                'grocery_home_page_'.$lang->slug.'_featured_product_area_subtitle',
                'grocery_home_page_'.$lang->slug.'_featured_product_area_title',
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

        return back()->with(NexelitHelpers::settings_update());
    }

    public function process_area(){
        return view(self::BASE_PATH.'process-area')->with(['all_languages' => $this->all_languages]);
    }

    public function update_process_area(Request $request){

        $this->validate($request,[
            'grocery_home_page_process_area_item_number' => 'required|array',
            'grocery_home_page_process_area_item_number.*' => 'required|string',
            'grocery_home_page_process_area_item_icon' => 'required|array',
            'grocery_home_page_process_area_item_icon.*' => 'required|string',
            'grocery_home_page_process_area_background_image' => 'nullable|string',
            'grocery_home_page_process_area_right_image' => 'nullable|string',
            'grocery_home_page_process_area_left_image' => 'nullable|string',
        ]);

        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_process_area_item_title' => 'nullable|array',
                'grocery_home_page_'.$lang->slug.'_process_area_item_description' => 'nullable|array',
            ]);
            $fields_list = [
                'grocery_home_page_'.$lang->slug.'_process_area_item_title',
                'grocery_home_page_'.$lang->slug.'_process_area_item_description',
                'grocery_home_page_process_area_item_icon',
                'grocery_home_page_process_area_item_number',
            ];

            foreach ($fields_list as $field){
                $value = $request->$field ?? [];
                update_static_option($field, serialize($value));
            }
        }

        $fields_list = [
            'grocery_home_page_process_area_background_image',
            'grocery_home_page_process_area_right_image',
            'grocery_home_page_process_area_left_image',
        ];
        foreach ($fields_list as $field){
            update_static_option($field, $request->$field);
        }


        return back()->with(NexelitHelpers::settings_update());
    }

    public function product_area(){
        return view(self::BASE_PATH.'product-area')->with(['all_languages' => $this->all_languages]);
    }
    public function update_product_area(Request $request){

        $this->validate($request,[
            'home_page_products_area_items' => 'nullable|string',
        ]);

        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_product_section_subtitle' => 'nullable|string',
                'grocery_home_page_'.$lang->slug.'_product_section_title' => 'nullable|string',
                'grocery_home_page_'.$lang->slug.'_product_section_button_text' => 'nullable|string',
            ]);
            $fields_list = [
                'grocery_home_page_'.$lang->slug.'_product_section_subtitle',
                'grocery_home_page_'.$lang->slug.'_product_section_title',
                'grocery_home_page_'.$lang->slug.'_product_section_button_text',
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


        return back()->with(NexelitHelpers::settings_update());
    }

    public function testimonial_area(){
        return view(self::BASE_PATH.'testimonial-area')->with(['all_languages' => $this->all_languages]);
    }

    public function update_testimonial_area(Request $request){
        foreach ($this->all_languages as $lang){
            $this->validate($request,[
                'grocery_home_page_'.$lang->slug.'_testimonial_area_title' => 'nullable|string',
                'grocery_home_page_'.$lang->slug.'_testimonial_area_subtitle' => 'nullable|string'
            ]);
            $fields_list = [
                'grocery_home_page_'.$lang->slug.'_testimonial_area_title',
                'grocery_home_page_'.$lang->slug.'_testimonial_area_subtitle'
            ];

            foreach ($fields_list as $field){
                update_static_option($field, $request->$field);
            }
        }
        return back()->with(NexelitHelpers::settings_update());
    }
}
