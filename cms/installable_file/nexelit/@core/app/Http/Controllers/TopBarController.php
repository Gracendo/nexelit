<?php

namespace App\Http\Controllers;

use App\Language;
use App\Menu;
use App\SocialIcons;
use App\SupportInfo;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function topbar_settings()
    {
        $all_languages = Language::all();
        $all_social_icons = SocialIcons::all();
        return view('backend.pages.topbar-settings')->with(['all_social_icons' => $all_social_icons,'all_languages' => $all_languages ]);
    }

    public function update_topbar_settings(Request $request)
    {

        $this->validate($request, [
            'navbar_button' => 'nullable|string',
            'navbar_button_custom_url' => 'nullable|string',
            'navbar_button_custom_url_status' => 'nullable|string',
        ]);

        update_static_option('navbar_button', $request->navbar_button);
        update_static_option('navbar_button_custom_url', $request->navbar_button_custom_url);
        update_static_option('navbar_button_custom_url_status', $request->navbar_button_custom_url_status);

        $all_lang = Language::all();
        foreach ($all_lang as $lang) {
            $filed_name = 'navbar_' . $lang->slug . '_button_text';
            update_static_option('navbar_' . $lang->slug . '_button_text', $request->$filed_name);
        }



        return redirect()->back()->with(['msg' => __('Navbar Settings Updated..'), 'type' => 'success']);
    }

    public function new_social_item(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'url' => 'required|string',
        ]);

        SocialIcons::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Social Item Added...'),
            'type' => 'success'
        ]);
    }
    public function update_social_item(Request $request){
        $this->validate($request,[
           'icon' => 'required|string',
           'url' => 'required|string',
        ]);

        SocialIcons::find($request->id)->update([
            'icon' => $request->icon,
            'url' => $request->url,
        ]);

        return redirect()->back()->with([
            'msg' => __('Social Item Updated...'),
            'type' => 'success'
        ]);
    }
    public function delete_social_item(Request $request,$id){
        SocialIcons::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Social Item Deleted...'),
            'type' => 'danger'
        ]);
    }

    public function update_top_menu(Request $request){

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'top_bar_'.$lang->slug.'_right_menu' => 'nullable|string|max:191'
            ]);
            $filed = 'top_bar_'.$lang->slug.'_right_menu';
            update_static_option('top_bar_'.$lang->slug.'_right_menu',$request->$filed);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
    }
    public function update_top_button(Request $request){

        $all_languages = Language::all();
        foreach ($all_languages as $lang){
            $this->validate($request,[
                'top_bar_'.$lang->slug.'_button_text' => 'nullable|string|max:191'
            ]);
            $filed = 'top_bar_'.$lang->slug.'_button_text';
            update_static_option('top_bar_'.$lang->slug.'_button_text',$request->$filed);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
    }

    public function store_info_item(Request $request){
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_title' => 'nullable|array',
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_title.*' => 'nullable|string',
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_details' => 'nullable|array',
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_details.*' => 'nullable|string',
                'home_page_07_topbar_section_info_item_icon' => 'required|array',
                'home_page_07_topbar_section_info_item_icon.*' => 'required|string',
            ],[
                'home_page_07_topbar_section_info_item_icon.required' => __('icon field is required'),
                'home_page_07_topbar_section_info_item_icon.array' => __('icon field must be an array'),
            ]);

            //save repeater values
            $all_fields = [
                'home_page_07_topbar_section_info_item_icon',
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_title',
                'home_page_07_'.$lang->slug.'_topbar_section_info_item_details'
            ];
            foreach ($all_fields as $field){
                $field_val = !empty($request->$field) ? $request->$field : [];
                update_static_option($field,serialize($field_val));
            }
        }

        return redirect()->back()->with([
            'msg' => __('Settings Update'),
            'type' => 'success'
        ]);
    }
}
