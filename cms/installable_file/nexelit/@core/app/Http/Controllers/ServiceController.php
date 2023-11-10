<?php

namespace App\Http\Controllers;

use App\PricePlan;
use App\ServiceCategory;
use App\Services;
use App\Works;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $all_services = Services::all()->groupBy('lang');
        $service_category = ServiceCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        return view('backend.pages.service.index')->with(['all_services' => $all_services, 'service_category' => $service_category]);
    }

    public function new_service()
    {
        $service_category = ServiceCategory::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        $price_plans = PricePlan::where(['status' => 'publish', 'lang' => get_default_language()])->get();
        return view('backend.pages.service.new-service')->with(['service_category' => $service_category,'price_plans' => $price_plans]);
    }

    public function edit_service($id)
    {
        $service = Services::find($id);
        $service_category = ServiceCategory::where(['status' => 'publish', 'lang' => $service->lang])->get();
        $price_plans = PricePlan::where(['status' => 'publish', 'lang' =>  $service->lang])->get();

        return view('backend.pages.service.edit-service')->with(['service_category' => $service_category,'service' => $service,'price_plans' => $price_plans]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'slug' => 'nullable|string',
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'categories_id' => 'required|string',
            'icon_type' => 'required|string',
            'img_icon' => 'nullable|string|max:191',
            'sr_order' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'price_plan' => 'nullable',
        ]);
        $price_plan = !empty($request->price_plan) ? $request->price_plan : [];
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        Services::create([
            'title' => $request->title,
            'lang' => $request->lang,
            'icon' => $request->icon,
            'description' => $request->description,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'meta_tag' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'categories_id' => $request->categories_id,
            'image' => $request->image,
            'status' => $request->status,
            'sr_order' => $request->sr_order,
            'img_icon' => $request->img_icon,
            'icon_type' => $request->icon_type,
            'price_plan' =>  serialize($price_plan),
        ]);

        return redirect()->back()->with(['msg' => __('New service Added...'), 'type' => 'success']);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'slug' => 'nullable|string',
            'excerpt' => 'required|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'categories_id' => 'required|string',
            'image' => 'nullable|string|max:191',
            'sr_order' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'price_plan' => 'nullable',
        ]);
        $price_plan = !empty($request->price_plan) ? $request->price_plan : [];
        $slug = !empty($request->slug) ? $request->slug : Str::slug($request->title,$request->lang);
        Services::find($request->id)->update([
            'title' => $request->title,
            'lang' => $request->lang,
            'icon' => $request->icon,
            'description' => $request->description,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'meta_tag' => $request->meta_tags,
            'meta_description' => $request->meta_description,
            'categories_id' => $request->categories_id,
            'image' => $request->image,
            'status' => $request->status,
            'sr_order' => $request->sr_order,
            'img_icon' => $request->img_icon,
            'icon_type' => $request->icon_type,
            'price_plan' => serialize($price_plan),
        ]);

        return redirect()->back()->with(['msg' => __('Service Item Updated...'), 'type' => 'success']);
    }

    public function clone_service_as_draft(Request $request)
    {

        $service = Services::find($request->item_id);
        Services::create([
            'title' => $service->title,
            'lang' => $service->lang,
            'icon' => $service->icon,
            'description' => $service->description,
            'slug' => $service->slug,
            'excerpt' => $service->excerpt,
            'meta_tag' => $service->meta_tag,
            'meta_description' => $service->meta_description,
            'categories_id' => $service->categories_id,
            'image' => $service->image,
            'img_icon' => $service->img_icon,
            'icon_type' => $service->icon_type,
            'sr_order' => $service->sr_order,
            'price_plan' => $service->price_plan,
            'status' => 'draft',
        ]);

        return redirect()->back()->with(['msg' => __('Service Item Cloned Success...'), 'type' => 'success']);
    }

    public function delete($id)
    {
        Services::find($id)->delete();

        return redirect()->back()->with(['msg' => __('Delete Success...'), 'type' => 'danger']);
    }

    public function category_index()
    {
        $all_category = ServiceCategory::all()->groupBy('lang');
        return view('backend.pages.service.category')->with(['all_category' => $all_category]);
    }

    public function category_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'icon_type' => 'required|string|max:191',
            'icon' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        ServiceCategory::create($request->all());

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
            'status' => 'required|string|max:191',
            'icon_type' => 'required|string|max:191',
            'icon' => 'nullable|string|max:191',
            'img_icon' => 'nullable|string|max:191'
        ]);

        ServiceCategory::find($request->id)->update([
            'name' => $request->name,
            'lang' => $request->lang,
            'status' => $request->status,
            'img_icon' => $request->img_icon,
            'icon' => $request->icon,
            'icon_type' => $request->icon_type,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category Update Success...'),
            'type' => 'success'
        ]);
    }

    public function category_delete(Request $request, $id)
    {
        if (Services::where('categories_id', $id)->first()) {
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Service...'),
                'type' => 'danger'
            ]);
        }
        ServiceCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Category Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function category_by_slug(Request $request)
    {
        $service_category = ServiceCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($service_category);
    }
    public function price_plan_by_slug(Request $request)
    {
        $service_category = PricePlan::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($service_category);
    }

    public function bulk_action(Request $request)
    {
        Services::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_bulk_action(Request $request)
    {
        ServiceCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function slug_check(Request $request){
        $this->validate($request,[
            'slug' => 'required|string',
            'type' => 'required|string',
            'lang' => 'required|string',
        ]);
        $user_given_slug = $request->slug;
        $query = Services::where(['slug' => $user_given_slug]);
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
}
