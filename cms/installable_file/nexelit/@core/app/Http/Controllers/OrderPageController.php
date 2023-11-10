<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class OrderPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_language = Language::all();
        return view('backend.pages.order-page.form-section')->with(['all_languages' => $all_language]);
    }

    public function udpate(Request $request){
        $this->validate($request,[
            'order_page_form_mail' => 'nullable|string',
        ]);

        $all_language = Language::all();

        foreach ($all_language as $lang){

            $this->validate($request,[
                'order_page_'.$lang->slug.'_form_title' => 'nullable|string',
            ]);
            $field = 'order_page_'.$lang->slug.'_form_title';
            update_static_option('order_page_'.$lang->slug.'_form_title',$request->$field);
        }

        update_static_option('order_page_form_mail',$request->order_page_form_mail);

        return redirect()->back()->with(['msg' => __('Settings Updated....'),'type' => 'success']);
    }
}
