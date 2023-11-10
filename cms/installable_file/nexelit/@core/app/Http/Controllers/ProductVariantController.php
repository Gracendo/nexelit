<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    const BASE_PATH = 'backend.products.variant.';

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function all(){
        $all_variant = ProductVariant::all()->groupBy('lang');
        return view(self::BASE_PATH.'all-variant',compact('all_variant'));
    }
    public function new(){
        return view(self::BASE_PATH.'new-variant')->with(['all_languages' => LanguageHelper::all_languages()]);
    }
    public function store(Request $request){
        $this->validate($request,[
           'title' => 'required|string',
           'lang' => 'required|string',
           'terms' => 'required|array',
           'price' => 'required|array',
        ]);
        ProductVariant::create([
            'title' => $request->title,
            'lang' => $request->lang,
            'terms' => json_encode($request->terms),
            'price' => json_encode($request->price)
        ]);
        return back()->with(NexelitHelpers::item_new());
    }
    public function edit($id){
        $variant = ProductVariant::findOrFail($id);
        return view(self::BASE_PATH.'edit-variant')->with(['all_languages' => LanguageHelper::all_languages(),'variant' => $variant]);
    }
    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'lang' => 'required|string',
            'terms' => 'required|array',
            'price' => 'required|array',
        ]);
        ProductVariant::find($request->id)->update([
            'title' => $request->title,
            'lang' => $request->lang,
            'terms' => json_encode($request->terms),
            'price' => json_encode($request->price)
        ]);
        return back()->with(NexelitHelpers::item_update());
    }

    public function delete($id){
        ProductVariant::findOrFail($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }
    public function bulk_action(Request $request){
        ProductVariant::whereIn('id',$request->ids)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }
    public function get_details(Request $request){
        $variant = ProductVariant::findOrFail($request->id);
        return response()->json($variant);
    }

    public function get_all_variant_by_lang(Request $request){
        $variant = ProductVariant::where('lang', $request->lang)->get();
        return response()->json($variant);
    }
}

