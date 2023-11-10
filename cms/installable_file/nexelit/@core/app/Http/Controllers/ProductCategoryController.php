<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Language;
use App\ProductCategory;
use App\Products;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function all_product_category(){

        $all_category = ProductCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.products.all-products-category')->with(['all_category' => $all_category,'all_languages' => $all_languages] );
    }

    public function store_product_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:product_categories',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
        ]);

        ProductCategory::create([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
            'image' => $request->image,
        ]);

        return back()->with(NexelitHelpers::item_new());
    }

    public function update_product_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
        ]);

        ProductCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
            'image' => $request->image,
        ]);

        return back()->with(NexelitHelpers::item_update());
    }

    public function delete_product_category(Request $request,$id){
        if (Products::where('category_id',$id)->first()){
            return back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Products...'),
                'type' => 'danger'
            ]);
        }
        ProductCategory::find($id)->delete();
        return redirect()->back()->with(NexelitHelpers::item_delete());
    }

    public function Category_by_language_slug(Request $request){
        $all_category = ProductCategory::where('lang',$request->lang)->get();
        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        ProductCategory::WhereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
