<?php

namespace App\Http\Controllers;

use App\ContactInfoItem;
use App\Language;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_contact_info = ContactInfoItem::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.contact-page.contact-info')->with(['all_contact_info' => $all_contact_info,'all_languages' => $all_language]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::create($request->all());
        return redirect()->back()->with(['msg' => __('New Contact Info Item Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::find($request->id)->update($request->all());
        return redirect()->back()->with(['msg' => __('Contact Info Item Updated...'),'type' => 'success']);
    }

    public function delete($id){
        ContactInfoItem::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = ContactInfoItem::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }
}
