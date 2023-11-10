<?php

namespace App\Http\Controllers;

use App\Language;
use App\PricePlan;
use App\PricePlanCategory;
use Illuminate\Http\Request;

class PricePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_category = PricePlanCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();
        $all_price_plan = PricePlan::all()->groupBy('lang');
        return view('backend.pages.price-plan.price-plan')->with(['all_price_plan' => $all_price_plan,'all_languages' => $all_language,'all_category' => $all_category]);
    }
    public function new(){
        $all_category = PricePlanCategory::where(['status' => 'publish','lang' => get_default_language()])->get();
        $all_language = Language::all();
        return view('backend.pages.price-plan.price-plan-new')->with(['all_languages' => $all_language,'all_category' => $all_category]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'price' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'type' => 'nullable|string|max:191',
            'highlight' => 'nullable|string|max:191',
            'staus' => 'nullable|string|max:191',
            'btn_text' => 'required|string|max:191',
            'btn_url' => 'nullable|string|max:191',
            'features' => 'required|string',
            'categories_id' => 'required|string',
        ]);
        PricePlan::create($request->all());
        return redirect()->back()->with(['msg' => __('New Price Plan Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'price' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'type' => 'nullable|string|max:191',
            'highlight' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:191',
            'btn_text' => 'required|string|max:191',
            'btn_url' => 'nullable|string|max:191',
            'categories_id' => 'required|string',
            'features' => 'required|string',
        ]);

        PricePlan::find($request->id)->update(
            [
                'title' => $request->title,
                'price' => $request->price,
                'lang' => $request->lang,
                'type' => $request->type,
                'categories_id' => $request->categories_id,
                'highlight' => $request->highlight,
                'status' => $request->status,
                'btn_text' => $request->btn_text,
                'url_status' => $request->url_status,
                'btn_url' => $request->btn_url,
                'features' => $request->features
            ]
        );

        return redirect()->back()->with(['msg' => __('Price Plan Updated...'),'type' => 'success']);
    }

    public function clone(Request $request){
        $price_plan_details = PricePlan::find($request->item_id);

        PricePlan::create([
            'title' => $price_plan_details->title,
            'price' => $price_plan_details->price,
            'lang' => $price_plan_details->lang,
            'type' => $price_plan_details->type,
            'categories_id' => $price_plan_details->categories_id,
            'highlight' => $price_plan_details->highlight,
            'status' => 'draft',
            'btn_text' => $price_plan_details->btn_text,
            'url_status' => $price_plan_details->url_status,
            'btn_url' => $price_plan_details->btn_url,
            'features' => $price_plan_details->features
        ]);

        return redirect()->back()->with(['msg' =>__( 'Price Plan clone success...'),'type' => 'success']);
    }

    public function delete($id){
        PricePlan::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Delete Success...'),'type' => 'danger']);
    }

    public function category_index(){
        $all_languages = Language::all();
        $all_category = PricePlanCategory::all()->groupBy('lang');
        return view('backend.pages.price-plan.price-category')->with(['all_languages' => $all_languages,'all_category' => $all_category]);
    }
    public function category_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        PricePlanCategory::create($request->all());

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

        PricePlanCategory::find($request->id)->update([
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
        if (PricePlan::where('categories_id', $id)->first()) {
            return redirect()->back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Price Plan ...'),
                'type' => 'danger'
            ]);
        }
        PricePlanCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Category Delete Success...',
            'type' => 'danger'
        ]);
    }

    public function Language_by_slug(Request $request){
        $all_category = PricePlanCategory::where('lang',$request->lang)->get();

        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        PricePlan::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function category_bulk_action(Request $request){
        PricePlanCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
