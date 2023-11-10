<?php

namespace App\Http\Controllers;

use App\Language;
use App\PopupBuilder;
use Illuminate\Http\Request;

class PopupBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function new_popup(){
        $all_languages = Language::all();
        return view('backend.popup-builder.popup-new')->with(['all_languages' => $all_languages]);
    }

    public function store_popup(Request $request){
        $this->validate($request,[
            'lang' => 'required|string',
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::create([
            'lang' => $request->lang,
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('New Popup Added') , 'type' => 'success']);
    }

    public function all_popup(){
        $all_popup = PopupBuilder::all()->groupBy('lang');
        return view('backend.popup-builder.popup-all')->with(['all_popup' => $all_popup]);
    }

    public function delete_popup(Request $request,$id){
        PopupBuilder::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Popup Deleted...'),'type' => 'danger']);
    }

    public function edit_popup($id){
        $all_languages = Language::all();
        $popup = PopupBuilder::find($id);
        return view('backend.popup-builder.popup-edit')->with(['all_languages' => $all_languages,'popup' => $popup]);
    }

    public function update_popup(Request $request,$id){
        $this->validate($request,[
            'lang' => 'required|string',
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::find($id)->update([
            'lang' => $request->lang,
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('Popup Update Success') , 'type' => 'success']);
    }
    public function clone_popup(Request $request,$id){
        $popup_details = PopupBuilder::find($id);
        PopupBuilder::create([
            'lang' => $popup_details->lang,
            'name' => $popup_details->name,
            'title' => $popup_details->title,
            'type' => $popup_details->type,
            'description' => $popup_details->description,
            'offer_time_end' => $popup_details->offer_time_end,
            'btn_status' => $popup_details->btn_status,
            'button_text' => $popup_details->button_text,
            'button_link' => $popup_details->button_link,
            'background_image' => $popup_details->background_image,
            'only_image' => $popup_details->only_image,
        ]);
        return redirect()->back()->with(['msg' => __('Popup Clone Success') , 'type' => 'success']);
    }

    public function bulk_action(Request $request){
        PopupBuilder::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
