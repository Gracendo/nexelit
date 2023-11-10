<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewspaperHomePageManageController extends Controller
{
    const BASE_PATH = 'backend.pages.home.newspaper.';
    public function __construct() {
        $this->middleware('auth:admin');
    }
    public function header_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'header-area',compact('all_languages'));
    }
    public function breaking_news_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'breaking-news',compact('all_languages'));
    }
    public function advertisement_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'advertisement-area',compact('all_languages'));
    }
    public function popular_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'popular-news',compact('all_languages'));
    }
    public function video_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'video-area',compact('all_languages'));
    }
    public function sports_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'sports-news',compact('all_languages'));
    }
    public function hot_area(){
        $all_languages = LanguageHelper::all_languages();
        return view(self::BASE_PATH.'hot-news',compact('all_languages'));
    }

    public function hot_area_update(Request $request){
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home20_hot_news_section_'.$lang->slug.'_section_title' => 'nullable|string',
                'home20_hot_news_section_'.$lang->slug.'_categories' => 'nullable|array',
            ]);

            $field_list = [
                'home20_hot_news_section_'.$lang->slug.'_section_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }

            $field_list = [
                'home20_hot_news_section_'.$lang->slug.'_categories',
            ];

            foreach ($field_list as $field){
                update_static_option($field, json_encode($request->$field));
            }
        }

        update_static_option('home20_hot_news_section_items',$request->home20_hot_news_section_items);

        return back()->with(NexelitHelpers::item_update());
    }


    public function sports_area_update(Request $request){
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home20_sports_news_section_'.$lang->slug.'_section_title' => 'nullable|string',
                'home20_sports_news_section_'.$lang->slug.'_categories' => 'nullable|array',
            ]);

            $field_list = [
                'home20_sports_news_section_'.$lang->slug.'_section_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }

            $field_list = [
                'home20_sports_news_section_'.$lang->slug.'_categories',
            ];

            foreach ($field_list as $field){
                update_static_option($field, json_encode($request->$field));
            }
        }

        update_static_option('home20_sports_news_section_items',$request->home20_sports_news_section_items);

        return back()->with(NexelitHelpers::item_update());
    }

    public function blog_category_by_lang(Request $request){
        $categories = BlogCategory::where(['lang' => $request->lang,'status' => 'publish'])->get();
        return response()->json(['categories' => $categories,'selected' => json_decode(get_static_option($request->staticName))]);
    }

    public function video_area_update(Request $request){
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home20_video_news_section_'.$lang->slug.'_section_title' => 'nullable|string',
            ]);

            $field_list = [
                'home20_video_news_section_'.$lang->slug.'_section_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home20_video_news_section_items',$request->home20_video_news_section_items);

        return back()->with(NexelitHelpers::item_update());
    }

    public function advertisement_area_update(Request $request){

        $request->validate([
            'home_page_newspaper_advertisement_type'=> 'required',
            'home_page_newspaper_advertisement_size'=> 'required',
            'home_page_newspaper_advertisement_type_bottom'=> 'required',
            'home_page_newspaper_advertisement_size_bottom'=> 'required',
        ]);

        update_static_option('home_page_newspaper_advertisement_type',$request->home_page_newspaper_advertisement_type);
        update_static_option('home_page_newspaper_advertisement_size',$request->home_page_newspaper_advertisement_size);
        update_static_option('home_page_newspaper_advertisement_type_bottom',$request->home_page_newspaper_advertisement_type_bottom);
        update_static_option('home_page_newspaper_advertisement_size_bottom',$request->home_page_newspaper_advertisement_size_bottom);

        return back()->with(NexelitHelpers::item_update());
    }

    public function popular_area_update(Request $request){
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home20_popular_news_section_'.$lang->slug.'_section_title' => 'nullable|string',
                'home20_popular_news_section_'.$lang->slug.'_categories' => 'nullable|array',
            ]);

            $field_list = [
                'home20_popular_news_section_'.$lang->slug.'_section_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }

            $field_list = [
                'home20_popular_news_section_'.$lang->slug.'_categories',
            ];

            foreach ($field_list as $field){
                update_static_option($field, json_encode($request->$field));
            }
        }

        update_static_option('home20_popular_news_section_items',$request->home20_popular_news_section_items);

        return back()->with(NexelitHelpers::item_update());
    }

    public function breaking_news_area_update(Request $request){

        //todo save langauge wise data
        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_20_breaking_news_section_'.$lang->slug.'_title' => 'nullable|string',
            ]);

            $field_list = [
                'home_20_breaking_news_section_'.$lang->slug.'_title',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        return back()->with(NexelitHelpers::item_update());
    }

    public function header_area_update(Request $request){

        $this->validate($request,[
           'home20_header_section_items' => 'required|integer'
        ]);

        foreach (LanguageHelper::all_languages() as $lang){
            $this->validate($request,[
                'home_20_header_section_'.$lang->slug.'_readmore_text' => 'nullable|string',
            ]);

            $field_list = [
                'home_20_header_section_'.$lang->slug.'_readmore_text',
            ];

            foreach ($field_list as $field){
                update_static_option($field,$request->$field);
            }
        }

        update_static_option('home20_header_section_items',$request->home20_header_section_items);

        return back()->with(NexelitHelpers::item_update());
    }
}
