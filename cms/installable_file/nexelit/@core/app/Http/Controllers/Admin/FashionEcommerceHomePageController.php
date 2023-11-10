<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Products;
use Illuminate\Http\Request;

class FashionEcommerceHomePageController extends Controller
{
    const BASE_PATH = 'backend.pages.home.fashion.';

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function header_area(){
        return view(self::BASE_PATH.'header-area')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function header_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_19_header_section_'.$lang->slug.'_button_text' => 'nullable|array',
                'home_19_header_section_'.$lang->slug.'_title' => 'nullable|array',
                'home_19_header_section_'.$lang->slug.'_subtitle' => 'nullable|array',
                'home19_header_section_button_url' => 'required|array',
                'home19_header_section_button_url.*' => 'required|string',
                'home19_header_section_button_image' => 'nullable|array',
                'home19_header_section_button_image.*' => 'nullable|string',
            ]);

           //save repeater values
            $all_fields = [
                'home_19_header_section_'.$lang->slug.'_button_text',
                'home_19_header_section_'.$lang->slug.'_title',
                'home_19_header_section_'.$lang->slug.'_subtitle',
                'home19_header_section_button_url',
                'home19_header_section_image'
            ];

            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }
        return back()->with(NexelitHelpers::item_update());
    }

    public function todays_deal_area(){
        $all_products = Products::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'todays-deal-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products'=> $all_products]);
    }

    public function todays_deal_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_page_19_'.$lang->slug.'_todays_deal_area_title' => 'nullable',
                'home_page_19_'.$lang->slug.'_todays_deal_area_right_text' => 'nullable',
                'home_page_19_'.$lang->slug.'_todays_deal_products' => 'nullable',
            ]);

            $products = 'home_page_19_'.$lang->slug.'_todays_deal_products';

            //save repeater values
            $all_fields = [
                'home_page_19_'.$lang->slug.'_todays_deal_area_title' ,
                'home_page_19_'.$lang->slug.'_todays_deal_area_right_text',
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }

            update_static_option('home_page_19_'.$lang->slug.'_todays_deal_products',json_encode($request->$products));
        }
        return back()->with(NexelitHelpers::item_update());
    }

    public function updated_area(){
        $all_products = Products::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'updated-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products'=> $all_products]);
    }

    public function updated_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_19_updated_section_'.$lang->slug.'_button_text' => 'nullable|array',
                'home_19_updated_section_'.$lang->slug.'_title' => 'nullable|array',
                'home_19_updated_section_'.$lang->slug.'_subtitle' => 'nullable|array',
                'home19_updated_section_button_url' => 'required|array',
                'home19_updated_section_button_url.*' => 'required|string',
                'home19_updated_section_button_image' => 'nullable|array',
                'home19_updated_section_button_image.*' => 'nullable|string',
            ]);

            //save repeater values
            $all_fields = [
                'home_19_updated_section_'.$lang->slug.'_button_text',
                'home_19_updated_section_'.$lang->slug.'_title',
                'home_19_updated_section_'.$lang->slug.'_subtitle',
                'home19_updated_section_button_url',
                'home19_updated_section_image'
            ];

            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }
        return back()->with(NexelitHelpers::item_update());
    }

    public function store_area(){
        $all_products_category = ProductCategory::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'store-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products_category'=> $all_products_category]);
    }

    public function store_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home19_store_'.$lang->slug.'_section_title' => 'nullable',
                'home19_store_button_'.$lang->slug.'_text' => 'nullable',
                'home19_store_button_'.$lang->slug.'_url' => 'nullable',
            ]);

            $categories = 'home19_store_section_'.$lang->slug.'_categories';

            //save repeater values
            $all_fields = [
                'home19_store_'.$lang->slug.'_section_title' ,
                'home19_store_button_'.$lang->slug.'_text',
                'home19_store_button_'.$lang->slug.'_url',
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }

            update_static_option('home19_store_section_'.$lang->slug.'_categories',json_encode($request->$categories));
        }
        update_static_option('home19_store_section_category_items',$request->home19_store_section_category_items);
        return back()->with(NexelitHelpers::item_update());
    }

    public function clothing_area(){
        $all_products_category = ProductCategory::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'clothing-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products_category'=> $all_products_category]);
    }

    public function clothing_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home19_clothing_area_section_'.$lang->slug.'_title' => 'nullable',
                'home19_clothing_area_section_'.$lang->slug.'_subtitle' => 'nullable',
                'home19_clothing_area_section_'.$lang->slug.'_button_text' => 'nullable',
                'home19_clothing_area_section_'.$lang->slug.'_button_url' => 'nullable',
            ]);

            $all_fields = [
                'home19_clothing_area_section_'.$lang->slug.'_title',
                'home19_clothing_area_section_'.$lang->slug.'_subtitle',
                'home19_clothing_area_section_'.$lang->slug.'_button_text',
                'home19_clothing_area_section_'.$lang->slug.'_button_url'
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home19_clothing_area_section_left_image',$request->home19_clothing_area_section_left_image);
        update_static_option('home19_clothing_area_section_right_image',$request->home19_clothing_area_section_right_image);

        return back()->with(NexelitHelpers::item_update());
    }

    public function popular_area(){
        $all_products = Products::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'popular-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products'=> $all_products]);
    }

    public function popular_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){

            $this->validate($request,[
                'home_page_19_'.$lang->slug.'_popular_area_title' => 'nullable',
                'home_page_19_'.$lang->slug.'_popular_area_products' => 'nullable',
            ]);

            $products = 'home_page_19_'.$lang->slug.'_popular_area_products';

            $all_fields = [
                'home_page_19_'.$lang->slug.'_popular_area_title' ,
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }

            update_static_option($products,json_encode($request->$products));
        }
        return back()->with(NexelitHelpers::item_update());
    }

    public function instagram_area(){
        $all_products = Products::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        return view(self::BASE_PATH.'instagram-area')->with(['all_languages' => LanguageHelper::all_languages(), 'all_products'=> $all_products]);
    }

    public function instagram_area_update(Request $request)
    {

        foreach (LanguageHelper::all_languages() as $lang){

            $this->validate($request,[
                'home_page_19_'.$lang->slug.'_instagram_area_title' => 'nullable',
                'home_page_19_instagram_area_item_show' => 'nullable',
            ]);

            $all_fields = [
                'home_page_19_'.$lang->slug.'_instagram_area_title',
            ];

            foreach ($all_fields as $field){
                update_static_option($field,$request->$field);
            }

        }
          update_static_option('home_page_19_instagram_area_item_show',$request->home_page_19_instagram_area_item_show);

        return back()->with(NexelitHelpers::item_update());
    }


    public function promo_area(){
        return view(self::BASE_PATH.'promo-area')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function promo_area_update(Request $request){

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_19_promo_section_'.$lang->slug.'_title' => 'nullable|array',
                'home_19_promo_section_'.$lang->slug.'_subtitle' => 'nullable|array',
                'home_19_promo_section_'.$lang->slug.'_title_url' => 'required|array',

                'home19_promo_section_icon' => 'array|required',
                'home19_promo_section_icon.*' => 'string|required',
            ]);

            //save repeater values
            $all_fields = [
                'home_19_promo_section_'.$lang->slug.'_title',
                'home_19_promo_section_'.$lang->slug.'_subtitle',
               'home_19_promo_section_'.$lang->slug.'_title_url',
                'home19_promo_section_icon',
            ];

            foreach ($all_fields as $field){
                $value = $request->$field ?? [];
                update_static_option($field,serialize($value));
            }
        }
        return back()->with(NexelitHelpers::item_update());
    }

    public function product_by_lang(Request $request){

        $categories = Products::where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json(['categories' => $categories,'selected' => json_decode(get_static_option($request->staticName))]);
    }

    public function product_category_by_lang(Request $request){

        $categories = ProductCategory::where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json(['categories' => $categories,'selected' => json_decode(get_static_option($request->staticName))]);
    }


}
