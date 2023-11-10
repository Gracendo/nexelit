<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use App\ImageGalleryCategory;
use App\Language;
use Illuminate\Http\Request;

class ImageGalleryPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_gallery_images = ImageGallery::all()->groupBy('lang');
        $all_languages = Language::all();
        $all_categories = ImageGalleryCategory::where(['status' => 'publish' ,'lang' => get_default_language()])->get();
        return view('backend.image-gallery.image-gallery')->with(['all_gallery_images' => $all_gallery_images,'all_languages' => $all_languages,'all_categories' => $all_categories]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'image' => 'required|string',
            'title' => 'nullable|string',
            'lang' => 'required|string',
            'cat_id' => 'required|string',
        ]);
        ImageGallery::create([
            'image' => $request->image,
            'title' => $request->title,
            'lang' => $request->lang,
            'cat_id' => $request->cat_id,
        ]);
        return redirect()->back()->with(['msg' => __('New Image Added...'),'type' => 'success']);
    }
    public function update(Request $request){
        $this->validate($request,[
            'image' => 'required|string',
            'title' => 'nullable|string',
            'lang' => 'required|string',
            'cat_id' => 'required|string',
        ]);
        ImageGallery::find($request->id)->update([
            'image' => $request->image,
            'title' => $request->title,
            'lang' => $request->lang,
            'cat_id' => $request->cat_id,
        ]);
        return redirect()->back()->with(['msg' => __('Image Updated...'),'type' => 'success']);
    }
    public function delete(Request $request,$id){
        ImageGallery::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Image Delete...'),'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        $all = ImageGallery::find($request->ids);
        foreach($all as $item){
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function category_index(){
        $all_gallery_images = ImageGalleryCategory::all()->groupBy('lang');
        $all_languages = Language::all();
        return view('backend.image-gallery.image-gallery-category')->with(['all_category' => $all_gallery_images,'all_languages' => $all_languages ]);
    }
    public function category_store(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
        ImageGalleryCategory::create([
            'status' => $request->status,
            'lang' => $request->lang,
            'title' => $request->title,
        ]);
        return redirect()->back()->with(['msg' => __('Category Added...'),'type' => 'success']);
    }
    public function category_update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'status' => 'required|string',
            'lang' => 'required|string',
        ]);
        ImageGalleryCategory::where('id',$request->id)->update([
            'status' => $request->status,
            'lang' => $request->lang,
            'title' => $request->title,
        ]);
        return redirect()->back()->with(['msg' => __('Category Updated...'),'type' => 'success']);
    }
    public function category_delete(Request $request,$id){
        ImageGalleryCategory::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Category Delete...'),'type' => 'danger']);
    }

    public function category_bulk_action(Request $request){
        $all = ImageGalleryCategory::find($request->ids);
        foreach($all as $item){
            if ($request->type == 'delete'){
                $item->delete();
            }else{
                ImageGalleryCategory::find($item->id)->update(['status' => $request->type]);
            }

        }
        return response()->json(['status' => 'ok']);
    }
    public function category_by_slug(Request $request)
    {
        $service_category = ImageGalleryCategory::where(['status' => 'publish', 'lang' => $request->lang])->get();
        return response()->json($service_category);
    }

    public function page_settings(){
        $all_languages = Language::all();
        return view('backend.image-gallery.image-gallery-page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
           'site_image_gallery_post_items' => 'required',
           'site_image_gallery_order' => 'required',
           'site_image_gallery_order_by' => 'required',
        ]);
        $all_fields  = [
            'site_image_gallery_post_items',
            'site_image_gallery_order',
            'site_image_gallery_order_by'
        ];

        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
    }
}
