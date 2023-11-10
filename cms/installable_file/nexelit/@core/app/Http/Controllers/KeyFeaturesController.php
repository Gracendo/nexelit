<?php

namespace App\Http\Controllers;

use App\KeyFeatures;
use App\Language;
use Illuminate\Http\Request;

class KeyFeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_key_features = KeyFeatures::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.pages.key-features')->with(['all_key_features' => $all_key_features,'all_languages' => $all_languages]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
        ]);

        KeyFeatures::create($request->all());

        return redirect()->back()->with(['msg' => __('New Key Feature Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
        ]);

        KeyFeatures::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => __('Key Feature Updated...'),'type' => 'success']);
    }

    public function delete($id){
        KeyFeatures::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }

    public function update_section_settings(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){

            $this->validate($request,[
               'home_01_'.$lang->slug.'_key_feature_section_title' => 'nullable|string',
               'home_01_'.$lang->slug.'_key_feature_section_description' => 'nullable|string',
            ]);

            $filed_one = 'home_01_'.$lang->slug.'_key_feature_section_title';
            $filed_two = 'home_01_'.$lang->slug.'_key_feature_section_description';
            update_static_option('home_01_'.$lang->slug.'_key_feature_section_title',$request->$filed_one);
            update_static_option('home_01_'.$lang->slug.'_key_feature_section_description', $request->$filed_two);
        }
        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
    }

    public function bulk_action(Request $request){
        KeyFeatures::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
