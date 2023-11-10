<?php

namespace App\Http\Controllers;

use App\Knowledgebase;
use App\KnowledgebaseTopic;
use App\Language;
use Illuminate\Http\Request;

class KnowledgebaseTopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_knowledgebase_category(){

        $all_category = KnowledgebaseTopic::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.knowledgebase.all-knowledgebase-category')->with(['all_category' => $all_category,'all_languages' => $all_languages] );
    }

    public function store_knowledgebase_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:knowledgebase_topics',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        KnowledgebaseTopic::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Topic Added...'),
            'type' => 'success'
        ]);
    }

    public function update_knowledgebase_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        KnowledgebaseTopic::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with([
            'msg' => __('Topic Update Success...'),
            'type' => 'success'
        ]);
    }

    public function delete_knowledgebase_category(Request $request,$id){
        if (Knowledgebase::where('topic_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Topic, It Already Associated With A Knowledge base Article...'),
                'type' => 'danger'
            ]);
        }
        KnowledgebaseTopic::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Topic Delete Success...',
            'type' => 'danger'
        ]);
    }

    public function category_by_language_slug(Request $request){
        $all_category = KnowledgebaseTopic::where('lang',$request->lang)->get();

        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        KnowledgebaseTopic::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
