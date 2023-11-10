<?php

namespace App\Http\Controllers\Admin;

use App\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private const BASE_PATH = 'backend.pages.advertisement.';

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $all_advertisements = Advertisement::latest()->get();
        return view(self::BASE_PATH.'index',compact('all_advertisements'));
    }

    public function new_advertisement()
    {
        return view(self::BASE_PATH.'new');
    }

    public function store_advertisement(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'type'=>'required|string',
            'size'=> 'required',
            'status'=> 'required',
            'slot'=> 'nullable',
            'embed_code'=> 'nullable',
            'redirect_url'=> 'nullable',
            'image'=> 'nullable'
        ]);

        Advertisement::create([
            'title' => $request->title,
            'type' => $request->type,
            'size' => $request->size,
            'status' => $request->status,
            'slot' => $request->slot,
            'embed_code' => $request->embed_code,
            'redirect_url' => purify_html($request->redirect_url),
            'image' => $request->image,
        ]);

        return redirect()->back()->with(['msg' => __('New Advertisement Created Successfully'), 'type' => 'success']);
    }

    public function edit_advertisement($id)
    {
        $add = Advertisement::find($id);
        return view(self::BASE_PATH.'edit',compact('add'));
    }

    public function update_advertisement(Request $request,$id)
    {
        $request->validate([
            'title'=>'required|string',
            'type'=>'required|string',
            'size'=> 'required',
            'status'=> 'required',
            'slot'=> 'nullable',
            'embed_code'=> 'nullable',
            'redirect_url'=> 'nullable',
            'image'=> 'nullable'
        ]);

        $add_id =  Advertisement::where('id',$id)->update([
            'title' => purify_html( $request->title),
            'type' => purify_html($request->type),
            'size' => $request->size,
            'status' => $request->status,
            'slot' => $request->slot,
            'embed_code' => $request->embed_code,
            'redirect_url' => purify_html($request->redirect_url),
            'image' => $request->image,
        ]);

        return redirect()->back()->with(['msg' => __('Advertisement Updated Successfully'), 'type' => 'success']);
    }


    public function delete_advertisement($id){
        Advertisement::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Advertisement Deleted Successfully'), 'type' => 'danger']);
    }

    public function bulk_action(Request $request){
        Advertisement::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

}
