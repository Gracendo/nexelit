<?php

namespace App\Http\Controllers;

use App\Actions\SlugChecker;
use App\Events;
use App\Http\Requests\SlugCheckRequest;
use App\Language;
use App\Works;
use App\WorksCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class WorksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $all_works = Works::all()->groupBy('lang');
        $work_category = WorksCategory::where(['status'=> 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();

        return view('backend.pages.works.work-index')->with(['all_works' => $all_works, 'works_category' => $work_category,'all_language' => $all_language]);
    }

    public function new()
    {
        $work_category = WorksCategory::where(['status'=> 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();

        return view('backend.pages.works.new-work')->with([ 'works_category' => $work_category,'all_language' => $all_language]);
    }

    public function edit($id)
    {
        $work_details = Works::find($id);
        $work_category = WorksCategory::where(['status'=> 'publish','lang' => $work_details->lang])->get();
        $all_language = Language::all();

        return view('backend.pages.works.edit-work')->with([ 'work_details' => $work_details, 'works_category' => $work_category,'all_language' => $all_language]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191',
            'excerpt' => 'nullable|string|max:191',
            'lang' => 'nullable|string|max:191',
            'clients' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'gallery' => 'nullable|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'budget' => 'required|string',
            'status' => 'required|string',
            'categories_id' => 'required',
            'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        Works::create([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'meta_tag' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'gallery' => $request->gallery,
            'lang' => $request->lang,
            'clients' => $request->clients,
            'duration' => $request->duration,
            'budget' => $request->budget,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $request->image,
            'categories_id' => serialize($request->categories_id),
        ]);

        return redirect()->back()->with(['msg' => __('New Case Study Added...'), 'type' => 'success']);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191',
            'excerpt' => 'nullable|string|max:191',
            'lang' => 'nullable|string|max:191',
            'clients' => 'nullable|string',
            'gallery' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'budget' => 'required|string',
            'status' => 'required|string',
            'categories_id' => 'required',
            'image' => 'nullable|string|max:191',
        ]);
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        Works::find($request->id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'excerpt' => $request->excerpt,
                'meta_tag' => $request->meta_tags,
                'meta_description' => $request->meta_description,
                'gallery' => $request->gallery,
                'lang' => $request->lang,
                'clients' => $request->clients,
                'duration' => $request->duration,
                'budget' => $request->budget,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $request->image,
                'categories_id' => serialize($request->categories_id),
            ]
        );
        return redirect()->back()->with(['msg' => __('Case Study Item Updated...'), 'type' => 'success']);
    }

    public function clone_new_draft(Request $request){
        $single_work = Works::find($request->item_id);
        Works::create(
            [
                'title' => $single_work->title,
                'slug' => $single_work->slug.random_int(999,9999),
                'excerpt' => $single_work->excerpt,
                'meta_tag' => $single_work->meta_tag,
                'meta_description' => $single_work->meta_description,
                'lang' => $single_work->lang,
                'clients' => $single_work->clients,
                'duration' => $single_work->duration,
                'gallery' => $single_work->gallery,
                'budget' => $single_work->budget,
                'status' => 'draft',
                'description' => $single_work->description,
                'image' => $single_work->image,
                'categories_id' => serialize($single_work->categories_id),
            ]
        );
        return redirect()->back()->with(['msg' => __('Case Study Item Clone Success...'), 'type' => 'success']);
    }

    public function delete($id)
    {
        Works::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
    }

    public function category_index()
    {
        $all_category = WorksCategory::all()->groupBy('lang');
        return view('backend.pages.works.category')->with(['all_category' => $all_category]);
    }

    public function category_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        WorksCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => __('New Category Added...'),
            'type' => 'success'
        ]);
    }

    public function category_update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        WorksCategory::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'lang' => $request->lang,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function category_delete(Request $request, $id)
    {
        if (Works::where('categories_id', $id)->first()) {
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Case Study ...'),
                'type' => 'danger'
            ]);
        }
        WorksCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function category_by_slug(Request $request){
        $all_category = WorksCategory::where('lang',$request->lang)->get();
        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        Works::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_bulk_action(Request $request){
        WorksCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function slug_check(SlugCheckRequest $request){
        $user_given_slug = $request->slug;
        $query = Events::Works(['slug' => $user_given_slug]);

        return SlugChecker::Check($request,$query);
    }
}


