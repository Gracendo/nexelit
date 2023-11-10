<?php

namespace App\Http\Controllers;

use App\Events;
use App\EventsCategory;
use App\Language;
use Illuminate\Http\Request;

class EventsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_events_category(){

        $all_category = EventsCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.events.all-events-category')->with(['all_category' => $all_category,'all_languages' => $all_languages] );
    }

    public function store_events_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:events_categories',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        EventsCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Category Added...'),
            'type' => 'success'
        ]);
    }

    public function update_events_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        EventsCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with([
            'msg' => __( 'Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function delete_events_category(Request $request,$id){
        if (Events::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Event...'),
                'type' => 'danger'
            ]);
        }
        EventsCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function Category_by_language_slug(Request $request){
        $all_category = EventsCategory::where('lang',$request->lang)->get();

        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        EventsCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
