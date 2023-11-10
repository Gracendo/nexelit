<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class Error404PageManage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function error_404_page_settings(){
        $all_languages = Language::all();
        return view('backend.pages.404.404-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_error_404_page_settings(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'error_404_page_'.$lang->slug.'_title' => 'nullable|string',
                'error_404_page_'.$lang->slug.'_subtitle' => 'nullable|string',
                'error_404_page_'.$lang->slug.'_paragraph' => 'nullable|string',
                'error_404_page_'.$lang->slug.'_button_text' => 'nullable|string',
            ]);
            $fields = [
                'error_404_page_'.$lang->slug.'_title',
                'error_404_page_'.$lang->slug.'_subtitle',
                'error_404_page_'.$lang->slug.'_paragraph',
                'error_404_page_'.$lang->slug.'_button_text'
            ];
            foreach ($fields as $filed){
                update_static_option($filed,$request->$filed);
            }
        }


        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }
}
