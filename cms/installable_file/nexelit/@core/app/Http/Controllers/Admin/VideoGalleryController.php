<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageHelper;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use App\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    const BASE_PATH = 'backend.video-gallery.';
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $all_gallery = VideoGallery::all();
        return view(self::BASE_PATH.'video-gallery',compact('all_gallery'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'nullable|string',
            'embed_code' => 'required|string',
            'status' => 'required|string',
        ]);
        VideoGallery::create([
            'title' => $request->title,
            'embed_code' => $request->embed_code,
            'status' => $request->status
        ]);
        return redirect()->back()->with(NexelitHelpers::item_new());
    }
    public function update(Request $request){
        $this->validate($request,[
            'title' => 'nullable|string',
            'embed_code' => 'required|string',
            'status' => 'required|string',
        ]);
        VideoGallery::find($request->id)->update([
            'title' => $request->title,
            'embed_code' => $request->embed_code,
            'status' => $request->status
        ]);
        return redirect()->back()->with(NexelitHelpers::item_update());
    }
    public function delete(Request $request,$id){
        VideoGallery::find($id)->delete();
        return redirect()->back()->with(NexelitHelpers::item_delete());
    }

    public function bulk_action(Request $request){
        VideoGallery::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function page_settings(){
        return view(self::BASE_PATH.'video-gallery-page-settings')->with(['all_languages' => LanguageHelper::all_languages()]);
    }

    public function update_page_settings(Request $request){
        $this->validate($request,[
            'site_video_gallery_post_items' => 'required',
            'site_video_gallery_order' => 'required',
            'site_video_gallery_order_by' => 'required',
        ]);
        $all_fields  = [
            'site_video_gallery_post_items',
            'site_video_gallery_order',
            'site_video_gallery_order_by'
        ];

        foreach ($all_fields as $field){
            update_static_option($field,$request->$field);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated...'),'type' => 'success']);
    }
}
