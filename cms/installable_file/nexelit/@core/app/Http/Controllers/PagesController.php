<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Language;
use App\Page;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $all_page = Page::all()->groupBy('lang');
        $all_language = Language::all();
        return view('backend.pages.page.index')->with([
            'all_page' => $all_page,
            'all_languages' => $all_language,
        ]);
    }
    public function new_page(){
        $all_language = Language::all();
        return view('backend.pages.page.new')->with(['all_languages' => $all_language]);
    }

    public function slug_check(Request $request){
        $this->validate($request,[
           'slug' => 'required|string',
           'type' => 'required|string',
           'lang' => 'required|string',
        ]);

        $pre_made_pages_slug = ['video_gallery','about','service','work','team','faq','price_plan','blog','contact','career_with_us','events','knowledgebase','donation','product','testimonial','feedback','clients_feedback','image_gallery','donor','appointment','quote','courses','support_ticket'];
        $matched_pre_made_page_slug = false;
        $user_given_slug = $request->slug;
        foreach($pre_made_pages_slug as $page_slug){
            if ($request->slug === get_static_option($page_slug.'_page_slug')){
                $matched_pre_made_page_slug = true;
            }
        }

        if ($matched_pre_made_page_slug){
            $user_given_slug .= '-'.random_int(1,9);
        }

        $query = Page::where(['slug' => $user_given_slug]);
        if (!empty($request->lang)){
            $query->where('lang' , $request->lang);
        }
        $slug_count = $query->count();

        if ($request->type === 'new' && $slug_count > 0){
            return $user_given_slug.'-'.$slug_count;
        }elseif ($request->type === 'update' && $slug_count > 1){
            return $user_given_slug.'-'.$slug_count;
        }
        return $user_given_slug;
    }


    public function store_new_page(Request $request){

        $this->validate($request,[
            'content' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'lang' => 'nullable',
            'title' => 'required',
            'slug' => 'nullable',
            'visibility' => 'nullable',
            'status' => 'required|string|max:191',
        ]);

        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Page::create([
            'lang' => $request->lang,
            'breadcrumb_status' => $request->breadcrumb_status,
            'slug' => $slug,
            'status' => $request->status,
            'content' => $request->page_content,
            'title' => $request->title,
            'visibility' => $request->visibility,
            'page_builder_status' => $request->page_builder_status,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->back()->with([
            'msg' => __('New Page Created...'),
            'type' => 'success'
        ]);
    }
    public function edit_page($id){
        $page_post = Page::find($id);
        $all_language = Language::all();
        return view('backend.pages.page.edit')->with([
            'page_post' => $page_post,
            'all_languages' => $all_language
        ]);
    }
    public function update_page(Request $request,$id){

        $this->validate($request,[
            'content' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'lang' => 'nullable',
            'title' => 'required',
            'slug' => 'nullable',
            'visibility' => 'nullable',
            'status' => 'required|string|max:191',
        ]);

        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);

        Page::where('id',$id)->update([
            'lang' => $request->lang,
            'status' => $request->status,
            'content' => $request->page_content,
            'visibility' => $request->visibility,
            'page_builder_status' => $request->page_builder_status,
            'breadcrumb_status' => $request->breadcrumb_status,
            'title' => $request->title,
            'slug' => $slug,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
        ]);


        return redirect()->back()->with([
            'msg' => __('Page updated...'),
            'type' => 'success'
        ]);
    }
    public function delete_page(Request $request,$id){
        Page::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Page Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function bulk_action(Request $request){
        Page::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
