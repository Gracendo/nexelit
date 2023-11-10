<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Donation;
use App\Http\Requests\SlugCheckRequest;
use App\Knowledgebase;
use App\KnowledgebaseTopic;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KnowledgebaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_knowledgebases()
    {
        $all_articles = Knowledgebase::all()->groupBy('lang');
        return view('backend.knowledgebase.all-knowledgebase')->with(['all_article' => $all_articles]);
    }

    public function new_knowledgebase()
    {
        $all_languages = Language::all();
        $all_topics = KnowledgebaseTopic::where(['status' => 'publish', 'lang' => get_default_language()])->get();

        return view('backend.knowledgebase.new-knowledgebase')->with(['all_languages' => $all_languages, 'all_topics' => $all_topics]);
    }

    public function store_knowledgebases(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'topic_content' => 'required|string',
            'topic_id' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        $slug_check = Knowledgebase::where(['slug' => $slug,'lang' => $request->lang])->count();
        $slug = $slug_check > 0 ? $slug.'2' : $slug;
        Knowledgebase::create([
            'title' => $request->title,
            'content' => $request->topic_content,
            'topic_id' => $request->topic_id,
            'status' => $request->status,
            'lang' => $request->lang,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'slug' => $slug
        ]);

        return redirect()->back()->with(['msg' => __('New Article Added Success...'), 'type' => 'success']);
    }

    public function clone_knowledgebases(Request $request)
    {

        $knowledgebase_item = Knowledgebase::find($request->item_id);
        Knowledgebase::create([
            'title' => $knowledgebase_item->title,
            'content' => $knowledgebase_item->content,
            'topic_id' => $knowledgebase_item->topic_id,
            'meta_tags' => $knowledgebase_item->meta_tags,
            'meta_description' => $knowledgebase_item->meta_description,
            'status' => 'draft',
            'lang' => $knowledgebase_item->lang,
            'slug' => !empty($knowledgebase_item->slug) ? $knowledgebase_item->slug : Str::slug($knowledgebase_item->title)
        ]);

        return redirect()->back()->with(['msg' => __('Article Clone Success...'), 'type' => 'success']);
    }

    public function delete_knowledgebases($id)
    {
        Knowledgebase::find($id)->delete();

        return redirect()->back()->with(['msg' => __('Knowledgebase Item Delete Success...'), 'type' => 'danger']);
    }

    public function edit_knowledgebases($id)
    {
        $articles = Knowledgebase::find($id);
        $all_languages = Language::all();
        $all_topics = KnowledgebaseTopic::where(['status' => 'publish', 'lang' => $articles->lang])->get();

        return view('backend.knowledgebase.edit-knowledgebase')->with(['articles' => $articles, 'all_languages' => $all_languages, 'all_topics' => $all_topics]);
    }

    public function update_knowledgebases(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'topic_content' => 'required|string',
            'topic_id' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
        ]);

        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        $slug_check = Knowledgebase::where(['slug' => $slug,'lang' => $request->lang])->count();
        $slug = $slug_check > 1 ? $slug.'2' : $slug;

        Knowledgebase::find($request->article_id)->update([
            'title' => $request->title,
            'content' => $request->topic_content,
            'topic_id' => $request->topic_id,
            'status' => $request->status,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'lang' => $request->lang,
            'slug' => $slug
        ]);

        return redirect()->back()->with(['msg' => __('Article Update Success...'), 'type' => 'success']);
    }

    public function page_settings()
    {
        $all_languages = Language::all();
        $all_topics = KnowledgebaseTopic::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        return view('backend.knowledgebase.knowledgebase-page-settings')->with(['all_languages' => $all_languages, 'all_topics' => $all_topics]);
    }

    public function update_page_settings(Request $request)
    {
        $all_language = Language::all();
        foreach ($all_language as $lang) {
            $this->validate($request, [
                'site_knowledgebase_category_' . $lang->slug . '_title' => 'nullable',
                'site_knowledgebase_popular_widget_' . $lang->slug . '_title' => 'nullable',
                'site_knowledgebase_article_topic_' . $lang->slug . '_title' => 'nullable',
            ]);

            $fields = [
                'site_knowledgebase_category_' . $lang->slug . '_title',
                'site_knowledgebase_popular_widget_' . $lang->slug . '_title',
                'site_knowledgebase_article_topic_' . $lang->slug . '_title'
            ];
            foreach ($fields as $field){
                update_static_option($field, $request->$field);
            }
        }

        update_static_option('site_knoeledgebase_post_items', $request->site_knoeledgebase_post_items);

        return redirect()->back()->with(['msg' => __('Knowledgebase Page Settings Update Success...'), 'type' => 'success']);
    }

    public function bulk_action(Request $request){
        Knowledgebase::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }


    public function slug_check(SlugCheckRequest $request){

        $user_given_slug = $request->slug;
        $query = Knowledgebase::where(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }
}
