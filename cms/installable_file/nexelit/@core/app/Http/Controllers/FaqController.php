<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Language;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_faqs = Faq::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.faqs')->with(['all_faqs' => $all_faqs,'all_languages' => $all_language]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string',
            'lang' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
            'lang' => $request->lang,
            'status' => $request->status,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);


        return redirect()->back()->with(['msg' => __('New Faq Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string',
            'lang' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'lang' => $request->lang,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with(['msg' => __('Faq Updated...'),'type' => 'success']);
    }

    public function delete($id){
        Faq::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }

    public function clone(Request $request){
        $faq_item = Faq::find($request->item_id);
        Faq::create([
            'title' => $faq_item->title,
            'description' => $faq_item->description,
            'status' => 'draft',
            'lang' => $faq_item->lang,
            'is_open' => !empty($faq_item->is_open) ? 'on' : '',
        ]);
        return redirect()->back()->with(['msg' => __('Clone Success...'),'type' => 'success']);
    }

    public function bulk_action(Request $request){
        $all = Faq::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

}
