<?php

namespace App\Http\Controllers;

use App\Helpers\NexelitHelpers;
use App\Language;
use App\ProductCategory;
use App\ProductSubCategory;
use App\Products;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function all_product_subcategory(){

        $all_subcategory = ProductSubCategory::all()->groupBy('lang');
        $all_category_list = ProductCategory::where('lang' , get_default_language())->get();
        $all_languages = Language::all();
        return view('backend.products.all-products-subcategory')->with(['all_subcategory' => $all_subcategory,'all_languages' => $all_languages,'all_category_list' => $all_category_list] );
    }

    public function store_product_subcategory(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:product_sub_categories,product_category_id',
            'product_category_id' => 'required|string|max:191',
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
        ]);

        ProductSubCategory::create([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
            'product_category_id' => $request->product_category_id,
        ]);

        return back()->with(NexelitHelpers::item_new());
    }

    public function update_product_subcategory(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:product_sub_categories,product_category_id,'.$request->product_category_id,
            'lang' => 'required|string|max:191',
            'status' => 'required|string|max:191',
            'product_category_id' => 'required|string|max:191',
        ]);

        ProductSubCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'lang' => $request->lang,
            'product_category_id' => $request->product_category_id,
        ]);

        return back()->with(NexelitHelpers::item_update());
    }

    public function delete_product_subcategory(Request $request,$id){
        if (Products::where('subcategory_id',$id)->first()){
            return back()->with([
                'msg' => __('You Can Not Delete This Category, It Already Associated With A Products...'),
                'type' => 'danger'
            ]);
        }
        ProductSubCategory::find($id)->delete();
        return redirect()->back()->with(NexelitHelpers::item_delete());
    }

    public function subcategory_by_language_slug(Request $request){
        $all_category = ProductSubCategory::where('product_category_id',$request->lang)->get();
        return response()->json($all_category);
    }

    public function bulk_action(Request $request){
        ProductSubCategory::WhereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function subcategory_by_category(Request $request){
       $all_sub_category =  ProductSubCategory::where('product_category_id',$request->cat_id)->get();
        return response()->json($all_sub_category);
    }
}
