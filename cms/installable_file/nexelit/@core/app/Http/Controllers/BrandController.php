<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_brand = Brand::all();
        return view('backend.pages.brand')->with(['all_brand' => $all_brand]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Brand::create($request->all());

        return redirect()->back()->with(['msg' => __('New Brand Added...'),'type' => 'success']);
    }

    public function update(Request $request){

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'url' => 'nullable|string|max:191',
        ]);

        Brand::find($request->id)->update([
            'title' => $request->title,
            'image' => $request->image,
            'url' => $request->url,
        ]);

        return redirect()->back()->with(['msg' => __('Brands Updated...'),'type' => 'success']);
    }

    public function delete($id){

        Brand::find($id)->delete();
        return redirect()->back()->with(['msg' =>__( 'Delete Success...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Brand::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
