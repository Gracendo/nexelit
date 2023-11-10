<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact_page_form_area(){
        $all_language = Language::all();
        return view('backend.pages.contact-page.form-section')->with(['all_languages' => $all_language]);
    }
    public function contact_page_update_form_area(Request $request){
        $this->validate($request,[
           'contact_page_form_receiving_mail' => 'nullable|string'
        ]);
        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'contact_page_'.$lang->slug.'_form_section_title' => 'nullable|string',
                'contact_page_'.$lang->slug.'_form_submit_btn_text' => 'nullable|string',
            ]);
            $field = 'contact_page_'.$lang->slug.'_form_section_title';
            $form_submit_btn_text = 'contact_page_'.$lang->slug.'_form_submit_btn_text';

            update_static_option('contact_page_'.$lang->slug.'_form_section_title',$request->$field);
            update_static_option('contact_page_'.$lang->slug.'_form_submit_btn_text',$request->$form_submit_btn_text);
        }
        update_static_option('contact_page_form_receiving_mail',$request->contact_page_form_receiving_mail);

        return redirect()->back()->with(['msg' => __('Settings Updated..'),'type' => 'success']);
    }
    public function contact_page_map_area(){
        return view('backend.pages.contact-page.google-map-section');
    }
    public function contact_page_update_map_area(Request $request){
        $this->validate($request,[
            'contact_page_map_section_location' => 'required|string',
            'contact_page_map_section_zoom' => 'required|string',
        ]);
        update_static_option('contact_page_map_section_location',$request->contact_page_map_section_location);
        update_static_option('contact_page_map_section_zoom',$request->contact_page_map_section_zoom);

        return redirect()->back()->with(['msg' => __('Settings Updated..'),'type' => 'success']);
    }

    public function contact_page_section_manage(){

        return view('backend.pages.contact-page.section-manage');
    }

    public function contact_page_update_section_manage(Request $request){
        $this->validate($request,[
            'contact_page_contact_info_section_status' => 'nullable|string',
            'contact_page_contact_section_status' => 'nullable|string',
        ]);
        update_static_option('contact_page_contact_info_section_status',$request->contact_page_contact_info_section_status);
        update_static_option('contact_page_contact_section_status',$request->contact_page_contact_section_status);

        return redirect()->back()->with(['msg' => __('Settings Updated..'),'type' => 'success']);
    }
}
